<?php
session_start();
include("inc/db.php");
$user_username = $_SESSION['user_username'];

$sql = $con->prepare("SELECT * FROM users_table WHERE user_username = '$user_username'");
$sql->setFetchMode(PDO:: FETCH_ASSOC);
$sql->execute();

$row = $sql->fetch();

$userID = $row['user_id'];

$display_cart = $con->prepare("SELECT * FROM product_tbl WHERE pro_id IN (".implode(',',$_SESSION['cart']).")");
$display_cart->setFetchMode(PDO:: FETCH_ASSOC);
$display_cart->execute();

$row = $display_cart->fetch();
$qty = array_count_values($_SESSION['cart'])[$row['pro_id']];

foreach($_SESSION['cart'] as $prodID)
{ 
    $query = $con->prepare("INSERT INTO orders_tbl(user_id, pro_id, qty, delivery_status) VALUES($userID, $prodID, $qty, 'PENDING')");
    try{
        if($query->execute())
        {
            header("Location: index.php");
            unset($_SESSION['cart']);
        }  
    }
    catch(PDOException $e)
    {
        die($e->getMessage());
    }
}
?>