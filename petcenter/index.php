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
            ?>
            
           
            <div class = "ko">
        <div class="inners">
        <a class = 'lengkong' href = 'index.php'>My services</a>
        <a class = 'lengk' href = 'addService.php'>Add services</a>
        <a class = 'lengk' href = 'confirmRequests.php'>Requests(<?php echo count_requests();?>)</a>
        </div>
       
        </div>
            <div id='bodyleft'>
                <div class="kapo">
                <form method = "GET" action = "search.php"  enctype="multipart/form-data">
            search: <input type = "text" name = "user_query" />
            <button name = "search">Search</button>
        </form>
                <div class = 'mainer'>    
                    <?php timeline(); ?>
                    
                </div>
               
                </div>
               
                
            </div>
            <br>
            <div class="haha">
                    <p>jdhsakj</p>
                </div>

    </body>
    <style>
        .mainer{
           margin-top: 3%; 
        }
        
        .kapo{
            display: flex;
            flex-direction: column;
        }
        .haha{
            width: 100vw;
            background: rgb(0, 86, 157);
            height: 52px;
        }
        body{
            background: rgb(0,114,210);
            background: linear-gradient(90deg, rgba(0,114,210,1) 0%, rgba(0,182,194,1) 100%);
        }
    </style>
</html>

