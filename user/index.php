
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
            include ("inc/navbar.php"); 
            include ("inc/bodyleft.php"); 
           // include ("inc/bodyright.php"); 
            //include ("inc/footer.php"); 
            // include ("inc/login.php");
            // include ("inc/signup.php");
            
            echo add_cart();   
            
        ?>

    </body>
</html>