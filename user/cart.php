<html>
    <head>
        <title>Pet Society</title>
        <link rel = "stylesheet" href="css/style.css" />

    </head>

    <body>
       
        <?php 
            include ("inc/function.php");
            include ("inc/header.php"); 
            include ("inc/navbar.php"); 
        ?>
        <div class = "cart">
            
                <?php 
                    call_user_func('cart_display');
                ?>
            
            
        </div>
        <?php include("inc/footer.php"); ?>
        

    </body>
</html>
