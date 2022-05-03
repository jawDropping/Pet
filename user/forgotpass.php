<?php
    include("inc/db.php");
    if(isset($_POST['continue']))
    {
        $user_email = $_POST['user_email'];
        $verification_code = generateRandomString();

        $check_email = $con->prepare("SELECT * FROM users_table WHERE user_email = '$user_email'");
        $check_email->setFetchMode(PDO:: FETCH_ASSOC);
        $check_email->execute();

        $row = $check_email->rowCount();
        if($row>0)
        {
            echo
            "<form method = 'POST' action = 'verification_key.php' enctype = 'multipart/form-data'>
                <input type = 'hidden' name = 'user_email' value = '".$user_email."' />
                <input type = 'hidden' name = 'verification_code' value = '".$verification_code."' />
                <input type = 'text' class = 'input' name = 'v_code' placeholder = 'Verification Code' />
                <button name = 'next'>Continue</button>
            </form>";
            $receiver = $user_email;
        $subject = "Verification Code";
        $body = "Your Verification Code: $verification_code";
        $sender = "ianjohn0101@gmail.com";

        mail($receiver, $subject, $body, $sender);

        }
        else
        {
            echo "<script>alert('Email  incorrect!');</script>";
        }
    }

    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
?>