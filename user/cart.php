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
            call_user_func('cart_display');
            include ("inc/footer.php"); 
        ?>
        
           
               
     
           
      
        

    </body>
    <style>
        td{
          
            text-align: center;
            border-bottom: 1px solid #aaa;
           
        }
     
        table{
            background: white;
            
            width: 100vw;
        }
        .data{
           display: grid;
           grid-template-columns: 14% 18% 26% 16% 12% 10%;
           margin-top: 2%;
        }
        .cart{
            padding: 0;
        }
        .cartDisplayImage{
            height: 50px;
        }
        .headerTitle{
            height: 56px;
            background: #eee;
            font-family: "Nunito", sans-serif;
        }
        
        .delete{
            height: 20px;
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
       .mainTebs{
           width: 90%;
           margin-left: 4%;
           margin-top: 3%;
           padding: 10px;
           border-radius: 5px;
           box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
           min-height: 70vh;
       }
       .heads{
           display: grid;
           grid-template-columns: 14% 18% 26% 16% 12% 10%;
           border-bottom: .8px solid #777;
           padding: 5px;
       }
       .lebss{
           font-weight: bold;
           color: #777;
           font-size: 18px;
       }
       .tots{
  
           float: right;
           width: 30%;
           margin-top: 3%;
           border-radius: 5px;
           margin-bottom: 40vh;
       }
       .ito{
        float: left;
     
       
       }
       .btnn{
          color: white;
           background: blue;
           padding: 10px;
           text-decoration: none;
           margin-left: 10px;
           border-radius: 5px;
       }
       
       .fotter{
           width: 100%;
           background: red;
       }
    </style>
</html>
