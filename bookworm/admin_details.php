<?php
    include 'config.php';

    //Start session
    session_start();

    $admin_id = $_SESSION['admin_id'];

    //Redirect to login page if the user hasn't logged in
    if(!isset($admin_id)){
    header('location:login.php');
    }

    //Delete admin if the delete button is clicked
    if (isset($_GET['delete_user'])) {
        $delete_id = $_GET['delete_user'];
        mysqli_query($conn, "DELETE FROM `userinfo` WHERE userId = '$delete_id'") or die('query failed');
        header('location:admin_details.php');
    }

    //Update admin if the update button is clicked
    if (isset($_POST['update_user'])) {
        $update_id = $_POST['update_id'];
        $update_name = $_POST['update_name'];
        $update_email = $_POST['update_email'];
        $update_password = $_POST['update_password'];
        $update_user_type = $_POST['update_user_type'];

        mysqli_query($conn, "UPDATE `userinfo` SET userName = '$update_name', userEmail ='$update_email', userPassword = '$update_password', userType='$update_user_type' WHERE userId = '$update_id'") or die('query failed');

        header('location:./admin_details.php');
    }
    //Select all admin users
    $select_admin = mysqli_query($conn, "SELECT userId, userName, userEmail, userPassword, userType FROM userinfo WHERE userType = 'Admin'") or die('query failed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/register.css">
    <link rel="stylesheet" href="./css/index_book.css">
    <title>Admin Data</title>
</head>
<body>
    <?php 
        include 'admin_header.php'; 
    ?>

    <section class="show-products">
        <div class="box-container">
            <?php
                //Display all admins
                $select_admin = mysqli_query($conn, "SELECT userId, userName, userEmail, userPassword, userType FROM userinfo WHERE userType = 'Admin'") or die('query failed');
                if(mysqli_num_rows($select_admin) > 0){
                    while($fetch_user = mysqli_fetch_assoc($select_admin)){
            ?>
                        <div class="box">
                            <div class="name">User ID: <?php echo $fetch_user['userId']; ?></div>
                            <div class="name">Name: <?php echo $fetch_user['userName']; ?></div>
                            <div class="name">Email: <?php echo $fetch_user['userEmail']; ?></div>
                            <div class="password">Password: <?php echo $fetch_user['userPassword']; ?></div>
                            <div class="price-usertype"style="color:<?php if($fetch_user['userType'] == 'Admin'){ echo 'red'; }else{ echo 'blue'; } ?>;">User Type: <?php echo $fetch_user['userType']; ?></div>
                            <a style="color:rgb(255, 187, 0);" href="admin_details.php?update_user=<?php echo $fetch_user['userId']; ?>">Update</a>
                            <a href="admin_details.php?delete_user=<?php echo $fetch_user['userId']; ?>" onclick="return confirm('Are you sure you want to delete this user');">Delete</a>
                        </div>
            <?php
                    }
                }
                else{
                    echo '<p class="empty">no products added yet!</p>';
                }
            ?>
        </div>
    </section>

    <section class="edit_user-form">
        <div class="edit-product-form">
            <?php
                //Display the update user form
                if (isset($_GET['update_user'])) {
                    $update_id = $_GET['update_user'];
                    $update_query = mysqli_query($conn, "SELECT * FROM `userinfo` WHERE userId = '$update_id'") or die('query failed');
                    if (mysqli_num_rows($update_query) > 0) {
                        while ($fetch_update = mysqli_fetch_assoc($update_query)) {
            ?>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="update_id" value="<?php echo $fetch_update['userId']; ?>">
                                <input type="text" value="<?php echo $fetch_update['userName'] ?>" name="update_name" placeholder="Enter Name" required class="box ">
                                <input type="email" value="<?php echo $fetch_update['userEmail'] ?>" name="update_email" placeholder="Enter Email Id" required class="box">
                                <input type="password" value="<?php echo $fetch_update['userPassword'] ?>" name="update_password" placeholder="Enter password" required class="box">
                                <select name="update_user_type" id="" required class="box">
                                    <option value="User">User</option>
                                    <option value="Admin">Admin</option>
                                </select>
                                <input type="submit" value="Update" name="update_user" class="delete_btn" style="cursor:pointer;">
                                <input type="reset" value="cancel" id="close-update_user" class="update_btn" style="cursor:pointer;">
                            </form>
            <?php
                        }
                    }
                } 
                else {
                    echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
                }
            ?>
        </div>
    </section>

    <script>
        //Close the update user form and redirect to admin details page
        document.querySelector('#close-update_user').onclick = () => {
            document.querySelector('.edit-product-form').style.display = 'none';
            window.location.href = 'admin_details.php';
        }
    </script>
</body>
</html>