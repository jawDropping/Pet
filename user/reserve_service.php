<?php

    include("inc/db.php");
    if(isset($_POST['reserve']))
    {
        $service_cost = $_POST['service_cost'];
        $reserve_date = $_POST['reserve_date'];
        $user_id = $_POST['user_id'];

        $reserve = $con->prepare("INSERT INTO reserve_services('service_cost', '    ', 'user_id') VALUES('service_cost', 'reserve_date', 'user_id')");
        if($reserve->execute())
        {
            echo "<script>alert('Reserved!');</script>";
            echo "<script>window.open('index.php','_self');</script>";
        }
    }
?>