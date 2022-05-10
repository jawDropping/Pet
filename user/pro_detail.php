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
            echo pro_details();
            include ("inc/footer.php");
            
        ?>

    </body>
    <style>
        .dets{
            display: grid;
            grid-template-columns: 20% 80%;
            width: 70%;
            padding: 10px;
            border-radius: 5px;
        }
        .conts{
            padding: 10px;
            display: flex;
            border-top:1px solid #aaa;
            margin-top: 10px;
  
        }
        .lebes{
            font-weight: bold;
            font-size: 20px;
            color: #888;
        }
        .prodName{
            font-weight: bold;
            font-size: 24px;
            padding: 10px;
        }
        .prodBrand{
            font-size: 18px;
            margin-left: 10px;
            color: #888;
        }
        
    </style>
</html>