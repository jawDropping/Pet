<html>
    <head>
        <title>Pet Society</title>
        <link rel = "stylesheet" href="css/style.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Fredoka+One&family=Open+Sans:wght@500&family=Palette+Mosaic&family=Rubik:wght@500&family=Varela+Round&display=swap" rel="stylesheet">
    </head>
    
    <body>
       
        <?php 
            include ("inc/function.php");
            include ("inc/header.php"); 
            include ("inc/navbar.php");  ?>


        <div class="mainCont">
        <?php service_info(); ?>
        
        </div>
        
        <div class = 'bottomD'>
        <?php showFeeds(); ?>
        </div>
        <div class="fot">
        <?php include ("inc/footer.php");?>
        </div>
           
        <style>
        .mainCont{
           
        }
        .loc{
            padding: 10px;
            margin-left: 15%;
            margin-bottom: 2%;
            font-weight: bold;
            color: #555;
            font-family: 'Varela Round', sans-serif;
            font-size: 20px;
        }
        .loces{
            width: 70%;
            
        }
        .loc2{
            padding: 10px;
            margin-bottom: 2%;
            font-weight: bold;
            color: #555;
            font-size: 20px;
            font-family: 'Varela Round', sans-serif;
        }
        .pckman{
            display: flex;
        }
        .secondBody{
            width: 60%;

        }
        .commentF{
            display: flex;
            margin-top: 1%;
            border-radius: 4px;
            padding: 10px;
            background: white;
        
            box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
        }
        .btnsF{
            outline:none;
            border: none;
            padding: 10px;
            border-radius: 2px;
            background: #ffb830;
        }
        .comment-box{
            width: 70vw;
            margin-left: 14vw;
            margin-top: 10%;
            border-radius: 4px;
            padding: 10px;
           
        }
        .headF{
            font-family: "Varela Round", sans-serif;
            font-weight: bold;
            font-size: 16px;
        }
        .inputCom{
            padding: 10px;
            border: 1px solid #ffb830;
            outline: none;
            width: 70%;
            height: 60px;
            margin-left: 15%;
            resize: none;
            font-size: 14px;
            font-family:  "Varela Round", sans-serif;

        }
       
        .bottomD{
           margin-left: 15%;
           width: 70%;
           padding: 5px 5px 20px 5px;
           margin-top: 3%;
           border-radius: 5px;
           box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;

        }

        #okpic{
            height: 450px;
            width: 100%;
            
        }
        #pic{
            width: 40%;
            padding: 1%;
          
        }
        .fot{
            margin-top: 25vh;
        }
        .holdest{
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            padding: 10px;
            width: 90%;
            display: inline-block;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .holdest2{
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            padding: 10px;
            width: 45%;
            display: inline-block;
            border-radius: 8px;
            margin-bottom: 10px;
       
        }
        .holdest3{
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            padding: 10px;
            width: 45%;
            display: inline-block;
            border-radius: 8px;
            margin-bottom: 10px;
            margin-left: 3%;
        }
        .mapGraph{
            width: 70vw;
            margin-left: 15vw;
            height: 50vh;
            border: none;
            border-radius: 10px;
            margin-bottom: 10px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
        }
        .lebs{
            color: #777;
            font-size: 12px;
            margin-bottom: 5px;
        }
        .conts{
            font-weight: bold;
            color: #555;
        }
        .btnss{
            float: right;
            display: flex;
            width: 30vw;
        }
        .holderister{
            display: flex;
            width: 95%;

        }
         .holderister2{
            display: flex;
            width: 100%;

        }
        .mainHoldest{
            display: grid;
            grid-template-columns: 50% 50%;
            margin-top: 20px;
            width: 90%;
            margin-left: 4%;

        }
        .hed{
            padding: 20px;
            font-weight: bold;
            font-size: 28px;
            color: #555;
        }
        .head51{
            padding-left: 20px;
            font-size: 10px;
            color: #555;
        }
        .head52{
            margin-top: 2px;
            font-size: 12px;
            padding-left: 20px;
            color: #555;
            
        }
       
        .bbm{
            padding: 15px;
            background: #ffb830;
            color: white;
            margin-left: 5px;
            font-size: 12px;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }
        .comss{
            margin: 10px 0px 10px 15%;
            padding: 5px;
            border-bottom: .9px solid #bbb;
            width: 70%;
           
        }
        .useCom{
            display: flex;
        }
        .pics{
            height: 45px;
            width: 45px;
            border-radius: 20px;
        }
        .revNem{
            font-size: 14px;
            font-weight: bold;
            color: #444;
            padding: 5px;
            margin-top: 10px;
            font-family: 'Varela Round', sans-serif;'
            
        }
        .revNemDet{
            font-size: 12px;
            color: #888;
            padding: 5px;
            margin-top: 12px;
            font-family: 'Varela Round', sans-serif;'
            
        }
        .rev{
            padding: 5px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
    </body>
   

</html>