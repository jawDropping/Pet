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
    include("inc/function.php");
            include ("inc/header.php"); 
            include ("inc/navbar.php"); 
        ?>
    <div class="containersest">

    <div class="ttl">
    <img src="../uploads/orderist.png" id = 'orderIc' > <h3>Orders</h3>
    </div>
    
    <div class="contTable">
    <div class = 'inside'>
        <div class = 'divHead'>
             <p class = 'headers'>PRODUCT</p>
        </div>
        <div class="divHead">
            <p class = 'headers'>QUANITTY</p>
        </div>
        <div class="divHead">
             <p class = 'headers'>ORDER STATUS</p>
        </div>  
        <div class="divHead">
             <p class = 'headers'>ACTION</p>
        </div>
           <?php
                 call_user_func('view_orders');
            ?>
            
    
        </div>
    </div>
    </div>
    
    
    </div>
    <?php include("inc/footer.php");?>
    </body>
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        .inside{
            display: grid;
            grid-template-columns: 25% 25% 25% 25%;
            text-align: center;
            row-gap: 10px;

        }
        .containersest{
            margin-top: 20px;
            flex-direction: column;
            height: 90vh;
            width: 90vw;
            margin-left: 5%;
        }
        .divHead{
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }
        .headers{
            padding: 5px;
            font-weight: bold;
            color: #888;
        }
        h3{
            margin-bottom: 10px;
        }
        .dataHolders{
            text-align: left;
        }
        .dataCont{
            padding: 15px;
            
        }
       
        .dataLenk{
            padding: 15px;
            text-decoration: none;
            border-radius: 5px;
            color: #EC8173;
        }
        .dataLenk:hover{
            background: #EC8173;
            color: white;
            transition: .5s;
        }
        .contTable{
            padding: 20px;
            border-radius: 8px;
            background: white;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }
        .dataHolderTot
        {
            background: #ffb830;
            width: 90%;
            margin-left: 10%;
            text-align: center;
            border-radius: 10px;
        }
        #orderIc{
            height: 25px;
            margin-right: 5px;
        }
        .ttl{
            display: flex;
            margin-bottom: 10px;
        }
    </style>
</html>



