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
                    <td>Reserve Date: </td>
                    <td><input type = 'date' name = 'reserve_date' required /></td>
                </tr><br>
                <tr>
                    <td>
                        <label>Coupon Code:</label>
                        <input type = 'text' name = 'coupon_code' placeholder='N/A' required/>
                        <label style = color:red>*TYPE N/A IF YOU DON'T HAVE ANY COUPON CODE!</label>
                    </td>
                </tr><br>
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
                    $reserve_service = $con->prepare("INSERT INTO reserve_services (
                        user_id,
                        service_cost,
                        reserve_date,
                        coupon_code
                    ) 
                    VALUES (
                        '$user_id',
                        '$service_cost',
                        '$reserve_date',
                        '$coupon_code'
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
?>

       