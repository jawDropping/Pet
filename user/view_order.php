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
    include("inc/function.php");
            include ("inc/header.php"); 
            include ("inc/navbar.php"); 
        ?>
        <div class = "scroll" id ="bodyright">
    <h3>My Order</h3>
    <table>
        <tr>
            <th>Product:</th>
            <th>Quantity</th>
            <th>Order Status</th>
            <th>Action</th>
        </tr>
        <tr>
            <?php
                 call_user_func('view_orders');
            ?>
        </tr>
        <a href = 'index.php'>Go Home</a>
        </table>
</div>
    </body>
</html>



