<?php
   include 'config.php';

   //Start session
   session_start();

   //Enabling reporting all for all errors
   error_reporting(E_ALL);

   //Retrieving user ID from session
   $user_id = $_SESSION['user_id'];

   //Redirecting to login page if user is not logged in
   if(!isset($user_id)){
      header('location:login.php');
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="./css/hello.css">

   <style>
      .placed-orders .title{
         text-align: center;
         margin-bottom: 20px;
         text-transform: uppercase;
         color:black;
         font-size: 40px;
      }

      .placed-orders .box-container{
         max-width: 1200px;
         margin:0 auto;
         display:flex;
         flex-wrap: wrap;
         align-items: center;
         gap:20px;
      }

      .placed-orders .box-container .empty{
         flex:1;
      }

      .placed-orders .box-container .box{
         flex:1 1 400px;
         border-radius: .5rem;
         padding:15px;
         border:2px solid brown;
         background-color: white;
         padding:10px 20px;
      }

      .placed-orders .box-container .box p{
         padding:10px 0 0 0;
         font-size: 20px;
         color:gray;
      }

      .placed-orders .box-container .box p span{
         color:black;
      }
   </style>
</head>
<body>
   
   <?php
      //Include header
      include 'index_header.php'; 
   ?>

   <section class="placed-orders">
      <h1 class="title">Placed orders</h1>
      <div class="box-container">

         <?php
            //Retrieving orders placed by the user
            $select_book = mysqli_query($conn, "SELECT * FROM `confirmorder` WHERE userId = '$user_id' ORDER BY orderDate DESC") or die('query failed');
            if(mysqli_num_rows($select_book) > 0){
               while($fetch_book = mysqli_fetch_assoc($select_book)){
         ?>
                  <div class="box">
                     <!--Displaying order details-->
                     <p> Order Date : <span><?php echo $fetch_book['orderDate']; ?></span> </p>
                     <p> Order Id : <span># <?php echo $fetch_book['orderId']; ?> </p>
                     <p> Name : <span><?php echo $fetch_book['userName']; ?></span> </p>
                     <p> Mobile Number : <span><?php echo $fetch_book['userPhoneNo']; ?></span> </p>
                     <p> Email Id : <span><?php echo $fetch_book['userEmail']; ?></span> </p>
                     <p> Address : <span><?php echo $fetch_book['userAddress']; ?></span> </p>
                     <p> Payment Method : <span><?php echo $fetch_book['paymentMethod']; ?></span> </p>
                     <p> Your orders : <span><?php echo $fetch_book['totalBooks']; ?></span> </p>
                     <p> Total price : <span>RM<?php echo number_format($fetch_book['totalPrice'], 2); ?></span> </p>
                     <p> Payment status : <span style="color:<?php if($fetch_book['paymentStatus'] == 'pending'){ echo 'orange'; }else{ echo 'green'; } ?>;"><?php echo $fetch_book['paymentStatus']; ?></span> </p>
                  </div>
         <?php
               }
            }
            else{
               echo '<p class="empty" style="text-align:center;">You have not placed any order yet!</p>';
            }
         ?>
      </div>
   </section>
   <?php
      //Including footer
      include 'index_footer.php'; 
   ?>

   <script src="js/script.js"></script>
</body>
</html>