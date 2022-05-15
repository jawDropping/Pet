<!DOCTYPE html>
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
                       <li><a href="manage_donation.php">Manage Donations</a></li>
                       <li class = 'selection' ><a href="manage_partner.php">Manage Partners</a></li>
                          <li><a href="ledger.php">Ledger</a></li>
                   </ul>
        <li><a href = "/Pet/admin/products.php"><img src="../uploads/sales4.svg" class="navicons">Products</a></li>
        <li><a href = "/Pet/admin/add_products.php"><img src="../uploads/box.svg" class="navicons">Add Product</a></li>
        <li><a href = "/Pet/admin/deliveries.php"><img src="../uploads/deliver.svg" class="navicons">Deliveries(<?php echo count_deliveries();?>)</a></li>
        <li><a href = "/Pet/admin/viewall_orders.php"><img src="../uploads/deliver.svg" class="navicons">Orders(<?php echo count_orders();?>)</a></li>
        <li><a href= "/Pet/admin/viewall_coupons.php"><img src="../uploads/coupon.svg" class="navicons">Coupons</a></li> 
        <li><a href= "/Pet/admin/users.php"><img src="../uploads/user.svg" class="navicons">Users</a></li> 
        <li><a href= "/Pet/admin/sales.php"><img src="../uploads/deliver.svg" class="navicons">Sales Inventory</a></li>
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
        <p class = 'hed'>Partnered Organizations</p>
        <div class="partnerBody">
    <div class="body">
        
       <div>
        <div class ='gridnasad'>
            <p>Name</p>
            <p>Location</p>
            <p>Contact Number</p>
            <p>Email Address</p>
            <p>Edit</p>
            <p>Delete</p>
        </div>
        <tr>
            <?php
                echo viewall_partners();
            ?>
        </tr>
       </div>
  
    </div>
    <form method = 'POST' action = 'add_partners.php' enctype = 'multipart/form-data'>
                <button class = 'addPart'>Add Partners</button>
            </form>
</div>
        </div>
           </div>
    </body>
  
<style>
    .gridnasad{
        display: grid;
        grid-template-columns:  16% 16% 16% 20% 12% 12%;
        border-bottom: 1px solid #aaa;
    }
    .addPart{
        padding: 10px;
        float: right;
        margin-right: 2vw;
        margin-top: 5vh;
        width: 10vw;
        border: none;
        outline: none;
        border-radius: 5px;
    }
    .partnerBody{
        height: 200vh;
        width: 100%;
        
    }
    #forming{
        display: grid;
        grid-template-columns:  16% 16% 16% 20% 12% 12%;
        font-size: 14px;
        margin-top: 20px;
    }
    .body{
        margin-top: 7vh;
        margin-left: 20px;
        background: #fff;
        width: 95%;
        border-radius: 5px;
        padding: 10px;
         box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;
    }
    p{
        padding: 10px;
    }
    .selection {
  background: #28287774;
}
.hed{
        font-size: 22px;
        font-weight: bold;
        color: white;
    }
    .holdest{
        height: 42px;
    }
    #views{
        height: 30px;
  color: #777;
  font-weight: bold;
  border-radius: 3px;
  width: 100px;
  background: white;
  border: 1px solid #5a5bf3;
  margin-left: 5px;
    }
    #views2{
        height: 30px;
  color: #fff;
  border-radius: 3px;
  width: 100px;
  background: #5a5bf3;
  border: none;
    }
    
</style>
    <script>

    </script>
</html>
