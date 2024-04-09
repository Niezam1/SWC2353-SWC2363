//Hide the update form and redirect to total_books.php when the close button is clicked
document.querySelector('#close-update').onclick = () =>{
    document.querySelector('.edit-product-form').style.display = 'none';
    window.location.href = 'total_books.php';
 }

 //Hide the message after 8 seconds
 setTimeout(() => {
   const box = document.getElementById('messages');
   box.style.visibility = 'hidden';
 }, 8000);
