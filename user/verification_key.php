<?php
    include("inc/db.php");

    if(isset($_POST['next']))
    {
        
        $verification_code = $_POST['verification_code'];
        $v_code = $_POST['v_code'];
        $user_email = $_POST['user_email'];

        
        if($v_code == $verification_code)
        {
            echo 
            "<form method = 'POST' action = 'forgot_user_password.php' enctype = 'multipart/form-data'>
                <input type = 'hidden' name = 'user_email' value = '".$user_email."' />
                Password: <input type = 'password' name = 'user_pass' placeholder = 'Password' />
                Confirm Password: <input type = 'password' name = 'confirm_pass' placeholder = 'Confirm Password' />
                <button name = 'update_my_password'>Update Password</button>
            </form> ";
        }
        else
        {
            echo "ATAY";
        }
    }
?>