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
                    <a class = 'lengk' href = 'index.php'>My services</a>
                    <a class = 'lengk' href = 'addService.php'>Add services</a>
                    <a class = 'lengkong' href = 'confirmRequests.php'>Requests(<?php echo count_requests();?>)</a>
                </div>
                    <div id = 'bodyleft'>
                        <br>
                        <form method = "get" action = "search.php" enctype="multipart/form-data">
                            <div class = 'serc'>
                            <input class = 'fafa' type="text" name = 'user_query' placeholder = "Search here..">
                            <button class = 'fofo' name = "search"><img src = "../uploads/search.svg" class = "searchIcon"></button>
</div>
                        </form>
                                <div class="maine">
                                    <p class = 'ttl'>Requests</p>
                                    <form method = 'POST' enctype = 'multipart/form-data' id = 'porm'>
                                <div>
                                    <div class = 'heds'>
                                        <p class = 'he' >NAME</p>
                                        <p class = 'he' >TIME</p>
                                        <p class = 'he' >COUPON CODE</p>
                                        <p class = 'he' >ACTION</p>
                                    </div>
                                    <div>
                                        <?php
                                            view_requests();
                                        ?>
                                    </div>
                                </div>
                                </form>
                    
                    </div>   
    </body>
    <style>
        .maine{
            margin-top: 3%;
            
           
        }
        #porm{
            padding: 20px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            border-radius: 8px;
        }
        .heds{
        display: grid;
        grid-template-columns: 30% 20% 20% 20%;
        border-bottom: .8px solid #777;
           padding: 5px;
           margin-bottom: 2%; 
        }
        .hed{
            display: grid;
            grid-template-columns: 30% 20% 20% 20%;
            margin-top: 1%;
           padding: 10px;
           background: #f4f4f4;
           border-radius: 4px;
        }
        .serc{
            display: flex;
            margin-top: 20px;
        }
        .fafa{
            outline: none;
           
            width: 30%;
        }
        .fofo{
            padding: 10px;
            border: none;
        }
        .asd{
            padding: 5px;
            text-align: center;
        }
        .asds{
            padding: 5px;
            text-align: left;
        }
        .divsha{
            width: 70%;
            margin-left: 15%;
        }
        .he{
            font-size: 18px;
            font-family:  "Varela Round", sans-serif;
            text-align: center;
        }
        .oks{
            text-align: center;
            width: 50%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background:#5a5bf3;
            color: white;
        }
        .ttl{
            font-size: 20px;
            margin-bottom: 5px;
            color: #5a5bf3;
        }
        .views{
            text-decoration: none;
            color: blue;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid blue;
        }
    </style>
</html>