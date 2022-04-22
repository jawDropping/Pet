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
            echo org_detail();
            include ("inc/footer.php");
            
        ?>
    
    </body>
    <style>
        .mainCont{
            display: flex;
            width: 100%;
        }
        .Heads{
            color: gray;
            font-weight: bold;
            padding: 10px;
        }
       
        #serviceDet { 
         width: 100%;
         background: #fff;
        }
        .images{
            width: 100%;
            height: 100vh;
           
        }
        #innerService{
         box-sizing: border-box;
         width: 100%;
        
        }
        center{
        
        }
    </style>
</html>