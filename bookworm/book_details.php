<?php
    include 'config.php';

    //Error reporting disabled
    error_reporting(0);

    //Start session
    session_start();

    //Getting user id from session
    $user_id = $_SESSION['user_id'];

    //Handling form submission to add a book to the cart
    if (isset($_POST['add_to_cart'])) {
        //Checking if user is logged in
        if (!isset($user_id)){
            //Message if user is not logged in
            $message[]= 'You need to login first!';
        }
        else {
            //Extracting data from the add to cart form
            $book_name = $_POST['book_name'];
            $book_id = $_POST['book_id'];
            $book_image = $_POST['book_image'];
            $book_price = $_POST['book_price'];
            $book_quantity = $_POST['quantity'];

            //Calculate total price
            $total_price = number_format($book_price * $book_quantity);

            $existing_book_query = mysqli_query($conn, "SELECT * FROM cart WHERE bookId = $book_id AND userId = $user_id") or die('query failed');
            if (mysqli_num_rows($existing_book_query) > 0) {
                $existing_book_row = mysqli_fetch_assoc($existing_book_query);
                //Updating quantity and total price if book already exists in cart
                $book_quantity += $existing_book_row['quantity'];
                $total_price = $book_price * $book_quantity;
                mysqli_query($conn, "UPDATE cart SET quantity = $book_quantity, total = $total_price WHERE userId = $user_id AND bookId = $book_id") or die('query failed');
                $message[] = "Book Added To The Cart";
            }
            else {
                //Inserting new book entry into cart if it doesn't exist
                mysqli_query($conn, "INSERT INTO cart (userId, bookId, bookName, bookPrice, bookImage, quantity ,total) VALUES ('$user_id','$book_id','$book_name','$book_price','$book_image','$book_quantity', '$total_price')") or die('Add to cart Query failed');
                $message[] = 'Book Added To The Cart';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index_book.css">
    <title><?php
        if (isset($_GET['details'])) {
            $get_id = $_GET['details'];
            $get_book = mysqli_query($conn, "SELECT * FROM `bookdetails` WHERE bookId = '$get_id'") or die('query failed');
            if (mysqli_num_rows($get_book) > 0) {
                $fetch_book = mysqli_fetch_assoc($get_book);
                echo $fetch_book['bookName'];
            }
        }
    ?>
    </title>

    <style>
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
        //Include header
        include 'index_header.php';
    ?>

    <?php
        //Display message if any
        if(isset($message)){
            foreach($message as $message){
                echo '
                <div class="message" id= "messages"><span>'.$message.'</span>
                </div>
            ';
            }
        }
    ?>

    <div class="details">
        <?php
            //Displaying book details
            if (isset($_GET['details'])) {
                $get_id = $_GET['details'];
                $get_book = mysqli_query($conn, "SELECT * FROM `bookdetails` WHERE bookId = '$get_id'") or die('query failed');
                if (mysqli_num_rows($get_book) > 0) {
                    while ($fetch_book = mysqli_fetch_assoc($get_book)) {
        ?>
                        <div class="row_box">
                            <form style="display: flex ;" action="" method="POST">
                                <div class="col_box">
                                    <img src="./book_image/<?php echo $fetch_book['bookImage']; ?>" alt="<?php echo $fetch_book['bookName']; ?>">
                                </div>
                                <div class="col_box">
                                    <h1>Name: <?php echo $fetch_book['bookName']; ?></h1>
                                    <h4><i>By <?php echo $fetch_book['authorName']; ?></i></h4>
                                    <p><?php echo $fetch_book['bookDescription']; ?></p>
                                    <h3>Price: RM<?php echo number_format($fetch_book['bookPrice'], 2); ?></h3>
                                    <label for="quantity">Quantity: </label>
                                    <input type="number" name="quantity" value="1" min="1" max="10" id="quantity">
                                    <div class="buttons">
                                        <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['bookName'] ?>">
                                        <input class="hidden_input" type="hidden" name="book_id" value="<?php echo $fetch_book['bookId'] ?>">
                                        <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['bookImage'] ?>">
                                        <input class="hidden_input" type="hidden" name="book_price" value="<?php echo number_format($fetch_book['bookPrice'], 2) ?>">
                                        <input type="submit" name="add_to_cart" value="Add To Cart" class="btn" style="cursor:pointer;">
                                        <button name="add_to_cart" style="cursor:pointer;"><img style="height: 40px;" src="./images/cart1.png" alt="Add to cart"></button>
                                    </div>
                                </div>
                            </form>
                        </div>
        <?php
                    }
                }
            } 
            else {
                echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
            }
        ?>
    </div>
    
    <script src="./js/admin.js"></script>
    <script>
        //Hide message after 5 seconds
        setTimeout(() => {
        const box = document.getElementById('messages');
        box.style.display = 'none';
        }, 5000);
    </script>

</body>
</html>