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
            echo "<div class = 'scroll' id = 'bodyright'>
            <h3>Requests</h3>
    <form method = 'POST' enctype = 'multipart/form-data'>
    <table>
        <tr>
       

            <th>Name</th>
            

            <th>Time</th>
           

            <th>Coupon Code</th>

            
            <th>Trnsaction Code</th>
            
            
            <th>Action</th>
        </tr>
        <tr>";
        view_requests();
        echo"</tr>
        </table>
    </form>";
            
                  echo"</div>";
           
        ?>
    </body>
</html>