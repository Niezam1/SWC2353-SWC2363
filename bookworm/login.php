<?php
    include 'config.php';

    //Start session
    session_start();

    //Handling form submission for login
    if (isset($_POST['login'])) {
        //Sanitizing input data
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $select_users = $conn->query("SELECT * FROM userinfo WHERE userEmail = '$email' AND userPassword='$password' ") or die('query failed');

        //Checking if user exists
        if (mysqli_num_rows($select_users) ==1) {
            //Fetching user details
            $row = mysqli_fetch_assoc($select_users);

            //Redirecting based on user type
            if ($row['userType'] == 'Admin') {
                //Setting admin session variables
                $_SESSION['admin_name'] = $row['userName'];
                $_SESSION['admin_email'] = $row['userEmail'];
                $_SESSION['admin_id'] = $row['userId'];
                header('location:admin_index.php');
            } 
            elseif ($row['userType'] == 'User') {
                //Setting user session variables
                $_SESSION['user_name'] = $row['userName'];
                $_SESSION['user_email'] = $row['userEmail'];
                $_SESSION['user_id'] = $row['userId'];
                header('location:index.php');
            }
        }
        else {
            //Error message for incorrect credentials
            $message[] = 'Incorrect Email or Password!';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/register.css" />
    <title>Login</title>
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
        //Displaying message if any
        if(isset($message)){
            foreach($message as $message){
                echo '
                <div class="message" id="messages">
                    <span>'.$message.'</span>
                </div>
                ';
            }
        }
    ?>

    <!--Login form-->
    <div class="container">
        <form action="" method="post">
            <h3 style="color:white">Login to <a href="index.php"><span>Book</span><span>worm</span></a></h3>
            <input type="email" name="email" placeholder="Enter Email" required class="text_field">
            <input type="password" name="password" placeholder="Enter password" required class="text_field">
            <input type="submit" value="Login" name="login" class="btn text_field">
            <p>Don't have an Account? <br> <a class="link" href="Register.php">Sign Up</a><a class="link" href="index.php">Back</a></p>
        </form>
    </div>

    <script>
        //Hide message after 8 seconds
        setTimeout(() => {
        const box = document.getElementById('messages');
        box.style.display = 'none';
        }, 8000);
    </script>

</body>
</html>