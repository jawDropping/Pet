<html>
    <head>
    <title>Admin Panel</title>
        <link rel = "stylesheet" href="css/style.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fredoka&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400&family=Nunito:wght@200&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&family=Rubik:wght@500&family=Varela+Round&display=swap" rel="stylesheet">
    </head>
    <style>
        p{
        padding: 10px;
    }
    .hed{
        font-size: 22px;
        font-weight: bold;
        color: white;
    }
    .body{
        margin-top: 7vh;
        background: #fff;
        
        width: 95%;
        border-radius: 5px;
        padding: 10px;
        margin-left: 20px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;

    }
    .body2{
        margin-top: 7vh;
        
        width: 95%;
        border-radius: 5px;
        padding: 10px;
      
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;

    }
    .bodies{
        display: grid;
        grid-template-columns: 31% 31% 31%;
        column-gap: 10px;
        width: 95%;
        margin-left: 20px;
        border-radius: 5px;
        padding: 10px;
        background: #fff;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;
    }
    .holders{
        padding: 5px;
        border-radius: 8px;
        border: 1px solid #999;
        margin-bottom: 10px;
       
    }
    .seconds{
        display: grid;
        grid-template-columns: 50% 50%;
        column-gap: 10px;
        width: 90%;
        margin-left: 5%;
        margin-top: 30px;
    }
    .lebs{
        font-size: 12px;
        color: #999;
        font-family:  "Varela Round", sans-serif;
    }
    .oks{
        border: none;
        font-size: 18px;
        padding-left: 10px;
        font-weight: bold;
        outline: none;
        width: 80%;
        color: #555;
        font-family:  "Varela Round", sans-serif;
    }
    .btns{
        width: 70%;
        margin-left: 15%;
        border: none;
        outline: none;
        padding: 20px;
        border-radius: 5px;
        background: #5a5bf3;
        color: white;
    }
    .imges{
        height: 70px;
    }
    </style>
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
                       <li ><a href="manage_partner.php">Manage Partners</a></li>
                          <li><a href="ledger.php">Ledger</a></li>
                   </ul>
        <li class = 'selection' ><a href = "/Pet/admin/products.php"><img src="../uploads/sales4.svg" class="navicons">Sales Inventory</a></li>
        <li><a href = "/Pet/admin/add_products.php"><img src="../uploads/box.svg" class="navicons">Add Product</a></li>
        <li><a href = "/Pet/admin/viewall_products.php"><img src="../uploads/deliver.svg" class="navicons">Deliveries(<?php echo count_deliveries();?>)</a></li>
        <li><a href = "/Pet/admin/viewall_orders.php"><img src="../uploads/deliver.svg" class="navicons">Orders(<?php echo count_orders();?>)</a></li>
        <li><a href= "/Pet/admin/users.php"><img src="../uploads/user.svg" class="navicons">Users</a></li> 
        <li><a href= "/Pet/admin/sales.php"><img src="../uploads/deliver.svg" class="navicons">Sales Inventory</a></li>
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
        <p class = 'hed'>Edit Product</p>

        <?php echo edit_prod();?>
        </div>
</div>
    
    </body>
  
</html>
