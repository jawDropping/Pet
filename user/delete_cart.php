<?php
    if(isset($_POST['delete_cart']))
    {
        foreach($_SESSION['cart'] as $key => $row_pro)
        {
            if($row_pro['pro_id'] === $_POST['pro_id'])
            {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                header('cart.php');
            }
        }
    }
?>