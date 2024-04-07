<?php
    include 'config.php';

    //Start session
    session_start();

    //Retrieving admin ID from session
    $admin_id = $_SESSION['admin_id'];

    //Redirect to login page if admin is not logged in
    if(!isset($admin_id)){
        header('location:login.php');
    };

    //Deleting message if delete is clicked
    if (isset($_GET['delete_msg'])) {
        $msg_id = $_GET['delete_msg'];

        //Deleting message from the database
        mysqli_query($conn, "DELETE FROM `message` WHERE messageId = '$msg_id'") or die('query failed');

        //Redirecting back to the message_admin page
        header('location:message_admin.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/register.css">
    <link rel="stylesheet" href="./css/index_book.css">
    <title>Messages</title>
</head>

<body>
    <?php
        //Including header
        include 'admin_header.php';
    ?>

    <section class="show-products">
        <div class="box-container">
            <?php
                //Retrieving messages from the database
                $select_user = mysqli_query($conn, "SELECT messageId, userName, userEmail, phoneNo, message, messageDate FROM message") or die('query failed');

                //Checking if there are any messages
                if(mysqli_num_rows($select_user) > 0){
                    while($fetch_user = mysqli_fetch_assoc($select_user)){
            ?>
                        <div class="box">
                            <!--Displaying message details-->
                            <div class="name">Message ID: <?php echo $fetch_user['messageId']; ?></div>
                            <div class="name">Name: <?php echo $fetch_user['userName']; ?></div>
                            <div class="name">Email: <?php echo $fetch_user['userEmail']; ?></div>
                            <div class="password">Number: <?php echo $fetch_user['phoneNo']; ?></div>
                            <div class="price">Message: <?php echo wordwrap($fetch_user['message'],30,"<br>\n",TRUE); ?></div>
                            <div class="price">Date: <?php echo $fetch_user['messageDate']; ?></div>
                            <!--Link to delete the message-->
                            <a href="message_admin.php?delete_msg=<?php echo $fetch_user['messageId']; ?>" onclick="return confirm('delete this message?');">Delete</a>
                        </div>
            <?php
                    }
                }
                else{
                    echo '<p class="empty">No any message recived yet!</p>';
                }
            ?>
        </div>
    </section>
</body>
</html>