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
            include ("inc/navbar.php"); 
        ?>
        <div class="mainGyud">
        <?php
        call_user_func('cart_display');
        ?>
        </div><br>
        <div class="foot">
        <?php
        include ("inc/footer.php"); 
        ?>
        </div>
           
           
        
        
           
               
     
           
      
        

    </body>
    <style>
        
        td{
          
            text-align: center;
            border-bottom: 1px solid #aaa;
           
        }
        .quantity{
            margin-top: 25px;
            padding: 5px;
            width: 50%;
            border: none;
            font-size: 18px;
        
            height: 30px;
        }
        .inputss{
            text-align: center;
        }
        .inputss2{
            text-align: center;
            display: flex;
            width: 70%;
            margin-left: 15%;
            
        }
     
        table{
            background: white;
            
            width: 100vw;
        }
        .mainTebs{
           width: 80%;
           margin-left: 10%;
           margin-top: 3%;
           padding: 10px;
           border-radius: 5px;
           box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
       }
        .data{
           display: grid;
           grid-template-columns: 25% 22% 14% 8% 12% 8%;
           margin-top: 1%;
           padding: 10px;
           background: #f4f4f4;
           border-radius: 4px;

        }
        .data:hover{
            background: #ebebeb;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        }
        .heads{
           display: grid;
           grid-template-columns: 25% 22% 14% 8% 12% 8%;
           border-bottom: .8px solid #777;
           padding: 5px;
           margin-bottom: 2%;
       }
        .cart{
            padding: 0;
        }
        .cartDisplayImage{
            height: 100%;
            width: 25%;

        }
        .headerTitle{
            height: 56px;
            background: #eee;
            font-family: "Nunito", sans-serif;
            
        }
        .prodName{
            font-size: 16px;
            font-family:  "Varela Round", sans-serif;
            padding-top: 25px;
        }
        
        .delete{
            height: 20px;
        }
        #pro_btndelete{
            width: 50%;
            background: none;
            border-radius: 3px;
            border: none;
            margin-top: 25px;
        }
        
       .productNem{
           text-align: left;
           margin-bottom: 10px;
           
          
       }
       .productNem p{
        transform: translate(0, -30px);
       }
       #update {
        width: 40%;
        background: #0080fe;
        border-radius: 3px;
        border: 1px solid #0080fe;
        padding: 5px;
        color: white;
        height: 30px;
        margin-top: 25px;
    }
   
       
       .lebss{
           font-weight: bold;
           color: #0080fe;
           font-size: 18px;
           text-align: center;
           font-family:  "Varela Round", sans-serif;
           padding-bottom: 10px;

       }
       .inConts{
           text-display: center;
       }
       .tots{
            display: flex;
           float: right;
           width: 20%;
           margin-top: 3%;
           border-radius: 5px;
           padding: 20px;
           background: #f4f4f4;
           box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
           
       }
       .ito{
        float: left;
        font-family:  "Varela Round", sans-serif;
        font-size: 16px;
        color: #777;
        padding-top: 2px;
       
       }
       .itos{
        float: left;
        font-family:  "Varela Round", sans-serif;
        font-weight: bold;
        font-size: 18px;
        color: black;
        margin-left: 10px;
       
       }
       
       .btnn{
          color: black;
           background: #ffb830;
           padding: 10px 15px 10px 15px;
           font-family:  "Varela Round", sans-serif;
           text-decoration: none;
           margin-left: 10px;
           border-radius: 5px;
           
       }
       
       .fotter{
           width: 100%;
           background: red;
       }
       @media(max-width: 1000px){
        .mainTebs{
           width: 100vw;
           margin-left: 0;
           border-radius: 5px;
           box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
       }
       .tots{
           float: right;
           width: 50%;
           margin-top: 3%;
           border-radius: 5px;
           padding: 20px;
           background: #f4f4f4;
           box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
           
       }
       }
       @media(max-width: 1240px){
        .tots{
           
           width: 40%;
           margin-top: 3%;
           border-radius: 5px;
           padding: 20px;
           background: #f4f4f4;
           box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
           
       }
       }
       @media(max-width: 1024px){
        .tots{
           
           width: 60%;
           margin-top: 3%;
           border-radius: 5px;
           padding: 20px;
           background: #f4f4f4;
           box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
           
       }
       @media(max-width: 1870px){
        .tots{
           
           width: 30%;
           margin-top: 3%;
           border-radius: 5px;
           padding: 20px;
           background: #f4f4f4;
           box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
           
       }
       }
    </style>
</html>
