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
            
           echo 
           "<div id = 'insideDiv'>
           <a class = 'servDiv' href =  'view_order.php?user_id=".$_SESSION['user_id']."' style = 'text-decoration: none;color:#000;'><img class = 'image' src='./uploads/grooming.png' alt=''>View Orders</a>
           </div>";
        ?>

    <div class="containersest">
          
    <?php
        $current_user = $_SESSION['user_id'];
        $sql2 = $con->prepare("SELECT * FROM users_table WHERE user_id = '$current_user'");
        $sql2->setFetchMode(PDO:: FETCH_ASSOC);
        $sql2->execute();

        $row2 = $sql2->fetch();
        $user_username = $row2['user_username'];

        $sql = $con->prepare("SELECT * FROM delivery_tbl WHERE user_username = '$user_username'");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();

        $row = $sql->fetch();
        if($row>0)
        {
            
    ?>

    <div class="ttl">
    <img src="../uploads/orderist.png" id = 'orderIc' > <h3>Deliveries</h3>
    </div>
  
    <div class="contTable">
    <div class = 'inside'>
        
        <div class="divHead">
            <p class = 'headers'>ITEMS</p>
        </div>
        <div class = 'divHead'>
             <p class = 'headers'>SUB-TOTAL</p>
        </div>
        
        <div class="divHead">
             <p class = 'headers'>ORDER STATUS</p>
        </div> 
        <br>
           <?php


        $current_user = $_SESSION['user_id'];
        $sql2 = $con->prepare("SELECT * FROM users_table WHERE user_id = '$current_user'");
        $sql2->setFetchMode(PDO:: FETCH_ASSOC);
        $sql2->execute();

        $row2 = $sql2->fetch();
        $user_username = $row2['user_username'];

        $sql = $con->prepare("SELECT * FROM delivery_tbl WHERE user_username = '$user_username'");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();

        while($row = $sql->fetch()):
        

        echo
                "<div class = 'dataHolder'>
                    <p class = 'dataCont'>".$row['items']."</p>
                    </div>
                    <div class = 'dataHolders'>
                    <p class = 'dataCont' >₱".$row['total_amount']."</p>
                    </div>";
                    // if($row['delivery_status'] != 'UNSUCCESSFUL')
                    // {
                    //     echo"<div class = 'dataHolder'>
                    //     <p class = 'dataCont'>".$row['delivery_status']."</p>
                    //     <p class = 'dataCont'>Delivery Date:".$row['delivery_date']."</p>
                    //     </div>";
                    // }
                    
                    // else
                    // {
                    //     if($row['redelivery'] == 'REQUEST FOR REDELIVERY')
                    //     {
                    //         echo"<div class = 'dataHolder'>
                    //         <p class = 'dataCont'>".$row['delivery_status']."</p>
                    //         <p class = 'dataCont'>Date Delivered:".$row['date_delivered']."</p>
                    //         </div>";
    
                    //         echo
                    //         "<a href = 'redeliver_item.php?redeliver=".$row['delivery_id']."' style = 'text-decoration:none;color:white;padding:.5rem;margin-top:30px;height:20px;width:150px;background-color:blue;border-radius:20px;'>Redeliver</a>";
                    //     }
                    // }
                    if($row['delivery_status'] == 'FOR DELIVERY')
                    {
                        echo"<div class = 'dataHolder'>
                             <p class = 'dataCont'>".$row['delivery_status']."</p>
                             <p class = 'dataCont'>Delivery Date:".$row['delivery_date']."</p>
                             </div>";
                    }
                    if($row['delivery_status'] == 'UNSUCCESSFUL')
                    {
                        echo"<div class = 'dataHolder'>
                        <p class = 'dataCont'>".$row['delivery_status']."</p>
                        <p class = 'dataCont'>Date Delivered:".$row['date_delivered']."</p>
                        </div>";
                        if($row['redelivery'] == '')
                        {
                            echo
                            "<a href = 'redeliver_item.php?redeliver=".$row['delivery_id']."' style = 'text-decoration:none;color:white;padding:.5rem;margin-top:30px;height:20px;width:150px;background-color:blue;border-radius:20px;'>Redeliver</a>";
                        }
                        elseif($row['redelivery'] == 'REQUEST FOR REDELIVERY')
                        {
                            echo
                            "<a href = '#' style = 'text-decoration:none;color:white;padding:.5rem;margin-top:30px;height:20px;width:150px;background-color:red;border-radius:20px;'>Requested</a>";
                        }
                    }
                    
                    
                    
                    
                    
                   
            endwhile;
        
            
    ?> 
            
    
        </div>
    </div>
    </div>

    <?php
        }
        else
        {
            echo "
            <div class = 'blank'>
            <center>
            <img src = '../uploads/empty.gif'>
            <p class = 'state'>You don't have any deliveries!<a id = 'linkEmpty'href='/Pet/user/index.php'>Click Me!</a></p>
            </center>
            </div>";
        }
    ?>
    
    
    </div>
    <?php include("inc/footer.php");?>
    </body>
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        .blank{
            margin-top: 8vh;
            width: 70%;
            margin-left: 15%;
            padding: 15px;
            
        }
        .state{
            font-family: "Varela Round", sans-serif;
            font-size: 18px;
            margin-top: 4%;
        }
        #linkEmpty{
            font-family: "Varela Round", sans-serif;
            font-size: 18px;
            margin-top: 4%;
            margin-left: 10px;
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



