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
                        <br><br>
                        <?php
    include("inc/db.php");

    if(isset($_GET['view_pet']))
    {
        $user_id = $_GET['view_pet'];

        $sql = $con->prepare("SELECT * FROM pets WHERE user_id = '$user_id'");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();

        $row = $sql->fetch();

        echo
        "
        <div class = 'bodys' >
        <p class = 'haha'>Pet: ".$row['pet']."</p>
        <p class = 'haha'>Pet Name: ".$row['pet_name']."</p>
        <p class = 'haha'>Pet Age: ".$row['pet_age']."</p>
        <p class = 'haha'>Pet Breed: ".$row['pet_breed']."</p>
        <p class = 'haha'>Pet Gender: ".$row['pet_gender']."</p>
        <p class = 'haha'>Pet Details: ".$row['pet_details']."</p>
        <p class = 'haha'>Vaccination Status: ".$row['vaccination_status']."</p>
        <p class = 'haha'>Pet Photo: ".$row['pet_photo']."</p>
        </div>";

    }

    echo "<a class = 'oks' href = 'confirmRequests.php'>Go Back</a>";
?>
                    
                    </div>   


  
    </body>
    <style>
          .maine{
            margin-top: 3%;
            
           
        }
        .bodys{
            width: 90%;
            padding: 10px;
            margin-top: 30px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }
        .oks{
            text-align: center;
            width: 50%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background:#5a5bf3;
            color: white;
            text-decoration: none;

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
        .haha{
            padding: 10px;
            font-family: "Varela Round", sans-serif;
            font-size: 16px;
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
