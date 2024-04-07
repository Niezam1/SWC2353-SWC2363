<?php
  include 'config.php';
  
  //Handling form submission
  if(isset($_POST['submit'])) {
    //Retrieving form data and preventing SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, ($_POST['password']));
    $cpassword = mysqli_real_escape_string($conn, ($_POST['cpassword']));
    $user_type = $_POST['user_type'];

    //Checking if the user already exists
    $select_users = $conn->query("SELECT * FROM userinfo WHERE userEmail = '$email'") or die('query failed');

    if(mysqli_num_rows($select_users)!=0){
      $message[]='User Already Exists!';
    }
    else{
      //Validating password confirmation
      if($password !=$cpassword){
        $message[] = 'Confirm password is not matched.';
      }
      else{
        //Inserting user data into the database
        mysqli_query($conn, "INSERT INTO userinfo(`userName`, `userEmail`, `userPassword`, `userType`) VALUES('$name','$email','$password','$user_type')") or die('Query failed');
        $message[]='Registration Is Successful';
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/register.css  " />

    <title>Register</title>
    <style>
      .container form .link{
        text-decoration: none; color:white;  border-radius: 17px; padding: 8px 18px; margin: 0px 10px; background: rgb(0, 0, 0); font-size: 20px;
      }

      .container form .link:hover{
        background: rgb(0, 167, 245);
      }
    </style>
  </head>

  <body>
    <?php
      //Displaying messages if any
      if(isset($message)){
        foreach($message as $message){
          echo '
          <div class="message" id= "messages">
            <span>'.$message.'</span>
          </div>
          ';
        }
      }
    ?>
    <div class="container">
      <form action="" method="post">
        <h3 style="color:white">Register To <a href="index.php"><span>Book</span><span>worm</span></a></h3>
        <!--Registration form-->
        <input type="text" name="Name" placeholder="Enter Name" required class="text_field ">
        <input type="email" name="email" placeholder="Enter Email" required class="text_field">
        <input type="password" name="password" placeholder="Enter Password" required class="text_field">
        <input type="password" name="cpassword" placeholder="Confirm Password" required class="text_field">
        <select name="user_type" id="" required class="text_field">
          <option value="User">User</option>
          <option value="Admin">Admin</option>
        </select>
        <input type="submit" value="Register" name="submit" class="btn text_field">
        <p>Already have an account? <br> <a class="link" href="login.php">Login</a><a class="link" href="index.php">Back</a></p>
      </form>
    </div>

  <script>
    //Hide messages after 8 seconds
    setTimeout(() => {
    const box = document.getElementById('messages');
    box.style.display = 'none';
    }, 8000);
  </script>

  </body>
</html>