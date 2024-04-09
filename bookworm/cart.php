<?php
    include 'config.php';

    //Start session 
    session_start();

    //Retrieve user ID and user name from session
    $user_id = $_SESSION['user_id'];
    $user_name =$_SESSION['user_name'];
    
    //Redirect to login page if user isn't logged in
    if(!isset($user_id)){
        header('location:login.php');
    }

    //Remove item from cart if the user click remove button
    if(isset($_GET['remove'])){
        $remove_id=$_GET['remove'];
        mysqli_query($conn, "DELETE FROM `cart` WHERE cartId='$remove_id'") or die('query failed');
        $message[]='The book has been removed from the cart';
        header('location:cart.php');
    }

    //Update cart if 'update' button cart is clicked
    if(isset($_POST['update'])){
        $update_cart_id =$_POST['cart_id'];
        $book_price=$_POST['book_price'];
        $update_quantity =$_POST['update_quantity'];
        $total_price = $book_price * $update_quantity;
        mysqli_query($conn, "UPDATE `cart` SET `quantity` = '$update_quantity', `total` = '$total_price' WHERE `cartId` = '$update_cart_id'") or die('query failed');
    
        $message[]=''.$user_name.' Your cart updated successfully';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/hello.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <style>
        .cart-btn1,.cart-btn2{        
            display: inline-block;
            margin: auto;
            padding:0.8rem 1.2rem;
            cursor: pointer;
            color:white;
            font-size: 15px;
            border-radius: .5rem;
            text-transform: capitalize;
        }

        .cart-btn1{
            margin-left: 40%;
            background-color: #ffa41c;
            color: black;
        }

        .cart-btn2{
            background-color: rgb(0, 167, 245);
            color: black;
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
</head>
<body>
    <?php
        include 'index_header.php';
    ?>
    <div class="cart_form">
    <?php
        //Display message if any
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
        <table style="width: 70%; align-items:center; margin:10px auto;">
            <thead>
                <th>Image</th>
                <th>Name</th>
                <th>price</th>
                <th>Quantity</th>
                <th>Total RM</th>
            </thead>
            <tbody>                
                <?php
                    $total = 0;
                    //Select books from cart for the current user
                    $select_book = $conn->query("SELECT cartId, bookName, bookPrice, bookImage, quantity, total FROM cart Where userId= $user_id");
                    if ($select_book->num_rows  > 0) {
                        while ($row = $select_book->fetch_assoc()) {
                ?>
                        <tr>
                            <td><img style="height: 90px;" src="./book_image/<?php echo $row['bookImage']; ?>" alt=""></td>
                            <td><?php echo $row['bookName']; ?></td>
                            <td><?php echo number_format($row['bookPrice'], 2); ?></td>
                            <td>
                                <!--Form for updating quantity-->
                                <form action="" method="POST">
                                    <input type="number" name="update_quantity" min="1" max="10" value="<?php echo $row['quantity']; ?>">
                                    <input type="hidden" name="cart_id" value="<?php echo $row['cartId']; ?>">
                                    <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $row['bookPrice'] ?>">
                                <button style="background:transparent ;" name="update">
                                    <img style="height: 26px; cursor:pointer;" src="./images/updates.png" alt="update">
                                </button> | 
                                <a style="color: red;" href="cart.php?remove=<?php echo $row['cartId'];?>"> Remove</a>
                                </form>
                            </td>
                            <td>
                                <?php 
                                    //Calculate subtotal for each item
                                    $sub_total = number_format($row['bookPrice'], 2) * $row['quantity']; 
                                    echo number_format($sub_total, 2); 
                                ?>
                            </td>
                        </tr>
                <?php
                    //Calculate total price
                    $total += $sub_total;
                        }
                    } 
                    else {
                        echo '<p class="empty">There is nothing in cart yet !</p>';
                    }
                ?>
                <tr>
                    <th style="text-align:center;" colspan="3">Total</th>
                    <th colspan="2">RM<?php echo number_format($total, 2); ?></th>
                </tr>  
            </tbody>
        </table>
        <!--Proceed to checkout button-->
        <a href="checkout.php" class="btn cart-btn1" 
            style="display:<?php 
                                if($total>1){ 
                                    echo 'inline-block'; 
                                }
                                else{ 
                                    echo 'none'; 
                                };?>" > &nbsp; Proceed to Checkout
        </a>
        <!--Continue shopping button-->
        <a class="cart-btn2" href="index.php" style="justify-content:center;">
            Continue Shopping
        </a>
    </div>

    <?php 
        include'index_footer.php'; 
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