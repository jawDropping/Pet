<?php
    session_start();
    if(!isset($_SESSION['user_username']))
    {
        header("Location: login.php");
    }
    else
    {
        include("inc/db.php");
        $user_id = $_SESSION['user_username'];
        $fetch_user_username = $con->prepare("SELECT * FROM users_table WHERE user_username = '$user_id'");
        $fetch_user_username->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_user_username->execute();

        $display_cart = $con->prepare("SELECT * FROM product_tbl WHERE pro_id IN (".implode(',',$_SESSION['cart']).")");
        $display_cart->setFetchMode(PDO:: FETCH_ASSOC);
        $display_cart->execute();
    
        $row_user = $fetch_user_username->fetch();

        echo "Products: ";
        //Butngan nimo og image ing ani-a lang
        //$row_prod['pro_img'];
        //e sod na sa while loop
        while($row_prod = $display_cart->fetch()):
            echo $row_prod['pro_name'];
            echo "<tr>(x".array_count_values($_SESSION['cart'])[$row_prod['pro_id']]. ")  </tr>";
        endwhile;

        echo "<div>Total Cart Items: ".count($_SESSION['cart'])."</div>";
        echo "<div>Total Amount to be Paid: ".$_GET['totalprice']."</div>";

        echo "<br>
              <div>Your Information ⬇</div>
              <div>Name: ".$row_user['user_username']."</div>
              <div>Contact Number: ".$row_user['user_contactnumber']."</div>
              <div>Location: ".$row_user['user_address']."</div>
              <div>Email Address: ".$row_user['user_email']."</div>";
        
        echo "<input type = 'hidden' value = '".$row_user['user_id']."' name = 'user_id' />
              <button>Place Order</button>";
    }
?>