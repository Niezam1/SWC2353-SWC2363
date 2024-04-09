<?php 
  include 'config.php';

  //Start session
  session_start();

  //Error reporting enable
  error_reporting(E_ALL);

  //Retrieving user from session
  $user_id = $_SESSION['user_id'];

  //Redirect user to login page if user isn't logged in
  if (!isset($user_id)) {
    header('location:login.php');
  }

  //Handling checkout form submission
  if (isset($_POST['checkout'])) {
    //Retrieving form data and sanitizing input
    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $number = $_POST['number'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);
    $full_address = mysqli_real_escape_string($conn, $_POST['address'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . ' - ' . $_POST['zipcode']);
    $placed_on = date('d-M-Y');

    //Initializing variables
    $cart_total = 0;
    $cart_products[] = '';

    //Validating form fields
    if (empty($name)) {
      $message[] = 'Please Enter Your Name';
    } elseif (empty($email)) {
      $message[] = 'Please Enter Email Id';
    } elseif (empty($number)) {
      $message[] = 'Please Enter Mobile Number';
    } elseif (empty($address)) {
      $message[] = 'Please Enter Address';
    } elseif (empty($city)) {
      $message[] = 'Please Enter City';
    } elseif (empty($state)) {
      $message[] = 'Please Enter State';
    } elseif (empty($country)) {
      $message[] = 'Please Enter Country';
    } elseif (empty($zipcode)) {
      $message[] = 'Please Enter Your Area Zip Code';
    } else {
      //Retrieving cart items
      $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE userId = '$user_id'") or die('query failed');
      if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
          //Calculating subtotal and total price
          $cart_products[] = $cart_item['bookName'] . ' #' . $cart_item['bookId'] . ',(' . $cart_item['quantity'] . ') ';
          $quantity=$cart_item['quantity'];
          $unit_price=$cart_item['bookPrice'];
          $cart_books = $cart_item['bookName'];
          $sub_total = ($cart_item['bookPrice'] * $cart_item['quantity']);
          $cart_total += $sub_total;
        } 
      }
      //Constructing a string of all books in the cart
      $total_books = implode(' ', $cart_products);

      //Checking if the order has already been placed
      $order_query = mysqli_query($conn, "SELECT * FROM `confirmorder` WHERE userName = '$name' AND userPhoneNo = '$number' AND userEmail = '$email' AND paymentMethod = '$method' AND userAddress = '$address' AND totalBooks = '$total_books' AND totalPrice = '$cart_total'") or die('query failed');
      if (mysqli_num_rows($order_query) > 0) {
        $message[] = 'Order already placed!';
      } 
      else {
        //Inserting order details into confirmorder table in database
        mysqli_query($conn, "INSERT INTO `confirmorder`(userId, userName, userPhoneNo, userEmail, paymentMethod, userAddress, totalBooks, totalPrice, orderDate) VALUES('$user_id','$name', '$number', '$email','$method', '$full_address', '$total_books', '$cart_total', '$placed_on')") or die('query failed');

        $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE userId = '$user_id'") or die('query failed');
          if (mysqli_num_rows($cart_query) > 0) {
            while ($cart_item = mysqli_fetch_assoc($cart_query)) {
              $cart_products[] = $cart_item['bookName'] . ' #' . $cart_item['bookId'] . ',(' . $cart_item['quantity'] . ') ';
              $quantity=$cart_item['quantity'];
              $unit_price=$cart_item['bookPrice'];
              $cart_books = $cart_item['bookName'];
              $sub_total = ($cart_item['bookPrice'] * $cart_item['quantity']);
              $cart_total += $sub_total;
          
              //Inserting order details into orders table in database
              mysqli_query($conn, "INSERT INTO `orders`(orderId, userId, userAddress, city, state, country, zipcode, bookName, quantity, bookPrice, subTotal) VALUES('','$user_id', '$address','$city','$state','$country','$zipcode','$cart_books','$quantity','$unit_price','$sub_total')") or die('query failed');
            }
          }
        //success message
        $message[] = 'Order placed successfully!';
        //Clearing cart after successful order placement
        mysqli_query($conn, "DELETE FROM `cart` WHERE userId = '$user_id'") or die('query failed');
      }
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Checkout</title>
  <style>
    body {
      font-family: Arial;
      font-size: 17px;
      padding: 8px;
      overflow-x: hidden;
    }

    * {
      box-sizing: border-box;
    }

    .row {
      display: -ms-flexbox;
      display: flex;
      -ms-flex-wrap: wrap;
      flex-wrap: wrap;
      margin: 0 -16px;
      padding: 30px;
    }

    .col-25 {
      -ms-flex: 25%;
      flex: 25%;
    }

    .col-50 {
      -ms-flex: 50%;
      flex: 50%;
    }

    .col-75 {
      -ms-flex: 75%;
      flex: 75%;
    }

    .col-25, .col-50, .col-75 {
      padding: 0 16px;
    }

    .container {
      background-color: #f2f2f2;
      padding: 5px 20px 15px 20px;
      border: 1px solid lightgrey;
      border-radius: 3px;
    }

    input[type=text], select {
      width: 100%;
      margin-bottom: 20px;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    label {
      margin-bottom: 10px;
      display: block;
      color: black;
    }

    .icon-container {
      margin-bottom: 20px;
      padding: 7px 0;
      font-size: 24px;
    }

    .btn {
      background-color: rgb(28 146 197);
      color: white;
      padding: 12px;
      margin: 10px 0;
      border: none;
      width: 100%;
      border-radius: 3px;
      cursor: pointer;
      font-size: 17px;
    }

    .btn:hover {
      background-color: rgb(6 157 21);
      letter-spacing: 1px;
      font-weight: 600;
    }

    a {
      color: #rgb(28 146 197);
    }

    hr {
      border: 1px solid lightgrey;
    }

    span.price {
      float: right;
      color: grey;
    }

    @media (max-width: 800px) {
      .row {
        flex-direction: column-reverse;
        padding: 0;
      }

      .col-25 {
        margin-bottom: 20px;
      }
    }

    .message {
      position: sticky;
      top: 0;
      margin: 0 auto;
      width: 61%;
      background-color: #fff;
      padding: 6px 9px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      z-index: 100;
      gap: 0px;
      border: 2px solid rgb(68, 203, 236);
      border-top-right-radius: 8px;
      border-bottom-left-radius: 8px;
    }

    .message span {
      font-size: 22px;
      color: rgb(240, 18, 18);
      font-weight: 400;
    }

    .message i {
      cursor: pointer;
      color: rgb(3, 227, 235);
      font-size: 15px;
    }
  </style>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/493af71c35.js" crossorigin="anonymous"></script>  
</head>

<body>
  <?php 
    //Include header
    include 'index_header.php'; 
  ?>

  <?php
    //Displaying message if any
    if (isset($message)) {
      foreach ($message as $message) {
        echo '
          <div class="message" id= "messages">
            <span>' . $message . '</span>
          </div>
        ';
      }
    }
  ?>

  <h1 style="text-align: center; margin-top:15px;  color:rgb(9, 152, 248);">Place Your Order Here</h1>
  <p style="text-align: center; ">Just one step away from getting your books</p>
  <div class="row">
    <div class="col-75">
      <div class="container">
        <!--Checkout form-->
        <form action="" method="POST">
          <div class="row">
            <!--Billing and shipping address fields-->
            <div class="col-50">
              <h3>Billing Address</h3>
              <label for="fname"><i class="fa fa-user"></i> Full Name</label>
              <input type="text" id="fname" name="username" placeholder="Syaznizam">
              <label for="email"><i class="fa fa-envelope"></i> Email</label>
              <input type="text" id="email" name="email" placeholder="example@gmail.com">
              <label for="email"><i class="fa fa-envelope"></i> Number</label>
              <input type="text" id="email" name="number" placeholder="+601156247802">
              <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
              <input type="text" id="adr" name="address" placeholder="Cheras">
              <label for="city"><i class="fa fa-institution"></i> City</label>
              <input type="text" id="city" name="city" placeholder="Kuala Lumpur">
              <label for="city"><i class="fa fa-institution"></i> State</label>
              <input type="text" id="city" name="state" placeholder="Selangor">

              <div style="padding: 0px;" class="row">
                <div class="col-50">
                  <label for="state">Country</label>
                  <input type="text" id="state" name="country" placeholder="Malaysia">
                </div>
                <div class="col-50">
                  <label for="zip">Zip Code</label>
                  <input type="text" id="zip" name="zipcode" placeholder="56100">
                </div>
              </div>
            </div>

            <div class="col-50">
              <div class="col-25">
                <div class="container">
                  <h4>Books In Cart</h4>
                  <?php
                    $grand_total = 0;
                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE userId = $user_id") or die('query failed');
                    if (mysqli_num_rows($select_cart) > 0) {
                      while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                        $total_price = ($fetch_cart['bookPrice'] * $fetch_cart['quantity']);
                        $grand_total += $total_price;
                  ?>
                        <p> <a href="book_details.php?details=<?php echo $fetch_cart['bookId']; ?>"><?php echo $fetch_cart['bookName']; ?></a><span class="price">(<?php echo 'RM' . number_format($fetch_cart['bookPrice'], 2) . ' x ' . $fetch_cart['quantity']; ?>)</span> </p>
                  <?php
                      }
                    } 
                    else {
                      echo '<p class="empty">Your cart is empty</p>';
                    }
                  ?>
                  <hr>
                  <p>Grand total : <span class="price" style="color:black">RM<b><?php echo number_format($grand_total, 2); ?></b></span></p>
                </div>
              </div>
              <!--Payment method selection-->
              <div style="margin: 20px;">
                <h3>Payment </h3>
                <label for="fname">Accepted Payment Gateways</label>
                <div class="icon-container">
                  <i class="fa fa-cc-visa" style="color:navy;"></i>
                  <i class="fa-brands fa-cc-amazon-pay"></i>
                  <i class="fa-brands fa-google-pay" style="color:red;"></i>
                  <i class="fa fa-cc-paypal" style="color:#3b7bbf;"></i>
                </div>
                <div class="inputBox">
                  <label for="method">Choose Payment Method :</label>
                  <select name="method" id="method">
                    <option value="cash on delivery">Cash on delivery</option>
                    <option value="Debit card">Debit card</option>
                    <option value="Amazon Pay">Amazon Pay</option>
                    <option value="Paypal">Paypal</option>
                    <option value="Google Pay">Google Pay</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <label>
            <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
          </label>
          <input type="submit" name="checkout" value="Continue to checkout" class="btn">
        </form>
      </div>
    </div>
  </div>
  <?php 
    //Include footer
    include 'index_footer.php'; 
  ?>

  <script>
    //Hide message after 5 seconds
    setTimeout(() => {
      const box = document.getElementById('messages');
      box.style.display = 'none';
    }, 5000);
  </script>

</body>
</html>