<?php
    session_start();
    include("inc/db.php");

    if(!isset($_SESSION['user_username']))
    {
        echo "<script>window.open('login.php', '_self');</script>";
    }
    else
    {
        if(isset($_GET['avail_service']))
        {
            $service_id = $_GET['avail_service'];
            $query = $con->prepare("SELECT * FROM services WHERE service_id = '".$service_id."'");
            $query->setFetchMode(PDO:: FETCH_ASSOC);
            $query->execute();

            $row = $query->fetch(); 
            $pet_center_id = $row['pet_center_id'];

            $sql2 = $con->prepare("SELECT active_coupon FROM pet_center_tbl WHERE pet_center_id = $pet_center_id");
            $sql2->setFetchMode(PDO:: FETCH_ASSOC);
            $sql2->execute();

            $row3 = $sql2->fetch();
            
            $user_username = $_SESSION['user_username'];
            $sql = $con->prepare("SELECT * FROM users_table WHERE user_username = '$user_username'");
            $sql->setFetchMode(PDO:: FETCH_ASSOC);
            $sql->execute();

            $row2 = $sql->fetch();

            $user_id = $row2['user_id'];
            

            echo 
            "<form method = 'POST'>
                <tr>
                    <td>Service Cost: </td>
                    <td><input type = 'hidden' name = 'service_cost' value = ".$row['service_cost']." </td>
                    <td>".$row['service_cost']."</td>
                </tr><br>
                <tr>
                    <td>Book Appointment: </td>
                    <td><input type = 'date' name = 'reserve_date' required /></td>
                </tr><br>
                <tr>
                    <td>Time: </td>
                    <td><input type = 'time' name = 'reserve_time' required /></td>
                </tr><br>
                <tr>";
                    if($row3['active_coupon'] == 'yes')
                    {
                        echo 
                        "<td>Coupon Code: </td>
                        <td><input type = 'text' name = 'coupon_code' required /></td>";
                    }
                    else
                    {
                        echo "<td><input type = 'hidden' name = 'coupon_code' value = 'N/A' /></td>";
                    }
                echo "</tr><br>
                <tr>
                    <td><input type = 'hidden' name = 'reserve' value = ".$row['service_id']."</td>
                    <td><button name = 'reserve_service'>RESERVE</button></td>
                </tr>
            </form>";

            
            if(isset($_POST['reserve_service']))
            {
                $service_cost = $_POST['service_cost'];
                $reserve_date = date('Y-m-d', strtotime($_POST['reserve_date']));
                $coupon_code = $_POST['coupon_code'];
                $reserve_time = $_POST['reserve_time'];
                $transaction_code = generateRandomString();
        
                $check_coupon = $con->prepare("SELECT * FROM reserve_services");
                $check_coupon->setFetchMode(PDO:: FETCH_ASSOC);
                $check_coupon->execute();
        
                $rowCount = $check_coupon->rowCount();
        
                if($rowCount > 0)
                {
                    echo "Coupon Code already used!";
                }
                else
                {
                    $receiver = $row2['user_email'];
                    $subject = "Transaction Code";
                    $body = "Present this code to the available service according to your choice. Your Transaction Code: $transaction_code";
                    $sender = "ianjohn0101@gmail.com";

                    if(mail($receiver, $subject, $body, $sender))
                    {
                        $reserve_service = $con->prepare("INSERT INTO reserve_services (
                            pet_center_id,
                            service_id,
                            user_id,
                            service_cost,
                            reserve_date,
                            reserve_time,
                            coupon_code,
                            transaction_code,
                            service_status
                        ) 
                        VALUES (
                            '$pet_center_id',
                            '$service_id',
                            '$user_id',
                            '$service_cost',
                            '$reserve_date',
                            '$reserve_time',
                            '$coupon_code',
                            '$transaction_code',
                            'For Confirmation'
                        )");
            
                        if($reserve_service->execute())
                        {
                            echo "SUCCESSFUL"; 
                        }
                        else
                        {
                            echo "UNSUCCESSFUL";
                        }
                    }
                }
            }
        }
    }

    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
?>

       