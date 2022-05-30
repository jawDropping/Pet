<?php
    session_start();
    include("inc/db.php");

    if(isset($_POST['count_review']))
    {
        $count_review = $_POST['count_review'];
        $service_id = $_POST['service_id'];
        $user_id = $_SESSION['user_id'];

        $sql = $con->prepare("INSERT INTO review 
        SET 
        user_id = '$user_id',
        service_id = '$service_id',
        rating = '$count_review'
        ");

        if($sql->execute())
        {
            echo "<script>alert('Thanks for your rating!');</script>";
            echo "<script>window.open('services.php' ,'_self');</script>";
        }
    }
?>