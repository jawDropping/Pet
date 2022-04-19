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
            $service_cost = $row['service_cost'];
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
                    <td><label>Book Appointment: </label></td>
                    <td><input type = 'date' name = 'reserve_date'  required style = 'width:108px;height:28px;border-radius:5px'/></td>
                </tr><br>
                <tr>
                    <td>Time: </td>
                    <td><input type = 'time' name = 'reserve_time'  required style = 'width:108px;height:28px;border-radius:5px'/></td><br>
                </tr><br>
                <tr>";
                    if($row3['active_coupon'] == 'yes')
                    {
                        echo 
                        "<td>Coupon Code: </td>
                        <td><input type = 'text' name = 'coupon_code' required style = 'width:115px;height:28px;border-radius:5px'/></td>
                        <td><button name = 'verify' style = 
                        'border: 0;
                        padding: 7.5px 17px;
                        background: #86b0b6;
                        font-size: 12px;
                        border-radius: 5px;
                        color: #fff;
                        cursor:pointer;'>VERIFY</button></td>
                        <label style = 'color:red'>*PUT  "."N/A"." if you don't have any coupon code!</label><br>";
                        if(isset($_POST['verify']))
                        {
                            $coupon_code = $_POST['coupon_code'];
                            $verify_coupon = $con->prepare("SELECT * FROM donations");
                            $verify_coupon->setFetchMode(PDO:: FETCH_ASSOC);
                            $verify_coupon->execute();
                            
                            $row_coupon = $verify_coupon->fetch();
                            $coupon_val = $row_coupon['coupon_code'];
                            $discount = "0.02";

                            $total = $service_cost * $discount;
                            $convertfloat = floatval($total);

                            $service_total_cost = $service_cost - $convertfloat;
                            
                            if($coupon_val == $coupon_code)
                            {
                                echo 
                                "<tr>
                                    <td>Service Cost: </td>
                                    <td><input type = 'hidden' name = 'service_cost' value = ".$service_total_cost." </td>
                                    <td>".$service_total_cost."</td>
                                </tr><br>";
                            }
                            else
                            {
                                echo 
                                "<tr>
                                    <td>Service Cost: </td>
                                    <td><input type = 'hidden' name = 'service_cost' value = ".$service_cost." </td>
                                    <td>".$service_cost."</td>
                                </tr><br>";
                            }
                        }
                    }
                    else
                    {
                        echo "<td>Service Cost: </td>
                        <td><input type = 'hidden' name = 'service_cost' value = ".$service_cost." </td>
                        <td>".$service_cost."</td>";
                        echo "<td><input type = 'hidden' name = 'coupon_code' value = 'N/A' /></td>";
                    }
                echo "</tr><br>
                <tr>
                    <td><input type = 'hidden' name = 'reserve' value = ".$row['service_id']."</td>
                    <td><button name = 'reserve_service' style = 
                    'border: 0;
                    padding: 7.5px 17px;
                    background: #86b0b6;
                    font-size: 12px;
                    border-radius: 5px;
                    color: #fff;
                    cursor:pointer;'>RESERVE</button></td>
                    
                </tr>
                <tr>
                    <td><a href = 'services_detail.php' style =
                    '
                    position:absolute;
                    text-decoration:none;
                    background-color:#86b0b6;
                    font-size:12px;
                    color:#fff;
                    font-family: Verdana, Geneva, Tahoma, sans-serif;
                    padding: 7.5px 17px;
                    border-radius: 5px;
                    margin: 0% 2% 10% 1%;'>GO BACK</a></td>
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
        
                $get_coupon = $check_coupon->fetch();
                $coup = $get_coupon['coupon_code'];

                if($coup != $coupon_code)
                {
                    echo "Try Again Another Code!";
                }
                elseif($coup == 'N/A')
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

       