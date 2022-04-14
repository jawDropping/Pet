<?php
    session_start();
    include("inc/db.php");
    $user_username = $_SESSION['user_username'];
    $sql = $con->prepare("SELECT * FROM users_table WHERE user_username = '$user_username'");
    $sql->setFetchMode(PDO:: FETCH_ASSOC);
    $sql->execute();

    $row = $sql->fetch();
    $address = $row['user_address'];
    $address = str_replace(" ", "+", $address);

    echo 
    "<iframe width='100%' height='500' src='https://maps.google.com/maps?q=".$address."&output=embed'></iframe>";
?>