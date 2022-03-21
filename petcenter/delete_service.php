<?php
    include("inc/function.php");
    if(isset($_GET['delete_service']))
    {
        echo delete_service();
    }
?>