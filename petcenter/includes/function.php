<?php
    //session_start();
    function signUp()
    {
        include("includes/db.php");
        if(isset($_POST['sign_up']))
        {
            $PCusername = $_POST['PCusername'];
            $PCpassword = $_POST['PCpassword'];
            $PCname = $_POST['PCname'];
            $PCemail = $_POST['PCemail'];
            $PCcontact_number = $_POST['PCcontact_number'];
            
           /* $user_email = $_POST['user_email'];
            $user_contact_number = $_POST['user_contact_number'];

            $user_img = $_FILES['user_img']['name'];
            $user_img_tmp = $_FILES['user_img']['tmp_name'];

            move_uploaded_file($user_img_tmp,"../uploads/user_profile/$user_img");*/

            $add_petCenter = $con->prepare("INSERT INTO petcenter
            (
                PCusername, 
                PCpassword,
                PCname,
                PCemail,
                PCcontact_number
               
            ) 
            VALUES
            (
                '$PCusername',
                '$PCpassword',
                '$PCname',
                '$PCemail',
                '$PCcontact_number'
                
            )");

            if($add_petCenter->execute())
            {
                echo "<script>alert('Registration Successful!');</script>";
                echo "<script>window.open('index.php','_self');</script>";
            }
            else
            {
                echo "<script>alert('Registration Failed!');</script>";
            }
        }
    }

    function LogIn()
    {
        include("includes/db.php");
        if(isset($_POST['login_user']))
        {
            $PCusername = $_POST['Username'];
            $PCpassword = $_POST['Password'];

            $fetchuser = $con->prepare("SELECT * FROM petcenter WHERE PCusername = '$PCusername' AND PCpassword = '$PCpassword'");
            $fetchuser->setFetchMode(PDO:: FETCH_ASSOC);
            $fetchuser->execute();
            $countUser = $fetchuser->rowCount();

            $row = $fetchuser->fetch();
            $user_role = $row['user_type'];
            if($countUser>0)
            {
                $_SESSION['PCusername'] = $_POST['PCusername'];
                echo "<script>window.open('index.php?login_user=".$_SESSION['PCusername']."','_self');</script>";
                //echo "<script>alert('Login Succesfully');</script>";
            }
            else
            {
                echo "<script>alert('Username or Password is incorrect!');</script>";
            }
        }

    }
?>