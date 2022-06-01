<html>
    <head>
    <title>Admin Panel</title>
        <link rel = "stylesheet" href="css/style.css" />
        <link rel = "stylesheet" href="css/users.css" />
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
           
           include ("inc/db.php");
           include ("inc/function.php"); 
           include ("inc/header.php"); 
           include ("inc/navbar.php"); 
           ?>
        <div class="mainContainer">
                <div id = "bodyleft">
<div class="leftBody">
      <ul class = 'mainUl'>
        <li class =  "donate"><a href = "index.php"><img src="../uploads/donation2.1.svg" class="navicons">Donations</a></li>
            <ul class="subList">
                <li><a href="coupons.php">Coupon Application</a></li>
                <li><a href="manage_partner.php">Manage Partners</a></li>
                <li><a href="ledger.php">Ledger</a></li>
            </ul>
        <li><a href = "/Pet/admin/products.php"><img src="../uploads/sales4.svg" class="navicons">Product Inventory</a></li>
        <li><a href = "/Pet/admin/add_products.php"><img src="../uploads/box.svg" class="navicons">Add Product</a></li>
        <li><a href = "/Pet/admin/deliveries.php"><img src="../uploads/deliver.svg" class="navicons">Deliveries(<?php echo count_deliveries();?>)</a></li>
        <li><a href = "/Pet/admin/viewall_orders.php"><img src="../uploads/ord2.png" class="navicons">Orders(<?php echo count_orders();?>)</a></li>
        <li  class = 'selection'><a href= "/Pet/admin/users.php"><img src="../uploads/user.svg" class="navicons">Users</a></li> 
        <li><a href= "/Pet/admin/sales.php"><img src="../uploads/report.png" class="navicons">Generate Report</a></li>
        <li><a href= "/Pet/admin/petcenterApplication.php"><img src="../uploads/deliver.svg" class="navicons">Pet Center Application</a></li>
        </ul>
</div>
         <div div class="leftFooter">
          <div class="iconContainer">
            <img src="../uploads/settings.svg" class="footicons">
            <img src="../uploads/notification.svg" class="footicons">
        </div>
        </div>
</div>
<div id="bodyright">
<p class = 'hed'>Customers Pet Information</p>
<br><br>
<div class = 'body'>
<?php

    include("inc/db.php");
    if(isset($_GET['view']))
    {
        $user_id = $_GET['view'];

        $sql = $con->prepare("SELECT * FROM pets WHERE user_id = '$user_id'");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        $row = $sql->fetch();

        echo
        "
       
        <img class = 'imaged' src = '../uploads/pets/".$row['pet_photo']."' />
        <div class = 'divs'>
        <p class = 'lebsth'>Pet Name </p> 
        <p class = 'inf'>".$row['pet_name']."</p>
        </div>
        <div class = 'divs'>
        <p class = 'lebsth'>Pet </p>
        <p class = 'inf'>".$row['pet']."</p>
        </div>
        <div class = 'divs'>
        <p class = 'lebsth'>Vaccination Status</p>
        <p class = 'inf'>".$row['vaccination_status']."</p>
        </div>
        <div class = 'divs'>
        <p class = 'lebsth'>Pet Age</p> 
        <p class = 'inf'>".$row['pet_age']."</p>
        </div>
        <div class = 'divs'>
        <p class = 'lebsth'>Pet Breed</p>
        <p class = 'inf'>".$row['pet_breed']."</p>
        </div>
        <div class = 'divs'>
        <p class = 'lebsth'>Pet Gender</p>
        <p class = 'inf'> ".$row['pet_gender']."</p>
        </div>
        <div class = 'divs'>
        <p class = 'lebsth'>Pet Details</p>
        <p class = 'inf'> ".$row['pet_details']."</p>
        </div>
        
        ";
    }
?>
</div>

                </div>
                </div>
    </body>
    <style>
        p{
            padding: 0;
        }
        .hed{
            padding: 10px;
        }
        .body{
            width: 90%;
        }
        .imaged{
            width: 90%;
            margin-left: 5%;
            border-radius: 5px;
            margin-bottom: 3vh;
        }
        .lebsth{
            color: #555;
            font-size: 12px;
            font-family: "Varela Round", sans-serif;
        }
        .inf{
            font-family: "Varela Round", sans-serif;
            font-size: 16px;
            padding: 5px;
        }
        .divs{
            border: 1px solid black;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            width: 80%;
            margin-left: 10%;
        }
    </style>
</html>
