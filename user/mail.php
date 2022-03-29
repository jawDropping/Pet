<?php
    $reciever = "ianjohn0505@gmail.com";
    $subject = "Email Test";
    $body = "LOCALHOST TEST";
    $sender = "From: ianjohn0101@gmail.com";

    if(mail($reciever, $subject, $body, $sender))
    {   
        echo "Email sent successfully to $reciever";
    }
    else
    {
        echo "Email sent failed!";
    }
?>