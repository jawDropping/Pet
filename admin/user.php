<?php

    include("inc/db.php");
    if(isset($_GET['user']))
    {
        $user_id = $_GET['user'];
        $sql = $con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();

        $row = $sql->fetch();

        echo
        "<p>Name: ".$row['user_username']."</p>
        <p>Location: ".$row['user_address']."</p>
        <p>Email: ".$row['user_email']."</p>
        <p>Contact Number: ".$row['user_contactnumber']."</p>";
    }
?>