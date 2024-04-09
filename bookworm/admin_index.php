<?php 
  include 'config.php';

  //Start session
  session_start();

  //Checking if admin is logged in
  $admin_id = $_SESSION['admin_id'];
  if(!isset($admin_id)){
    header('location:login.php');
  }

  //Get the number of users
  $users_no = $conn->query("SELECT * FROM userinfo WHERE userType='User'") or die('query failed');
  $usercount = mysqli_num_rows( $users_no );

  //Get the number of admins
  $admin_no = $conn->query("SELECT * FROM userinfo WHERE userType='Admin'") or die('query failed');
  $admin_count = mysqli_num_rows( $admin_no );

  //Get the number of books
  $books_no = $conn->query("SELECT * FROM bookdetails ") or die('query failed');
  $bookscount = mysqli_num_rows( $books_no );

  //Get the number of orders
  $orders = $conn->query("SELECT * FROM confirmorder ") or die('query failed');
  $orders_count = mysqli_num_rows( $orders );

  //Get the number of messages
  $msg_no = $conn->query("SELECT * FROM message ") or die('query failed');
  $msgcount = mysqli_num_rows( $msg_no );
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/admin.css" />
    <title>Bookworm Admin</title>
  </head>

  <body >
    <?php 
      //Including admin header
      include'admin_header.php';
    ?>
    <br/>
    <div class="main_box">
      <!--Card for displaying total pending payment-->
      <div class="card" style="width: 15rem;">
        <?php
          //Calculate total pending payment
          $total_pendings = 0;
          $select_pending = mysqli_query($conn, "SELECT totalPrice FROM `confirmorder` WHERE paymentStatus = 'pending'") or die('query failed');
          if(mysqli_num_rows($select_pending) > 0){
            while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
              $total_price = number_format($fetch_pendings['totalPrice'], 2);
              $total_pendings += $total_price;
            };
          };
        ?>
        <!--Displaying card information-->
        <img class="card-img-top" src="./images/pen3.png" alt="Card image cap"/> 
        <div class="card-body">
          <h5 class="card-title">Total pending payment</h5>
          <p class="card-text"> 
          <?php echo "RM" . number_format($total_pendings, 2) ?>
          </p>
          <!--Button to view details-->
          <div class="buttons" style="display: flex;">
            <a href="pending-orders.php" class="btn btn-primary">Details</a>
          </div>
        </div>
      </div>
      <!--Card for displaying total completed payment-->
      <div class="card" style="width: 15rem;">
        <?php
          //Calculating total completed payment
          $total_completed = 0;
          $select_completed = mysqli_query($conn, "SELECT totalPrice FROM `confirmorder` WHERE paymentStatus = 'completed'") or die('query failed');
          if(mysqli_num_rows($select_completed) > 0){
            while($fetch_completed = mysqli_fetch_assoc($select_completed)){
              $total_price = number_format($fetch_completed['totalPrice'], 2);
              $total_completed += $total_price;
            };
          };
        ?>
        <!--Displaying card information-->
        <img class="card-img-top" src="./images/compn.png" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title">Total payment received</h5>
          <p class="card-text">
          <?php echo "RM" .number_format($total_completed, 2); ?>
          </p>
          <!--Button to view details-->
          <div class="buttons" style="display: flex;">
            <a href="completed-orders.php" class="btn btn-primary">Details</a>
          </div>
        </div>
      </div>
      <!--Card for displaying total number of orders-->
      <div class="card" style="width: 15rem;">
        <img class="card-img-top" src="./images/orderpn.png" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title">Number of orders received</h5>
          <p class="card-text">
          <?php echo $orders_count; ?>
          </p>
          <!--Button to view details-->
          <a href="completed-orders.php" class="btn btn-primary">Details</a>
        </div>
      </div>
      <!--Card for displaying total number of books-->
      <div class="card" style="width: 15rem;">
        <img class="card-img-top" src="./images/no. books.png" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title">Number of books available</h5>
          <p class="card-text">
          <?php echo $bookscount; ?>
          </p>
          <!--Button to view details and add books-->
          <div class="buttons" style="display: flex;">
            <a href="total_books.php" class="btn btn-primary">See Books</a>
            <a href="add_books.php" class="btn btn-primary">Add Books</a>
          </div>
        </div>
      </div>
      <!--Card for displaying total number of user queries-->
      <div class="card" style="width: 15rem;">
        <img class="card-img-top" src="./images/whatpm.png" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title">Number Of Users Queries</h5>
          <p class="card-text">
          <?php echo $msgcount; ?>
          </p>
          <!--Button to view details-->
          <a href="message_admin.php" class="btn btn-primary">Details</a>
        </div>
      </div>
      <!--Card for displaying total number of registered admins-->
      <div class="card" style="width: 15rem;">
        <img class="card-img-top" src="./images/adminpn2.png" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title">Number of registered admins</h5>
          <p class="card-text">
            <?php echo $admin_count; ?>
          </p>
          <!--Button to view details-->
          <a href="admin_details.php" class="btn btn-primary">Details</a>
        </div>
      </div>
      <!--Card for displaying total number of registered users-->
      <div class="card" style="width: 15rem;">
        <img class="card-img-top" src="./images/userspm.png" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title">Number of registered users</h5>
          <p class="card-text">
            <?php echo $usercount; ?>
          </p>
          <!--Button to view details-->
          <a href="users_detail.php" class="btn btn-primary">Details</a>
        </div>
      </div>
    </div>
  </body>
</html>