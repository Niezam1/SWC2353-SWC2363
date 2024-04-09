<?php
    //Connect to the database server
    include 'config.php';

    //Error reporting disabled
    error_reporting(0);

    //Starting session
    session_start();

    //Retrieving user ID from session
    $user_id = $_SESSION['user_id'];

    //Handling add to cart functionality
    if (isset($_POST['add_to_cart'])) {
        //Checking if user is logged in
        if (!isset($user_id)) {
            $message[] = 'You need to login first :)';
        } 
        else {
            //Retrieving book details from form submission
            $book_name = $_POST['book_name'];
            $book_id = $_POST['book_id'];
            $book_image = $_POST['book_image'];
            $book_price = $_POST['book_price'];
            $book_quantity = '1';

            //Calculating total price
            $total_price = number_format($book_price * $book_quantity);

            //Checking if the book already exists in the cart
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
    <link rel="stylesheet" href="css/hello.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
    <title>Bookworm</title>
    <style>
        img {
            border: none;
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
        //Include header section 
        include 'index_header.php' 
    ?>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
        <div class="message" id= "messages"><span>' . $message . '</span>
        </div>
        ';
        }
    }
    ?>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--Carousel-->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <!--Indicators-->
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <!--Slides-->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100 " src="https://source.unsplash.com/2200x800/?books" alt="First slide">
            </div>

            <div class="carousel-item">
                <img class="d-block w-100" src="https://source.unsplash.com/2200x800/?novel books" alt="Second slide">
            </div>

            <div class="carousel-item">
                <img class="d-block w-100" src="https://source.unsplash.com/2200x800/?pyshological books" alt="Third slide">
            </div>
        </div>
        <!--Controls-->
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!--Section for new arrivals-->
    <section id="New">
        <div class="container px-5 mx-auto">
            <h2 class="m-8 font-extrabold text-4xl text-center border-t-2 " style="color: rgb(0, 167, 245);">
                New Arrival
            </h2>
        </div>
    </section>
    <!--Section for displaying new arrival books-->
    <section class="show-products">
        <div class="box-container">
            <?php
            //Retrieving new arrival books from database
            $select_book = mysqli_query($conn, "SELECT * FROM `bookdetails` ORDER BY date DESC LIMIT 8") or die('query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($select_book)) {
            ?>
                    <div class="box" style="width: 255px; height:355px;">
                        <!--Displaying book image-->
                        <a href="book_details.php?details=<?php echo $fetch_book['bookId'];
                                                            echo '-name=', $fetch_book['bookName']; ?>">
                            <img style="height: 200px;width: 125px;margin: auto;" class="books_images" 
                                    src="book_image/<?php echo $fetch_book['bookImage']; ?>" alt="">
                        </a>
                        <!--Displaying book name-->
                        <div style="text-align:left ;">
                            <div style="font-weight: 500; font-size:18px; text-align: center; " class="name">
                                <?php echo $fetch_book['bookName']; ?>
                            </div>
                        </div>
                        <!--Displaying book price-->
                        <div class="price">
                            Price: RM<?php echo number_format($fetch_book['bookPrice'], 2); ?>
                        </div>
                        <!--Form for adding book to cart-->
                        <form action="" method="POST">
                            <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['bookName'] ?>">
                            <input class="hidden_input" type="hidden" name="book_id" value="<?php echo $fetch_book['bookId'] ?>">
                            <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['bookImage'] ?>">
                            <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['bookPrice'] ?>">
                            <button onclick="myFunction()" name="add_to_cart"><img src="./images/cart2.png" alt="Add to cart">
                                <a href="book_details.php?details=<?php echo $fetch_book['bookId'];
                                                                    echo '-name=', $fetch_book['bookName']; ?>" 
                                                                    class="update_btn">Know More
                                </a>
                        </form>
                    </div>
            <?php
                }
            } 
            else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>
    <!--Section for Non-Fiction-->
    <section id="Non-Fiction">
        <div class="container px-5 mx-auto">
            <h2 class="text-gray-400 m-8 font-extrabold text-4xl text-center border-t-2 text-red-800" style="color: rgb(0, 167, 245);" >
                Non-Fiction
            </h2>
        </div>
    </section>
    <!--Section for displaying Non-Fiction books-->
    <section class="show-products">
        <div class="box-container">
            <?php
            //Retrieving Non-Fiction books from database
            $select_book = mysqli_query($conn, "SELECT * FROM `bookdetails` WHERE bookGenre='Non-Fiction'") or die('query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($select_book)) {
            ?>
                    <div class="box" style="width: 255px;height: 355px;">
                        <!--Displaying book image-->
                        <a href="book_details.php?details=<?php echo $fetch_book['bookId'];
                                                            echo '-name=', $fetch_book['bookName']; ?>"> 
                            <img style="height: 200px;width: 125px;margin: auto;" class="books_images" 
                                src="book_image/<?php echo $fetch_book['bookImage']; ?>" alt="">
                        </a>
                        <!--Displaying book name-->
                        <div style="text-align:left ;">
                            <div style="font-weight: 500; font-size:18px; text-align: center; " class="name">
                                <?php echo $fetch_book['bookName']; ?>
                            </div>
                        </div>
                        <!--Displaying book price-->
                        <div class="price">
                            Price: RM<?php echo number_format($fetch_book['bookPrice'], 2); ?>
                        </div>
                        <!--Form for adding book to cart-->
                        <form action="" method="POST">
                            <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['bookName'] ?>">
                            <input class="hidden_input" type="hidden" name="book_id" value="<?php echo $fetch_book['bookId'] ?>">
                            <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['bookImage'] ?>">
                            <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['bookPrice'] ?>">
                            <button name="add_to_cart"><img src="./images/cart2.png" alt="Add to cart">
                                <a href="book_details.php?details=<?php echo $fetch_book['bookId'];
                                                                    echo '-name=', $fetch_book['bookName']; ?>" 
                                                                    class="update_btn">Know More
                                </a>
                        </form>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>
    <hr style="color: black; width:5px;">
    <!--Section for Sci-Fi-->
    <section id="Sci-Fi">
        <div class="container px-5 mx-auto">
            <h2 class="text-gray-400 m-8 font-extrabold text-4xl text-center border-t-2 text-red-800"style="color: rgb(0, 167, 245);">
                Science Fiction
            </h2>
        </div>
    </section>
    <!--Section for displaying Sci-Fi books-->
    <section class="show-products">
        <div class="box-container">
            <?php
            //Retrieving Sci-Fi books from database
            $select_book = mysqli_query($conn, "SELECT * FROM `bookdetails` WHERE bookGenre='Sci-Fi'") or die('query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($select_book)) {
            ?>
                    <div class="box" style="width: 255px;height: 355px;">
                        <!--Displaying book image-->
                        <a href="book_details.php?details=<?php echo $fetch_book['bookId'];
                                                            echo '-name=', $fetch_book['bookName']; ?>">
                            <img style="height: 200px;width: 125px;margin: auto;" class="books_images" 
                            src="book_image/<?php echo $fetch_book['bookImage']; ?>" alt="">
                        </a>
                        <!--Displaying book name-->
                        <div style="text-align:left ;">
                            <div style="font-weight: 500; font-size:18px; text-align: center;" class="name">
                                <?php echo $fetch_book['bookName']; ?>
                            </div>
                        </div>
                        <!--Displaying book price-->
                        <div class="price">
                            Price: RM<?php echo number_format($fetch_book['bookPrice'], 2); ?>
                        </div>
                        <!--Form for adding book to cart-->
                        <form action="" method="POST">
                            <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['bookName'] ?>">
                            <input class="hidden_input" type="hidden" name="book_id" value="<?php echo $fetch_book['bookId'] ?>">
                            <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['bookImage'] ?>">
                            <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['bookPrice'] ?>">
                            <button name="add_to_cart"><img src="./images/cart2.png" alt="Add to cart">
                                <a href="book_details.php?details=<?php echo $fetch_book['bookId'];
                                                                    echo '-name=', $fetch_book['bookName']; ?>" 
                                                                    class="update_btn">Know More
                                </a>
                        </form>
                    </div>
            <?php
                }
            } 
            else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>
    <!--Section for Fantasy-->
    <section id="Fantasy">
        <div class="container px-5 mx-auto">
            <h2 class="text-gray-400 m-8 font-extrabold text-4xl text-center border-t-2 text-red-800" style="color: rgb(0, 167, 245);">
                Fantasy
            </h2>
        </div>
    </section>
    <!--Section for displaying Fantasy books-->
    <section class="show-products">
        <div class="box-container">

            <?php
            //Retrieving Fantasy books from database
            $select_book = mysqli_query($conn, "SELECT * FROM `bookdetails` WHERE bookGenre='Fantasy'") or die('query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($select_book)) {
            ?>
                    <div class="box" style="width: 255px;height: 355px;">
                        <!--Displaying book image-->
                        <a href="book_details.php?details=<?php echo $fetch_book['bookId'];
                                                            echo '-name=', $fetch_book['bookName']; ?>">
                                                            <img style="height: 200px;width: 125px;margin: auto;" class="books_images" 
                                                            src="book_image/<?php echo $fetch_book['bookImage']; ?>" alt="">
                        </a>
                        <!--Displaying book name-->
                        <div style="text-align:left ;">
                            <div style="font-weight: 500; font-size:18px; text-align: center;" class="name">
                                <?php echo $fetch_book['bookName']; ?>
                            </div>
                        </div>
                        <!--Displaying book price-->
                        <div class="price">
                            Price: RM<?php echo number_format($fetch_book['bookPrice'], 2); ?>
                        </div>
                        <!--Form for adding book to product-->
                        <form action="" method="POST">
                            <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['bookName'] ?>">
                            <input class="hidden_input" type="hidden" name="book_id" value="<?php echo $fetch_book['bookId'] ?>">
                            <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['bookImage'] ?>">
                            <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['bookPrice'] ?>">
                            <button name="add_to_cart"><img src="./images/cart2.png" alt="Add to cart">
                                <a href="book_details.php?details=<?php echo $fetch_book['bookId'];
                                                                    echo '-name=', $fetch_book['bookName']; ?>" 
                                                                    class="update_btn">Know More
                                </a>
                        </form>
                    </div>
            <?php
                }
            } 
            else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>
    <!--Section for Mystery-->
    <section id="Mystery">
        <div class="container px-5 mx-auto">
            <h2 class="text-gray-400 m-8 font-extrabold text-4xl text-center border-t-2 text-red-800" style="color: rgb(0, 167, 245);">
                Mystery
            </h2>
        </div>
    </section>
    <!--Section for displaying Mystery books-->
    <section class="show-products">
        <div class="box-container">
            <?php
            //Retrieving Mystery books from database
            $select_book = mysqli_query($conn, "SELECT * FROM `bookdetails` WHERE bookGenre='Mystery'") or die('query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($select_book)) {
            ?>
                    <div class="box" style="width: 255px;height: 355px;">
                        <!--Displaying book image-->
                        <a href="book_details.php?details=<?php echo $fetch_book['bookId'];
                                                            echo '-name=', $fetch_book['bookName']; ?>"> 
                            <img style="height: 200px;width: 125px;margin: auto;" class="books_images" 
                                src="book_image/<?php echo $fetch_book['bookImage']; ?>" alt="">
                        </a>
                        <!--Displaying book name-->
                        <div style="text-align:left ;">
                            <div style="font-weight: 500; font-size:18px; text-align: center;" class="name">
                                <?php echo $fetch_book['bookName']; ?>
                            </div>
                        </div>
                        <!--Displaying book price-->
                        <div class="price">
                            Price: RM<?php echo number_format($fetch_book['bookPrice'], 2); ?>
                        </div>
                        <!--Form for adding book to cart-->
                        <form action="" method="POST">
                            <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['bookName'] ?>">
                            <input class="hidden_input" type="hidden" name="book_id" value="<?php echo $fetch_book['bookId'] ?>">
                            <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['bookImage'] ?>">
                            <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['bookPrice'] ?>">
                            <button name="add_to_cart"><img src="./images/cart2.png" alt="Add to cart">
                                <a href="book_details.php?details=<?php echo $fetch_book['bookId'];
                                                                    echo '-name=', $fetch_book['bookName']; ?>" 
                                                                    class="update_btn">Know More
                                </a>
                        </form>
                    </div>
            <?php
                }
            } 
            else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>
    <!--Section for Horror-->
    <section id="Horror">
        <div class="container px-5 mx-auto">
            <h2 class="text-gray-400 m-8 font-extrabold text-4xl text-center border-t-2 text-red-800" style="color: rgb(0, 167, 245);">
                Horror
            </h2>
        </div>
    </section>
    <!--Section for displaying Horror books-->
    <section class="show-products">
        <div class="box-container">
            <?php
            //Retrieving Horror books from database
            $select_book = mysqli_query($conn, "SELECT * FROM `bookdetails` WHERE bookGenre='Horror'") or die('query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($select_book)) {
            ?>
                    <div class="box" style="width: 255px;height: 355px;">
                    <!--Displaying book image-->
                        <a href="book_details.php?details=<?php echo $fetch_book['bookId'];
                                                            echo '-name=', $fetch_book['bookName']; ?>">
                            <img style="height: 200px;width: 125px;margin: auto;" class="books_images" 
                                src="book_image/<?php echo $fetch_book['bookImage']; ?>" alt="">
                        </a>
                        <!--Displaying book name-->
                        <div style="text-align:left ;">
                            <div style="font-weight: 500; font-size:18px; text-align: center;" class="name">
                                <?php echo $fetch_book['bookName']; ?>
                            </div>
                        </div>
                        <!--Displaying book price-->
                        <div class="price">
                            Price: RM<?php echo number_format($fetch_book['bookPrice'], 2); ?>
                        </div>
                        <!--Form for adding book to cart-->
                        <form action="" method="POST">
                            <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['bookName'] ?>">
                            <input class="hidden_input" type="hidden" name="book_id" value="<?php echo $fetch_book['bookId'] ?>">
                            <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['bookImage'] ?>">
                            <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['bookPrice'] ?>">
                            <button name="add_to_cart"><img src="./images/cart2.png" alt="Add to cart">
                                <a href="book_details.php?details=<?php echo $fetch_book['bookId'];
                                                                    echo '-name=', $fetch_book['bookName']; ?>" 
                                                                    class="update_btn">Know More
                                </a>
                        </form>
                    </div>
            <?php
                }
            } 
            else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>
    <!--Section for Thriller-->
    <section id="Thriller">
        <div class="container px-5 mx-auto">
            <h2 class="text-gray-400 m-8 font-extrabold text-4xl text-center border-t-2 text-red-800" style="color: rgb(0, 167, 245);">
                Thriller
            </h2>
        </div>
    </section>
    <!--Section for displaying Thriller books-->
    <section class="show-products">
        <div class="box-container">
            <?php
            //Retrieving Thriller books from database
            $select_book = mysqli_query($conn, "SELECT * FROM `bookdetails` WHERE bookGenre='Thriller'") or die('query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($select_book)) {
            ?>
                    <div class="box" style="width: 255px;height: 355px;">
                    <!--Displaying book image-->
                        <a href="book_details.php?details=<?php echo $fetch_book['bookId'];
                                                            echo '-name=', $fetch_book['bookName']; ?>">
                            <img style="height: 200px;width: 125px;margin: auto;" class="books_images" 
                                src="book_image/<?php echo $fetch_book['bookImage']; ?>" alt="">
                        </a>
                        <!--Displaying book name-->
                        <div style="text-align:left ;">
                            <div style="font-weight: 500; font-size:18px; text-align: center;" class="name">
                                <?php echo $fetch_book['bookName']; ?>
                            </div>
                        </div>
                        <!--Displaying book price-->
                        <div class="price">
                            Price: RM<?php echo number_format($fetch_book['bookPrice'], 2); ?>
                        </div>
                        <!--Form for adding book to cart-->
                        <form action="" method="POST">
                            <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['bookName'] ?>">
                            <input class="hidden_input" type="hidden" name="book_id" value="<?php echo $fetch_book['bookId'] ?>">
                            <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['bookImage'] ?>">
                            <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['bookPrice'] ?>">
                            <button name="add_to_cart"><img src="./images/cart2.png" alt="Add to cart">
                                <a href="book_details.php?details=<?php echo $fetch_book['bookId'];
                                                                    echo '-name=', $fetch_book['bookName']; ?>" 
                                                                    class="update_btn">Know More
                                </a>
                        </form>
                    </div>
            <?php
                }
            } 
            else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>
    <!--Section for Comedy-->
    <section id="Comedy">
        <div class="container px-5 mx-auto">
            <h2 class="text-gray-400 m-8 font-extrabold text-4xl text-center border-t-2 text-red-800" style="color: rgb(0, 167, 245);">
                Comedy
            </h2>
        </div>
    </section>
    <!--Section for displaying Comedy books-->
    <section class="show-products">
        <div class="box-container">
            <?php
            //Retrieving Comedy books from database
            $select_book = mysqli_query($conn, "SELECT * FROM `bookdetails` WHERE bookGenre='Comedy'") or die('query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($select_book)) {
            ?>
                    <div class="box" style="width: 255px;height: 355px;">
                        <!--Displaying book image-->
                        <a href="book_details.php?details=<?php echo $fetch_book['bookId'];
                                                            echo '-name=', $fetch_book['bookName']; ?>">
                            <img style="height: 200px;width: 125px;margin: auto;" class="books_images" 
                                src="book_image/<?php echo $fetch_book['bookImage']; ?>" alt="">
                        </a>
                        <!--Displaying book name-->
                        <div style="text-align:left ;">
                            <div style="font-weight: 500; font-size:18px; text-align: center;" class="name">
                                <?php echo $fetch_book['bookName']; ?>
                            </div>
                        </div>
                        <!--Displaying book price-->
                        <div class="price">
                            Price: RM<?php echo number_format($fetch_book['bookPrice'], 2); ?>
                        </div>
                        <!--Form for adding book to cart-->
                        <form action="" method="POST">
                            <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['bookName'] ?>">
                            <input class="hidden_input" type="hidden" name="book_id" value="<?php echo $fetch_book['bookId'] ?>">
                            <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['bookImage'] ?>">
                            <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['bookPrice'] ?>">
                            <button name="add_to_cart"><img src="./images/cart2.png" alt="Add to cart">
                                <a href="book_details.php?details=<?php echo $fetch_book['bookId'];
                                                                    echo '-name=', $fetch_book['bookName']; ?>" 
                                                                    class="update_btn">Know More
                                </a>
                        </form>
                    </div>
            <?php
                }
            } 
            else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>
    <!--Section for Drama-->
    <section id="Drama">
        <div class="container px-5 mx-auto">
            <h2 class="text-gray-400 m-8 font-extrabold text-4xl text-center border-t-2 text-red-800" style="color: rgb(0, 167, 245);">
                Drama
            </h2>
        </div>
    </section>
    <!--Section for displaying Drama books-->
    <section class="show-products">
        <div class="box-container">
            <?php
            //Retrieving Drama books from database
            $select_book = mysqli_query($conn, "SELECT * FROM `bookdetails` WHERE bookGenre='Drama'") or die('query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($select_book)) {
            ?>
                    <div class="box" style="width: 255px;height: 355px;">
                        <!--Displaying book image-->
                        <a href="book_details.php?details=<?php echo $fetch_book['bookId'];
                                                            echo '-name=', $fetch_book['bookName']; ?>">
                            <img style="height: 200px;width: 125px;margin: auto;" class="books_images" 
                                src="book_image/<?php echo $fetch_book['bookImage']; ?>" alt="">
                        </a>
                        <!--Displaying book name-->
                        <div style="text-align:left ;">
                            <div style="font-weight: 500; font-size:18px; text-align: center;" class="name">
                                <?php echo $fetch_book['bookName']; ?>
                            </div>
                        </div>
                        <!--Displaying book price-->
                        <div class="price">
                            Price: RM<?php echo number_format($fetch_book['bookPrice'], 2); ?>
                        </div>
                        <!--Form for adding book to cart-->
                        <form action="" method="POST">
                            <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['bookName'] ?>">
                            <input class="hidden_input" type="hidden" name="book_id" value="<?php echo $fetch_book['bookId'] ?>">
                            <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['bookImage'] ?>">
                            <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['bookPrice'] ?>">
                            <button name="add_to_cart"><img src="./images/cart2.png" alt="Add to cart">
                                <a href="book_details.php?details=<?php echo $fetch_book['bookId'];
                                                                    echo '-name=', $fetch_book['bookName']; ?>" 
                                                                    class="update_btn">Know More
                                </a>
                        </form>
                    </div>
            <?php
                }
            } 
            else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>

    <!--Footer Section-->
    <?php include 'index_footer.php'; ?>

    <!--Hide message after 8 seconds-->
    <script>
        setTimeout(() => {
            const box = document.getElementById('messages');
            box.style.display = 'none';
        }, 8000);
    </script>

</body>
</html>