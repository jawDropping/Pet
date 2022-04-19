<html>
    <head>
        <title>Dog Products</title>
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
            <div class="contDivSel">
            <img class = "image" src="../uploads/dog.svg" alt="">
            <a class = "linkes" href = "showdogfood.php">Dog</a>
            </div>
            <div class="contDiv">
            <img class = "image2" src="../uploads/cat.svg" alt="">
            <a class = "linkes" href = "showcatfood.php">Cat</a>
            </div>
            <div class="contDiv">
            <img class = "image" src="../uploads/fish.png" alt="">
            <a class = "linkes" href = "showfishfood.php">Fish</a>
            </div>
            <div class="contDiv">
            <img class = "image" src="../uploads/bird.jpg" alt="">
            <a class = "linkes" href = "showbirdfood.php">Bird</a>
            </div>
            <div class="contDiv">
            <img class = "image" src="../uploads/spider.svg" alt="">
            <a class = "linkes" href = "showotherfoods.php">others</a>
            </div>
        </div>


            <?php
            echo "<ul>";
                   dog_food_products(); echo"</ul>
                  </div>";
            include ("inc/bodyright.php"); 
            include ("inc/footer.php"); 
            
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
        }
    </style>
</html>