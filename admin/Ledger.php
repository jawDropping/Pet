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
                <li><a href="coupons.php">Coupon Application</a></li>
                <li><a href="manage_partner.php">Manage Partners</a></li>
                <li class = 'selection' ><a href="ledger.php">Ledger</a></li>
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

<p class = 'hed'>Donation Records</p>
<div class="ledger">
    <div class="body">
        
       <div>
       <form method = 'GET' action = 'search_transaction_number.php' enctype = 'multipart/form-data'>
           Search Transaction Number: <input type = 'text' name = 'transaction_number' placeholder = 'Search Transaction Number..' />
           <button id = 'search_btn' name = 'search'>Search</button><br>
        </form>
       
        <div class = 'gridnasad'>
           <p>Transaction Number</p>

            <p>Full Name</p>

            <p>Selected Organization</p>

            <p>Contact Number</p>

            <p>Date Confirmed</p>
            <div></div>
        </div>
        <tr>
            <?php
                echo showledger();
            ?>
        </tr>
       </div>
    </div>

</div>
              
                </div>
                </div>
                
            <?php
                include ("inc/footer.php"); 
            
        ?>
    </body>
    <style>
    .ledger{
        height: 100vh;
        width: 100%;
  
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
    .gridnasad{
        display: grid;
        grid-template-columns:  20% 20% 20% 20% 20%;
        border-bottom: 1px solid #aaa;
    }
    #forming{
        display: grid;
        grid-template-columns: 20% 20% 20% 20% 20%;
        font-size: 14px;
        margin-top: 20px;
    }
</style>



    <script>
        var month = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
        var today = new Date();
        var date = today.getFullYear()+'-'+month[(today.getMonth())]+'-'+today.getDate();
        var date2 = month[(today.getMonth())]+' '+today.getDate()+' '+today.getFullYear();
        document.getElementById("currentDate").innerHTML = date2;
    </script>
</html>





