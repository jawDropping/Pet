<?php
    session_start();
    include("inc/db.php");

    if(!isset($_SESSION['user_username']))
    {
        echo "<script>window.open('login.php', '_self');</script>";
    }
    else
    {
        if(isset($_POST['submit']))
        {
            $user_username = $_SESSION['user_username'];
            $user = $con->prepare("SELECT * FROM users_table WHERE user_username = '$user_username'");
            $user->setFetchMode(PDO:: FETCH_ASSOC);
            $row = $user->fetch();

            $user_id = $row['user_id'];
            $pet_id = $_POST['pet_id'];
            $comment = $_POST['comment'];

            $add_val = $con->prepare("INSERT INTO comment_tbl SET 
            user_id = $user_id,
            pet_id = $pet_id,
            comment = $comment
            ");

            $add_val->execute();
        }
    }
?>