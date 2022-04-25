<?php 
    session_start();
    unset($_SESSION['pet_center_name']);
    echo "<script>window.open('login.php', '_self');</script>";
?>