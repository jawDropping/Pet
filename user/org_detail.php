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
           margin-right: 5%;
            float: right;
        }
        .mainInfos{
            display: flex;
            
            width: 90%;
            margin-left: 5%;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }
        .infoss{
            display: grid;
            grid-template-columns: 50% 50%;
            row-gap: 5px;
            width:80%;
            padding: 20px;
           
        }
        .miniLeft{
            display: grid;
            grid-template-columns: 30% 50%;
        }
        .miniRights{
            display: grid;
            grid-template-columns: 30% 50%;
        }
        .donsite{
         height: 250px;
        }
        .rightInfo{
            width: 20%;
          
         
        }
        .lebels{
            padding: 10px;
            text-align: right;
            color: #777;
            font-size: 12px;
            font-family: "Varela Round", sans-serif;
            border-radius: 3px;
        }
        .dates{
            padding: 10px;
            font-family: "Varela Round", sans-serif;
            margin-bottom: 7px;
            border-radius: 4px;
            border: 1px solid #007ffe9f;
        }
    </style>
</html>