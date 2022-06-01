<?php
    include("inc/db.php");

    if(isset($_GET['return_delivery']))
    {
        $id = $_GET['return_delivery'];
        
        $query = $con->prepare("UPDATE delivery_tbl SET delivery_status = 'UNSUCCESSFUL' WHERE delivery_id = '$id'");
        $query->setFetchMode(PDO:: FETCH_ASSOC);
        $query->execute();

            
        $fetch_user=$con->prepare("SELECT * FROM users_table WHERE user_username = '$user_username'");
        $fetch_user->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_user->execute();
    
        $row_username = $fetch_user->fetch();


        if(!$query->execute())
        {
            return;
        }

        $datenow = getdate();

        // $today = $datenow['year'] . '-' . $datenow['mon'] . '-' . $datenow['mday'];

        // $receiver = $row_username['user_email'];
        // $subject = "DELIVERY UNSUCCESSFUL";
        // $body =  "
        // Greetings!

        // Your order has been delivered on $today.

        // Unfortunately your order is unsuccessfully delivered.
        // Arf arf,
        // Pet Society
        // ";
        // $sender = "ianjohn0101@gmail.com";

        // mail($receiver, $subject, $body, $sender);
        
        // echo "<script>window.open('index.php?deliveries.php','_self');</script>";
        
    }
?>