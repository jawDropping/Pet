<?php
    session_start();

    if(!isset($_SESSION['user_username']))
    {
        echo "<script>window.open('login.php', '_self');</script>";
    }
    else
    {
        if(isset($_GET['avail_service']))
        {
            include("inc/db.php");
            if(isset($_GET['avail_service']))
            {
                $service_id = $_GET['avail_service'];
                $query = $con->prepare("SELECT * FROM services WHERE service_id = '".$service_id."'");
                $query->setFetchMode(PDO:: FETCH_ASSOC);
                $query->execute();

                $row = $query->fetch();

                echo 
                "<form method = 'POST'>
                    <tr>
                        <td>Service Cost: </td>
                        <td><input type = 'hidden' name = 'service_cost' value = ".$row['service_cost']." </td>
                        <td>".$row['service_cost']."</td>
                    </tr><br>
                    <tr>
                        <td>Coupon Code: <input type = 'text' name = 'coupon_code'</td>
                    </tr><br>
                    <tr>
                        <td><input type = 'hidden' name = 'reserve' value = ".$row['service_id']."</td>
                        <td><a href = 'reserve_service'>RESERVE</a></td>
                    </tr>
                </form>";
            }
        }
    }
?>

       