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
            <form method = "post" enctype = "multipart/form-data">
                <?php 
                    echo cart_display();
                ?>
                </table>
            </form>
            
        </div>
        <?php include("inc/footer.php"); ?>
        

    </body>
</html>