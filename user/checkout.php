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
        $net_total = 0;
       echo "Product Details:";
        while($row = $display_cart->fetch()):
            $qty = array_count_values($_SESSION['cart'])[$row['pro_id']];
            $pro_price = $row['pro_price'];
            $sub_total = $qty * $pro_price; 
        echo 
        "<form method = 'POST'  enctype = 'multipart/form-data'>
            <div>
                <tr>";
                echo "Product Name: ";
                echo"
                    <td><input type = 'hidden' name = 'pro_id' value = ".$row['pro_id']." /></td>
                    <td>".$row['pro_name']."</td>
                    <td>Qty: </td>
                    <td><input type = 'hidden' name = 'qty' value = ".array_count_values($_SESSION['cart'])[$row['pro_id']]." /></td>
                    <td>(x".array_count_values($_SESSION['cart'])[$row['pro_id']].")</td><br>
                </tr>";
                $net_total = $net_total + $sub_total;
        endwhile;
            echo"
                <tr>
                <td>Total:".$net_total."</td><br>";
                echo"</tr>
                <tr>
                    <td>Your Information ⬇ </td><br>
                </tr>
                <tr>
                    <td>Your Name: </td>
                    <td><input type = 'hidden' name = 'user_id' value = ".$row_user['user_id']." /></td>
                    <td>".$row_user['user_username']."</td><br>
                </tr>
                <tr>
                    <td>Contact Number: </td>
                    <td><input type = 'hidden' name = 'user_contactnumber' value = ".$row_user['user_contactnumber']." /></td>
                    <td>".$row_user['user_contactnumber']."</td><br>
                </tr>
                <tr>
                    <td>Location: </td>
                    <td><input type = 'hidden' name = 'user_address' value = ".$row_user['user_address']." /></td>
                    <td>".$row_user['user_address']."</td><br>
                </tr>
                <tr>
                    <td>Email Address: </td>
                    <td><input type = 'hidden' name = 'user_email' value = ".$row_user['user_email']." /></td>
                    <td>".$row_user['user_email']."</td><br>
                </tr>
                <tr>
                    <td><a href = 'payorder.php'>Place Order</a></td>
                </tr>
                <tr>
                    <td><a href = 'index.php'>Go Home</a></td>
                </tr>
            </div>
        </form>";
        
        
       
    }
?>
<style>
    
</style>