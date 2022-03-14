<html>
    <head>
        <title>Pet Society</title>
        <link rel = "stylesheet" href="css/style.css" />
        <link rel = "stylesheet" href="css/style.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fredoka&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400&family=Nunito:wght@200&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&family=Rubik:wght@500&family=Varela+Round&display=swap" rel="stylesheet">
    </head>

    <body>
       
        <?php 
            include ("inc/function.php");
            include ("inc/header.php"); 
            include ("inc/navbar.php"); 
        ?>
        <div class = "cart">
            
                <?php 
                    call_user_func('cart_display');
                ?>
            
            
        </div>
        <?php include("inc/footer.php"); ?>
        

    </body>
    <style>
        td{
          
            text-align: center;
            border-bottom: 1px solid #aaa;
           
        }
        
        img{
            height: 10vh;
            margin-bottom: 10px;
        }
        table{
            background: white;
            padding: 5px;
            width: 100vw;
        }
        .data{
            background: white;
            padding-top: 10px;
            
            margin-bottom: 10px;
        }
        .data td{
            
            padding-top: 10px;
        }
        .cart{
            padding: 0;
        }
        .headerTitle{
            height: 56px;
            background: #eee;
            font-family: "Nunito", sans-serif;
        }
        
        .delete{
            height: 30px;
        }
        #pro_btndelete{
            width: 50%;
            height: 40px;
            background: #fff;
            border-radius: 3px;
            border: none;
        
            margin-bottom: 25px;
        }
        
       .productNem{
           text-align: left;
           margin-bottom: 10px;
           
          
       }
       .productNem p{
        transform: translate(0, -30px);
       }
    </style>
</html>
