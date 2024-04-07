<?php
    include 'config.php';

    //Start session
    session_start();

    //Unsetting all session variables
    session_unset();

    //Destroying the session
    session_destroy();

    //Redirect to the index page
    header('location:index.php');
?>