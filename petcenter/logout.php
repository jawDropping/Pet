<?php 
    session_start();
    unset($_SESSION['pet_center_name']);
    echo "<script>window.open('index.php', '_self');</script>";
?>