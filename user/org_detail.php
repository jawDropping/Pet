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
            color: #444;
            font-weight: bold;
            padding: 10px;
            font-size: 30px;
        }
       
        #serviceDet { 
         width: 100%;
         background: #fff;
        }
        .images{
            width: 80vw;
            height: 100vh;
           
        }
        #innerService{
         box-sizing: border-box;
         width: 100%;
         padding: 30px;
        
        }
        center{
        
        }
        #oks{
            margin-bottom: 40px;
        }
        .fsTxt{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            margin-bottom: 20px;
            line-height: 1.5;
        }
        .btnDon{
            padding: 10px;
            background: #ffb830;
            text-decoration: none;
            
            color: white;
            border-radius: 5px;
            text-align: center;
        }
        .mainInfos{
            display: flex;
            border-radius: 8px;
            width: 80%;
            
            margin-left: 10%;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }
        .infoss{
            display: grid;
            grid-template-columns: 20% 50%;
            row-gap: 5px;
            width:80%;
            padding: 20px;
           
        }
        .donsite{
         height: 300px;
        }
        .rightInfo{
            width: 30%;
          
         
        }
        .lebels{
            padding: 10px;
            text-align: right;
            color: #777;
            font-size: 14px;
           
            border-radius: 3px;
        }
        .dates{
            padding: 10px;
           
        }
    </style>
</html>