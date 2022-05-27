<?php
    session_start();
    include("inc/db.php");
    //From the Update Button
    //A link with a querystring "update_cart_qty"
    //was seen holding the product Id from database Result
    //Therefore, Request type must be _GET or _REQUEST
    if(isset($_GET['pro_id']) && isset($_GET['pro_quantity'])) {
        $new_cart = array_filter($_SESSION['cart'], function($item){
            return $item != $_GET['pro_id'];
        });

        //Push $pro_id into cart
        array_push($new_cart, ...array_fill(0, (int)$_GET['pro_quantity'], $_GET['pro_id']));
        $_SESSION['cart'] = $new_cart;
        //Redirect to cart.php
        // header("location: cart.php");
        $error_message = "error";
        $success_message = "success";
        foreach($_SESSION['cart'] as $proID)
        {
            $sql = $con->prepare("SELECT * FROM product_table WHERE pro_id = '$proID'");
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();

            $rows = $sql->fetch();
            if($rows['pro_quantity'] > $qty)
            {
                header("Location: cart.php?error_message=" . urlencode($error_message));
            }
            else
            {
                header("Location: cart.php?success_message=" . urlencode($success_message));
            }

        }
    } else {

        //Throw exception
        //Since we can't work with empty Id
        throw new Exception("Product Key Not Found");

    }

?>