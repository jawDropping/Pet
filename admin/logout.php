<?php 
    session_start();
    unset($_SESSION['admin_name']);
    echo "<script>window.open('/Pet/admin/login.php?', '_self');</script>";
?>