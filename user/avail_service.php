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
            $service_time_open = strtotime($row['time_open']);
            $service_time_close = strtotime($row['time_close']);

     

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
                <label style = 'color:#fff;position:absolute;margin:10% 0% 0% 40.7%;background-color:#000;padding: 10px 10px;border-radius:5px;'>Please verify your coupon to get the exact amount!</label><br>
                <tr>
                    <td><label style = 'position:absolute;margin:15% 0% 0% 30%;'>Book Appointment: </label></td>
                    <td><input type = 'date' name = 'reserve_date'  required style = 'position:absolute;align-items:center;margin:14.5% 0% 0% 42%;width:420px;height:32px;border-radius:5px'/></td>
                </tr><br>
                <tr>
                    <td><label style = 'position:absolute;margin:18% 0% 0% 30%;'>Time: </label></td>
                    <td><input type = 'time' name = 'reserve_time'  required style = 'position:absolute;align-items:center;margin:17.5% 0% 0% 42%;width:420px;height:32px;border-radius:5px'/></td><br>
                </tr><br>
                <tr>";
                    if($row3['active_coupon'] == 'yes')
                    {
                        echo 
                        "<td><label style = 'position:absolute;margin:20% 0% 0% 30%;'>Coupon Code: </label></td>
                        
                        <td><input type = 'text' name = 'coupon_code'  style = 'position:absolute;align-items:center;margin:19.5% 0% 0% 42%;width:420px;height:32px;border-radius:5px'/></td>";
                        // <td><button name = 'verify' style = 
                        // 'border: 0;
                        // padding: 7.5px 17px;
                        // background: #86b0b6;
                        // font-size: 12px;
                        // border-radius: 5px;
                        // color: #fff;
                        // cursor:pointer;'>VERIFY</button></td>
                        // <label style = 'position:absolute;margin:18.2% 0% 0% 40.9%;color:red'>*PUT  "."N/A"." if you don't have any coupon code!</label><br>";
                        // if(isset($_POST['verify']))
                        // {
                        //     $coupon_code = $_POST['coupon_code'];
                        //     $verify_coupon = $con->prepare("SELECT * FROM donations");
                        //     $verify_coupon->setFetchMode(PDO:: FETCH_ASSOC);
                        //     $verify_coupon->execute();
                            
                        //     $row_coupon = $verify_coupon->fetch();
                        //     $coupon_val = $row_coupon['coupon_code'];
                        //     $discount = "0.02";

                        //     $total = $service_cost * $discount;
                        //     $convertfloat = floatval($total);

                        //     $service_total_cost = $service_cost - $convertfloat;
                            
                        //     if($coupon_val == $coupon_code)
                        //     {
                        //         echo 
                        //         "<tr>
                        //             <td><label style = 'position:absolute;margin:20% 0% 0% 30%;'>Service Cost: </label></td>
                        //             <td><input type = 'hidden' name = 'service_cost' value = ".$service_total_cost." /></td>
                        //             <td>".$service_total_cost."</td>
                        //         </tr><br>";
                        //     }
                        //     else
                        //     {
                        //         echo 
                        //         "<tr>
                                    
                        //         </tr><br>";
                        //     }
                        // }
                        echo 
                        "<td><label style = 'position:absolute;margin:25% 0% 0% 30%;'>Service Cost: </label></td>
                        <td><input type = 'hidden' name = 'service_cost' value = ".$service_cost."   /></td>
                        <td >".$service_cost.   "</td>";
                    }
                    else
                    {
                        echo "<td>Service Cost: </td>
                        <td><input type = 'hidden' name = 'service_cost' value = ".$service_cost." </td>
                        <td>".$service_cost."</td>";
                        
                        
                        echo "<td><input type = 'hidden' name = 'coupon_code' value = '".null."' /></td>";
                    }
                echo "</tr><br>
                <tr>
                    <td><input type = 'hidden' name = 'reserve' value = ".$row['service_id']."</td>
                    <td><button name = 'reserve_service' value = ".$row['service_id']." style = 
                    'border: 0;
                    padding: 7.5px 17px;
                    background: #86b0b6;
                    font-size: 12px;
                    border-radius: 5px;
                    color: #fff;
                    cursor:pointer;'>RESERVE</button></td>
                    
                </tr>
                <tr>
                    <td><a href = 'services.php' style =
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
                $reserve_date = $_POST['reserve_date'];
                $coupon_code = $_POST['coupon_code'];
                $reserve_time = $_POST['reserve_time'];
                $transaction_code = generateRandomString();

                $datenow = getdate();

                $today = $datenow['year'] . '-' . $datenow['mon'] . '-' . $datenow['mday'];

                $dateTimestamp = strtotime($reserve_date);
                $dateTimestamp2 = strtotime($today);
                $dateTimestamp3 = strtotime($reserve_time);
                
                if($dateTimestamp > $dateTimestamp2)
                {
                    if($dateTimestamp3 >= $service_time_open && $dateTimestamp3 < $service_time_close)
                    {
                        $sql = $con->query("SELECT * FROM reserve_services WHERE coupon_code = '$coupon_code'");
                        $sql->setFetchMode(PDO:: FETCH_ASSOC);
                        $sql->execute();

                        $sql2 = $con->query("SELECT * FROM reserve_services");
                        $sql2->setFetchMode(PDO:: FETCH_ASSOC);
                        $sql2->execute();

                        $row = $sql->rowCount();
                        $row_user = $sql2->fetch();
                        $user_id = $row_user['user_id'];

                        $fetch_user_username = $con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
                        $fetch_user_username->setFetchMode(PDO:: FETCH_ASSOC);
                        $fetch_user_username->execute();
                
                        $row4 = $fetch_user_username->fetch();
                        if($row>0)
                        {
                            echo "Code Exist!";
                        }
                        else
                        {
                            $view_coupon = $con->prepare("SELECT * FROM donations WHERE coupon_code = '$coupon_code'");
                            $view_coupon->setFetchMode(PDO:: FETCH_ASSOC);
                            $view_coupon->execute();

                            $row2 = $view_coupon->rowCount();
                            if($row2>0)
                            {
                                $discount = "0.02";

                                $total = $service_cost * $discount;
                                $convertfloat = floatval($total);

                                $service_total_cost = $service_cost - $convertfloat;

                                $receiver = $row4['user_email'];
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
                                        '$service_total_cost',
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
                            else
                            {
                                $receiver = $row4['user_email'];
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
                    else
                    {
                        echo "Time you chose is invalid, please check the time open and time close of the service.";
                    }        
                }
                else
                {
                    echo "INVALID DATE!";
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
