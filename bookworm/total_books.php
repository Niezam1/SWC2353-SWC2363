<?php
   include 'config.php';

   //Start session
   session_start();

   //Retrieving admin ID from session
   $admin_id = $_SESSION['admin_id'];

   //Handling book deletion
   if(isset($_GET['delete'])){
      $delete_id = $_GET['delete'];
      mysqli_query($conn, "DELETE FROM `bookdetails` WHERE bookId = '$delete_id'") or die('query failed');
      header('location:total_books.php');
   }

   //Handling book update
   if(isset($_POST['update_book'])){
      //Retrieving updated book details from form
      $update_book_id = $_POST['update_book_id'];
      $update_book_name = $_POST['update_book_name'];
      $update_author_name = $_POST['update_author_name'];
      $update_book_description = $_POST['update_book_description'];
      $update_book_price = $_POST['update_book_price'];
      $update_book_genre = $_POST['update_book_genre'];

      //Prepare the SQL statement for updating book details
      $query = "UPDATE bookdetails SET bookName = ?, authorName = ?, bookDescription = ?, bookPrice = ?, bookGenre = ? WHERE bookId = ?";
      $stmt = mysqli_prepare($conn, $query);

      //Bind parameters
      mysqli_stmt_bind_param($stmt, "sssssi", $update_book_name, $update_author_name, $update_book_description, $update_book_price, $update_book_genre, $update_book_id);

      //Execute the statement
      mysqli_stmt_execute($stmt);

      //Check if the query was successful
      if(mysqli_stmt_affected_rows($stmt) > 0) {
         echo "Update successful";
      } 
      else {
         echo "Update failed";
      }

      //Close the statement
      mysqli_stmt_close($stmt);

      //Handling book image update
      $update_image = $_FILES['update_image']['bookName'];
      $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
      $update_image_size = $_FILES['update_image']['size'];
      $update_folder = './book_image/'.$update_image;
      $update_old_image = $_POST['update_old_image'];

      if(!empty($update_image)){
         if($update_image_size > 2000000){
            $message[] = 'Image file size is too big';
         }
         else{
            mysqli_query($conn, "UPDATE `bookdetails` SET bookImage = '$update_image' WHERE bookId = '$update_book_id'") or die('query failed');
            move_uploaded_file($update_image_tmp_name, $update_folder);
            unlink('uploaded_img/'.$update_old_image);
         }
      }
      //Redirect to total_books page after updating
      header('location:total_books.php');
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
      //Including admin header
      include './admin_header.php'
   ?>

   <?php
      //Displaying messages if any
      if (isset($message)) {
         foreach ($message as $message) {
            echo '
            <div class="message">
               <span>' . $message . '</span><i onclick="this.parentElement.remove();">Close</i>
            </div>
         ';
         }
      }
   ?>

   <!--Link to add more books-->
   <a class="update_btn" style="position: fixed ; z-index:100;" href="add_books.php">Add More Books</a>

   <!--Form to update book details-->
   <section class="edit-product-form">
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
                     <input type="text" name="update_book_description" value="<?php echo $fetch_update['bookDescription']; ?>" class="box" required placeholder="Enter product description">
                     <input type="number" name="update_book_price" value="<?php echo $fetch_update['bookPrice']; ?>" min="0" step="0.01" class="box" required placeholder="Enter product price">
                     <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
                     <input type="submit" value="update" name="update_book" class="delete_btn" >
                     <input type="reset" value="cancel" id="close-update" class="update_btn" >
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
   
   <!--Displaying all books-->
   <section class="show-products">
      <div class="box-container">
         <?php
            //Query to select all books
            $select_book = mysqli_query($conn, "SELECT * FROM `bookdetails` ORDER BY date DESC") or die('query failed');
            if(mysqli_num_rows($select_book) > 0){
               while($fetch_book = mysqli_fetch_assoc($select_book)){
         ?>
                  <div class="box">
                     <img class="books_images" src="book_image/<?php echo $fetch_book['bookImage']; ?>" alt="">
                     <div class="name">Author: <?php echo $fetch_book['authorName']; ?></div>
                     <div class="name">Name: <?php echo $fetch_book['bookName']; ?></div>
                     <div class="price">Price: RM<?php echo number_format($fetch_book['bookPrice'], 2); ?></div>
                     <a href="total_books.php?update=<?php echo $fetch_book['bookId']; ?>" class="update_btn">Update</a>
                     <a href="total_books.php?delete=<?php echo $fetch_book['bookId']; ?>" class="delete_btn" onclick="return confirm('delete this product?');">Delete</a>
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

   <script src="./js/admin.js"></script>

</body>
</html>