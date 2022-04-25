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
        <li><a href = "/Pet/admin/sales_inventory.php"><img src="../uploads/sales4.svg" class="navicons">Products</a></li>
        <li><a href = "/Pet/admin/add_products.php"><img src="../uploads/box.svg" class="navicons">Product Management</a></li>
        <li><a href = "/Pet/admin/viewall_products.php"><img src="../uploads/deliver.svg" class="navicons">Deliveries(<?php echo count_deliveries();?>)</a></li>
        <li><a href = "/Pet/admin/viewall_orders.php"><img src="../uploads/deliver.svg" class="navicons">Orders(<?php echo count_orders();?>)</a></li>
        <li><a href= "/Pet/admin/viewall_coupons.php"><img src="../uploads/coupon.svg" class="navicons">Coupons</a></li> 
        <li><a href= "/Pet/admin/viewall_users.php"><img src="../uploads/user.svg" class="navicons">View All Users</a></li> 
        <li><a href= "/Pet/admin/viewalldelivered_items.php"><img src="../uploads/deliver.svg" class="navicons">Sales Inventory</a></li>
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
        <div class="partnerBody">
    <div class="body">
        <p>Donation Partnered Organizations</p>
       <table>
        <tr>
            <td>Name</td>
            <td>Location</td>
            <td>Contact Number</td>
            <td>Email Address</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
        <tr>
            <?php
                echo viewall_partners();
            ?>
        </tr>
       </table>
    </div>

</div>
        </div>
           </div>
    </body>
  
<style>
    .partnerBody{
        height: 100vh;
        width: 100%;
  
    }
    .body{
        margin-top: 7vh;
        margin-left: 2vw;
        background: #ddd;
        height: 90%;
        width: 95%;
        border-radius: 5px;
    }
    p{
        padding: 10px;
    }
    .selection {
  background: #28287774;
}
  
    
</style>
    <script>

    </script>
</html>
