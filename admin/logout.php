<?php 
    session_start();
    unset($_SESSION['id']);
    echo "<script>window.open('/Pet/admin/login.php?', '_self');</script>";
?>