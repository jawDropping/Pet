<?php
    include("inc/db.php");

    if(isset($_POST['update_my_password']))
    {
        $user_email = $_POST['user_email'];
        $user_pass = $_POST['user_pass'];
        $confirm_pass = $_POST['confirm_pass'];

        $view_user = $con->prepare("SELECT * FROM pet_center_tbl WHERE email = '$user_email'");
        $view_user->setFetchMode(PDO::FETCH_ASSOC);
        $view_user->execute();

        $row = $view_user->fetch();
        $user_id = $row['pet_center_id'];
    
        if($user_pass != $confirm_pass)
        {
            echo "<script>alert('Password doesn't match');</script>";
        }
        elseif(strlen($user_password) >= 9 &&
        preg_match('/[A-Z]/', $user_password) > 0 &&
        preg_match('/[a-z]/', $user_password) > 0)
        {
            echo "<script>alert('Password must at least 8 characters in length, with 1 special character, 1 uppercase and 1 number!');</script>";
        }
        else
        {
            $update_password = $con->prepare("UPDATE pet_center_tbl SET pet_center_password = '$user_pass' WHERE pet_center_id = '$user_id'");
            $update_password->setFetchMode(PDO:: FETCH_ASSOC);
            $update_password->execute();

            if($update_password->execute())
            {
                echo "<script>alert('Password changed successfully!');</script>";
                echo "<script>window.open('login.php', '_self');</script>";
            }
        }
    }

?>