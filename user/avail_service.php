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

            include ("inc/function.php");
            include ("inc/header.php"); 
            include ("inc/navbar.php"); 

            

            
        ?>

 
            <div class ='mainDiv'>
            <?php avail_service(); ?>
            </div>
   
    </body>
    <style>
           .mainDiv{
        width: 90%;
        margin: 7vh 5% 0 5%;
        height: 90vh;
        background: green;
        border-radius: 5px;
        padding: 10px;
    }
    .maines{
        background: red;
        display: grid;
        grid-template-columns: 40% 60%;
        width: 50%;
        padding: 10px;
        margin-left: 25%;
        row-gap: 20px;
    }
    .hh{
        text-align: center;
    }
    </style>
</html>

