<html>
    <head>
        <title>Pet Society</title>
        <link rel = "stylesheet" href="css/style.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Fredoka+One&family=Open+Sans:wght@500&family=Palette+Mosaic&family=Rubik:wght@500&family=Varela+Round&display=swap" rel="stylesheet">
    </head>

    <body>
       
        <?php 
            include ("inc/db.php");
            include ("inc/function.php");
            include ("inc/header.php"); 
           ?>
            <div id = "navbar">
    <ul>
    <li>
            <a id = 'choice' href = 'index.php'>My services</a>
        </li>
        <li>
            <a id = 'choice2' href = 'addService.php'>Add Service</a>
        </li>
        <li>
            <a id = 'choice' href = 'confirmRequests.php'>Requests(<?php echo count_requests();?>)</a>
        </li>
    </ul>
</div>
         
           
<?php
    call_user_func('add_service');
?>
    </body>
</html>
