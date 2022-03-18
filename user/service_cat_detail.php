<html>
    <head>
        <title>Pet Society</title>
        <link rel = "stylesheet" href="css/style.css" />
    </head>

    <body>
       
        <?php 
            include ("inc/db.php");
            include ("inc/function.php");
            include ("inc/header.php"); 
            include ("inc/navbar.php"); 
            echo "<div id='bodyleft'><ul>";
                    service_cat_detail(); echo"</ul>
                  </div>";
            include ("inc/bodyright.php"); 
            include ("inc/footer.php"); 
        ?>
        
        
        
        
    </body>
</html>