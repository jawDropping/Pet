<?php
    include("inc/db.php");

    if(isset($_GET['redeliver']))
    {
        $delivery_id = $_GET['redeliver'];

        echo 

        "<form method = 'POST' enctype = 'multipart/form-data'>
            <br>What's the reason of unsuccessful delivery:
            <br><input type = 'radio' name = 'reason' value = 'I'm not in the premisces'/>I'm not in the premisces.
            <br><input type = 'radio' name = 'reason' value = 'Not called for the delivery'/>You're not called for your delivery.
            <br><input type = 'radio' name = 'reason' value = 'You're not available that time'/>You're not available that time.
            <br><input type = 'radio' name = 'reason' value = 'You're out of town.'/>You're out of town.
            <br>
            <button name = 'submit'>Submit</button>
        </form>";

        if(isset($_POST['submit']))
        {
            $reason = $_POST['reason'];
            $qry = $con->prepare("SELECT * FROM delivery_tbl WHERE delivery_id = '$delivery_id'");
            $qry->setFetchMode(PDO:: FETCH_ASSOC);
            $qry->execute();

            $row = $qry->fetch();

            $user_username = $row['user_username'];

            $qry2 = $con->prepare("SELECT * FROM users_table WHERE user_username = '$user_username'");
            $qry2->setFetchMode(PDO::FETCH_ASSOC);
            $qry2->execute();

            $rows = $qry2->fetch();
            $user_email = $rows['user_email'];

            $update = $con->prepare("UPDATE delivery_tbl SET redelivery = 'REQUEST FOR REDELIVERY' WHERE delivery_id = '$delivery_id'");
            $update->setFetchMode(PDO::FETCH_ASSOC);
            $update->execute();

            if(!$update->execute())
            {
                return;
            }

            // $receiver = "ianjohn0101@gmail.com";
            // $subject = "FOR REDELIVERY";
            // $body = 
            // "This user was to request for delivery
            // Delivery Id: $delivery_id
            // Reason of unsuccessful delivery: $reason
            // ";
            // $sender = $user_email;

            // mail($receiver, $subject, $body, $sender);
            
            echo "<script>alert('Wait for 24 hours to approve your redelivery.');</script>";
            echo "<script>window.open('index.php', '_self');</script>";

        }
    }
?>