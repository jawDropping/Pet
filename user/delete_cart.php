<?php
    session_start();
    if(isset($_GET['delete']))
    {
        $new_cart = array_filter($_SESSION['cart'], function($item){
            return $item != $_GET['delete'];
        });

        $_SESSION['cart'] = $new_cart;
        header("location: cart.php");
    }
?>