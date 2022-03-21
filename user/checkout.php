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

        // echo "Products: ";
        // //Butngan nimo og image ing ani-a lang
        // //$row_prod['pro_img'];
        // //e sod na sa while loop
        // while($row_prod = $display_cart->fetch()):
        //     echo $row_prod['pro_name'];
        //     echo "<tr>(x".array_count_values($_SESSION['cart'])[$row_prod['pro_id']]. ")  </tr>";
        // endwhile;

        // echo "<div>Total Cart Items: ".count($_SESSION['cart'])."</div>";
        // echo "<div>Total Amount to be Paid: ".$_GET['totalprice']."</div>";

        // echo "<br>
        //       <div>Your Information ⬇</div>
        //       <div>Name: ".$row_user['user_username']."</div>
        //       <div>Contact Number: ".$row_user['user_contactnumber']."</div>
        //       <div>Location: ".$row_user['user_address']."</div>
        //       <div>Email Address: ".$row_user['user_email']."</div>";
        
        // echo "<input type = 'hidden' value = '".$row_user['user_id']."' name = 'user_id' />
        //       <button>Place Order</button>";
       echo "Product Details:";
        while($row = $display_cart->fetch()):
        echo 
        "<form method = 'POST' enctype = 'multipart/form-data'>
            <div>
                <tr>";
                echo "Product Name: ";
                echo"
                    <td><input type = 'hidden' name = 'pro_id' value = ".$row['pro_id']." /></td>
                    <td>".$row['pro_name']."</td><br>
                </tr>";
        endwhile;
        echo"
                <tr>
                    <td>Total Cart Items: </td>
                    <td><input type = 'hidden' name = 'qty' value = ".count($_SESSION['cart'])." /></td>
                    <td>".count($_SESSION['cart'])."</td><br>
                </tr>";
            echo"
                <tr>
                    <td>Total Amount to be Paid: </td>
                    <td><input type = 'hidden' name = 'total_value' value = ".$_GET['net_total']." /></td>
                    <td>".$_GET['net_total']."</td><br><br>
                </tr>";
            
            echo "
                <tr>
                    <td>Your Information ⬇ </td><br>
                </tr>
                <tr>
                    <td>Your Name: </td>
                    <td><input type = 'hidden' name = 'user_username' value = ".$row_user['user_id']." /></td>
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
                    <td><button name = 'place_order'>Place Order</button></td>
                </tr>
            </div>
        </form>";
        
        
        if(isset($_POST['place_order']))
        {
            $userID = $_POST['user_username']; 
            $cart_items = $_POST['pro_id']; 
            $qty = $_POST['qty'];
            $total_amount = $_POST['total_value'];

            $query = $con->prepare("INSERT INTO order_tbl (
                user_id,
                pro_id,
                qty,
                total_amount
            )
            VALUES (
                '$userID',
                '$cart_items',
                '$qty',
                '$total_amount'
            )");

            if($query->execute())
            {
                echo "<script>alert('Ordered Successfully!');</script>";
                unset($_SESSION['cart']);
                echo "<script>window.open('index.php', '_self');</script>";
            }
            else
            {
                echo "<script>alert('Unsuccessful!');</script>";
            }
        }
    }
?>