<?php
  include 'config.php';

  //Start session
  session_start();

  //Retrieve user ID and user name from session
  $user_id = $_SESSION['user_id'];
  $user_name =$_SESSION['user_name'];
    
  //Redirect to login page if user is not logged in
  if(!isset($user_id)){
    header('location:login.php');
  }
    
  //Process form submission to send message
  if(isset($_POST['send_msg'])) {
    //Escape user input to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $msg = mysqli_real_escape_string($conn, $_POST['msg']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    //Insert message into database
    mysqli_query($conn, "INSERT INTO message (`userId`,`userName`,`userEmail`, `phoneNo`, `message`) VALUES('$user_id','$name','$email','$phone','$msg')") or die('Mesage send Query failed');
    //Display success message
    $message[]='Message Has Been Sent :)';
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Contact Us</title>
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/hello.css">
</head>

<body>
  <?php
  //Include header
  include 'index_header.php';
  ?>

  <?php
    //Display messages if any
    if(isset($message)){
      foreach($message as $message){
        echo '
        <div class="message" id= "messages"><span>'.$message.'</span>
        </div>
        ';
      }
    }
  ?>
  <div class="contact-section">
    <h1>Contact Us</h1>
    <!--Display user name-->
    <h3 style="text-align:center;">Hello, 
      <span><?php echo $user_name;?> </span> &nbsp;how we can help you?
    </h3>
    <div class="border"></div>
    <!--Contact form-->
    <form class="contact-form" action="" method="post">
      <input type="text" class="contact-form-text" name="name" placeholder="Your name">
      <input type="email" class="contact-form-text" name="email" placeholder="Your email">
      <input type="int" class="contact-form-text" name="phone" placeholder="Your phone number">
      <textarea class="contact-form-text" name="msg" placeholder="Your message"></textarea>
      <input type="submit" class="contact-form-btn" name="send_msg" value="Send">
      <a href="index.php" class="contact-form-btn">Back</a>
    </form>
  </div>

  <!--Include footer-->
  <?php include'index_footer.php';?>

  <script>
    //Hide messages after 5 seconds
    setTimeout(() => {
    const box = document.getElementById('messages');
    box.style.display = 'none';
    }, 5000);
  </script>
</body>
</html>