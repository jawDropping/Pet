<?php
    include("inc/db.php");

    if(isset($_GET['delete']))
    {
        $user_id = $_GET['delete'];
        $sql = $con->prepare("DELETE FROM users_table WHERE user_id = '$user_id'");
        $sql->execute();

        if($sql->execute())
        {
            echo "<script>alert('Deleted!');</script>";
            echo "<script>window.open('users.php', '_self');</script>";
        }
    }
?>