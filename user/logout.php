<?php 
    session_start();
    unset($_SESSION['user_username']);
    echo "<script>window.open('index.php', '_self');</script>";
?>