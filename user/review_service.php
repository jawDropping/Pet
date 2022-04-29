<?php
    session_start();
    include("inc/db.php");
    
    if(!isset($_SESSION['user_id']))
    {
        echo "<script>window.open('login.php','_self');</script>";
    }   
    else
    {
        $users_id = $_SESSION['user_id'];
        $view_user = $con->prepare("SELECT * FROM users_table WHERE user_id = '$user_username'");
        $view_user->setFetchMode(PDO:: FETCH_ASSOC);
        $view_user->execute();
        
        $row_user = $view_user->fetch();
        $user_id = $row_user['user_id'];
    
        if(isset($_GET['review_service']))
        {
            $id = $_GET['review_service'];
            
            $view_service = $con->prepare("SELECT * FROM services WHERE id = '$id'");
            $view_service->setFetchMode(PDO:: FETCH_ASSOC);
            $view_service->execute();

            $row_service = $view_service->fetch();
            $service_id = $row_service['service_id'];

            $service_name = $con->prepare("SELECT * FROM service_cat WHERE cat_id = '$service_id'");
            $service_name->setFetchMode(PDO:: FETCH_ASSOC);
            $service_name->execute();

            $row_service_name = $service_name->fetch();

            echo 
            "<div class = 'comment-box'>
                <h2>Your Feedback</h2>
                <form method = 'POST' enctype = 'multipart/form-data'>
                    <label>Your Email Address: </label>
                    <input type = 'hidden' name = 'user_id' value = ".$user_id." />
                    <input type = 'text' name = 'user_email' value = ".$row_user['user_email']." disabled />
                    <label>Service Name: </label>
                    <input type = 'hidden' name = 'service_id' value = ".$service_id." />
                    <input type = 'text' name = 'service_name' value = '".$row_service['services_name']."' disabled />
                    <textarea name = 'comment' placeholder = 'Write a comment..' required></textarea>
                    <button name = 'submit'  >Submit</button>
                    <a href = 'services_detail.php' style = 'position:absolute;text-decoration:none;background: #86b0b6;margin: 0 20 0 5;padding: 10.5px 14px 9.7px 20px;border-radius:5px;color: #fff;font-family: Arial, Helvetica, sans-serif;font-size: 18px;'>Go Back</a>
                </form>
            </div>";
    
            if(isset($_POST['submit']))
            {
                $comment = $_POST['comment'];
                $user_id = $_POST['user_id'];
                $service_id = $_POST['service_id'];
    
                $add = $con->prepare("INSERT INTO feedback_tbl
                (
                    user_id, 
                    service_id, 
                    comment
                ) 
                VALUES
                (
                    '$user_id',
                    '$service_id',
                    '$comment'
                )");
    
                if($add->execute())
                {
                    echo "<script>alert('Thanks for the feedback');</script>";
                    echo "<script>window.open('index.php','_self');</script>";
                }
            }
        }
    } 
?>

<style>
    * {
        padding: 0;
        margin: 0;
        background-color: #eee;
    }

    .comment-box {
        top: 20%;
        left: 35%;
        position: absolute;
        transform: transalate(-50%, 50%);
        width: 500px;
    }

    .comment-box h2 {
        font-size: 20px;
        margin-bottom: 15px;
    }

    .comment-box label {
        font-size: 15px;
        font-family: Arial, Helvetica, sans-serif;
    }

    .comment-box input {
        width: 100%;
        height: 50px;
        padding: 0 20px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #86b0b6;
    }

    .comment-box input:focus{
        border: 1px solid #000;
        outline: 0;
    }

    .comment-box textarea {
        width: 100%;
        height: 150px;
        padding: 15px 20px;
        margin-bottom: 10px;
        border-radius 5px;
        border: 1px solid #86b0b6;
    }

    .comment-box textarea:focus {
        border: 1px solid #000;
        outline: 0;
    }

    .comment-box button {
        border: 0;
        padding: 10px 30px;
        background: #86b0b6;
        font-size: 18px;
        border-radius: 5px;
        color: #fff;
    }

    .comment-box button:hover {
        background-color: #718a8e;
      
    }


</style>