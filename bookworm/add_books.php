<?php
  include 'config.php';

  //Session start
  session_start();

  //Retrieve admin ID from session
  $admin_id = $_SESSION['admin_id'];

  //Redirect to login page if the user isn't logged in
  if(!isset($admin_id)){
    header('location:login.php');
  };

  //Add books to database if add book button is clicked
  if (isset($_POST['add_books'])) {
    $book_name = mysqli_real_escape_string($conn, $_POST['book_name']);
    $author_name = mysqli_real_escape_string($conn, $_POST['author_name']);
    $book_genre = mysqli_real_escape_string($conn, $_POST['book_genre']);
    $book_price = $_POST['book_price'];
    $book_desc = mysqli_real_escape_string($conn, ($_POST['book_description']));
    $book_image = $_FILES["book_image"]["name"];
    $img_temp_name = $_FILES["book_image"]["tmp_name"];
    $img_file = "./book_image/" . $book_image;

    // Validate input fields
    if (empty($book_name)) {
      $message[] = 'Please enter the book name';
    } elseif (empty($author_name)) {
      $message[] = 'Please enter the author name';
    } elseif (empty($book_price)) {
      $message[] = 'Please enter the book price';
    } elseif (empty($book_genre)) {
      $message[] = 'Please select the book genre';
    } elseif (empty($book_desc)) {
      $message[] = 'Please enter the book descriptions';
    } elseif (empty($book_image)) {
      $message[] = 'Please upload the book image';
    } 
    else {
      //Insert new book details into database
      $add_book = mysqli_query($conn, "INSERT INTO bookdetails(`bookName`, `authorName`, `bookPrice`, `bookGenre`, `bookDescription`, `bookImage`) VALUES('$book_name','$author_name','$book_price','$book_genre','$book_desc','$book_image')") or die('Query failed');

      //Move uploaded image to specified directory
      if ($add_book) {
        move_uploaded_file($img_temp_name, $img_file);
        $message[] = 'New Book Added Successfully :)';
      } 
      else {
        $message[] = "Book Couldn't Be Added :(";
      }
    }
  }

  //Delete book from database if delete button is clicked
  if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `bookdetails` WHERE bookId = '$delete_id'") or die('query failed');
    header('location:add_books.php');
  }

  //Update book details in database if update book button is clicked
  if(isset($_POST['update_book'])){
    $update_book_id = $_POST['update_book_id'];
    $update_book_name = $_POST['update_book_name'];
    $update_author_name = $_POST['update_author_name'];
    $update_book_genre = $_POST['update_book_genre'];
    $update_book_description = $_POST['update_book_description'];
    $update_book_price = $_POST['update_book_price'];

    //Update book details
    mysqli_query($conn, "UPDATE `bookdetails` SET bookName = '$update_book_name', authorName='$update_author_name', bookDescription ='$update_book_description', bookPrice = '$update_book_price', bookGenre='$update_book_genre' WHERE bookId = '$update_book_id'") or die('query failed');

    $update_book_image = $_FILES['update_book_image']['bookName'];
    $update_image_tmp_name = $_FILES['update_book_image']['tmp_name'];
    $update_image_size = $_FILES['update_book_image']['size'];
    $update_folder = './book_image/'.$update_book_image;
    $update_old_image = $_POST['update_old_image'];

    //Update book image if a new image is uploaded
    if(!empty($update_image)){
      if($update_image_size > 2000000){
        $message[] = 'Image file size is too big';
      }else{
        mysqli_query($conn, "UPDATE `bookdetails` SET bookImage = '$update_book_image' WHERE bookId = '$update_book_id'") or die('query failed');
        move_uploaded_file($update_image_tmp_name, $update_folder);
        unlink('uploaded_img/'.$update_old_image);
      }
    }    
    header('location:./add_books.php');
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/register.css">
  <title>Add Books</title>
</head>

<body>
  <?php
    //Include the header file
    include 'admin_header.php'
  ?>

  <?php
    //Display message if any
    if (isset($message)) {
      foreach ($message as $message) {
        echo '
        <div class="message" id="messages"><span>' . $message . '</span>
        </div>
        ';
      }
    }
  ?>
  
  <!--Button to view all books-->
  <a class="update_btn" style="position: fixed ; z-index:100;" href="total_books.php">See All Books</a>

  <div class="container_box">
    <!--Form to add new books-->
    <form action="" method="POST" enctype="multipart/form-data">
      <h3>Add Books To <a href="index.php"><span>Book</span><span>worm</span></a></h3>
      <input type="text" name="book_name" placeholder="Enter Book Name" class="text_field ">
      <input type="text" name="author_name" placeholder="Enter Author name" class="text_field">
      <input type="number" min="0" step="0.01" name="book_price" class="text_field" placeholder="Enter Book Price">
      <select name="book_genre" id="" required class="text_field">
        <option value="Non-Fiction">Non-Fiction</option>
        <option value="Sci-Fi">Sci-Fi</option>
        <option value="Fantasy">Fantasy</option>
        <option value="Mystery">Mystery</option>
        <option value="Horror">Horror</option>
        <option value="Thriller">Thriller</option>
        <option value="Comedy">Comedy</option>
        <option value="Drama">Drama</option>
      </select>
      <textarea name="book_description" placeholder="Enter book description" id="" class="text_field" cols="18" rows="5"></textarea>
      <input type="file" name="book_image" accept="image/jpg, image/jpeg, image/png" class="text_field">
      <input type="submit" value="Add Book" name="add_books" class="btn text_field">
    </form>
  </div>

  <section class="edit-product-form">
    <!--Form to edit book details-->
    <?php
      if(isset($_GET['update'])){
        $update_id = $_GET['update'];
        $update_query = mysqli_query($conn, "SELECT * FROM `bookdetails` WHERE bookId = '$update_id'") or die('query failed');
        if(mysqli_num_rows($update_query) > 0){
          while($fetch_update = mysqli_fetch_assoc($update_query)){
    ?>
            <form action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="update_book_id" value="<?php echo $fetch_update['bookId']; ?>">
              <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['bookImage']; ?>">
              <img src="./book_image/<?php echo $fetch_update['bookImage']; ?>" alt="">
              <input type="text" name="update_book_name" value="<?php echo $fetch_update['bookName']; ?>" class="box" required placeholder="Enter Book Name">
              <input type="text" name="update_author_name" value="<?php echo $fetch_update['authorName']; ?>" class="box" required placeholder="Enter Author Name">
              <select name="update_book_genre" value="<?php echo $fetch_update['bookGenre']; ?> required class="text_field">
                <option value="Non-Fiction">Non-Fiction</option>
                <option value="Sci-Fi">Sci-Fi</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Mystery">Mystery</option>
                <option value="Horror">Horror</option>
                <option value="Thriller">Thriller</option>
                <option value="Comedy">Comedy</option>
                <option value="Drama">Drama</option>
              </select>
              <input type="text" name="update_book_description" value="<?php echo $fetch_update['bookDescription']; ?>" class="box" required placeholder="Enter book description">
              <input type="number" name="update_book_price" value="<?php echo number_format($fetch_update['bookPrice'], 2); ?>" min="0" step="0.01" class="box" required placeholder="Enter book price">
              <input type="file" class="box" name="update_book_image" accept="image/jpg, image/jpeg, image/png">
              <input type="submit" value="update" name="update_book" class="delete_btn" style="cursor:pointer;">
              <input type="reset" value="cancel" id="close-update" class="update_btn" style="cursor:pointer;">
            </form>
    <?php
          }
        }
      }
      else{
      echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
    ?>
  </section>
  <section class="show-products">
    <div class="box-container">
      <!--Display 2 most recent added books-->
      <?php
        $select_book = mysqli_query($conn, "SELECT * FROM bookdetails ORDER BY date DESC LIMIT 2;") or die('query failed');
        if(mysqli_num_rows($select_book) > 0){
          while($fetch_book = mysqli_fetch_assoc($select_book)){
      ?>
      <div class="box">
        <img class="books_images" src="book_image/<?php echo $fetch_book['bookImage']; ?>" alt="">
        <div class="name">Author: <?php echo $fetch_book['authorName']; ?></div>
        <div class="name">Name: <?php echo $fetch_book['bookName']; ?></div>
        <div class="price">Price: RM<?php echo number_format($fetch_book['bookPrice'], 2); ?></div>
        <a href="add_books.php?update=<?php echo $fetch_book['bookId']; ?>" class="update_btn">Update</a>
        <a href="add_books.php?delete=<?php echo $fetch_book['bookId']; ?>" class="delete_btn" onclick="return confirm('Delete this product?');">Delete</a>
      </div>
      <?php
          }
        }else{
          echo '<p class="empty">no products added yet!</p>';
        }
      ?>
    </div>
  </section>

  <script src="admin.js"></script>
  <script>
    //Hide messages after 8 seconds
    setTimeout(() => {
    const box = document.getElementById('messages');
    box.style.display = 'none';
    }, 8000);
  </script>
  
</body>
</html>