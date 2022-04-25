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
            ?>
            <div id='bodyleft'>
            <div id = "insideDiv">
            <a class = 'contDiv' href = "showdogfood.php" style = "text-decoration: none;color:#000;"><img class = "image" src="../uploads/dog.svg" alt="">Dog</a>
            <a class = 'contDiv' href = "showcatfood.php" style = "text-decoration: none;color:#000;"><img class = "image2" src="../uploads/cat.svg" alt="">Cat</a>
            <a class = 'contDiv' href = "showfishfood.php" style = "text-decoration: none;color:#000;"><img class = "image" src="../uploads/fish.png" alt="">Fish</a>
            <a class = 'contDivSel' href = "showbirdfood.php" style = "text-decoration: none;color:#000;"><img class = "image" src="../uploads/bird.jpg" alt="">Bird</a>
            <a class = 'contDiv' href = "showotherfoods.php" style = "text-decoration: none;color:#000;"><img class = "image" src="../uploads/spider.svg" alt="">others</a>
        </div>

        <div class = 'hed' ><img src = '../uploads/bird.gif' id = 'imgTop'><p class = 'ttlHead' >twit</p>
        </div><br>
            <?php
            echo "<ul>";
                   bird_food_products(); echo"</ul>
                  </div>";
            include ("inc/bodyright.php"); 
            include ("inc/footer.php"); 
            // echo add_cart();
        ?>
    </body>
    <style>
        .contDivSel{
            display: flex;
            background: #ffb830;
            width: 80px;
            margin-right: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            padding: 3px;
            justify-content: center;
            border-radius: 5px;
            cursor: default;
        }
        #imgTop{
            height: 42px;
            padding: 10px;
            margin-left: 90%;
        }
        .hed{
            display: flex;
            border-bottom: 1px solid #ddd;
        }
        .ttlHead{
            margin-top: 20px;
            color: #777;
        }
    </style>
</html>