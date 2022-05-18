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
        <style>


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

</style>
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
                <li><a href="manage_donation.php">Coupon Application</a></li>
                <li class = 'selection' ><a href="manage_partner.php">Manage Partners</a></li>
                <li><a href="ledger.php">Ledger</a></li>
            </ul>
        <li><a href = "/Pet/admin/sales_inventory.php"><img src="../uploads/sales4.svg" class="navicons">Products</a></li>
        <li><a href = "/Pet/admin/add_products.php"><img src="../uploads/box.svg" class="navicons">Add Product</a></li>
        <li><a href = "/Pet/admin/viewall_products.php"><img src="../uploads/deliver.svg" class="navicons">Deliveries(<?php echo count_deliveries();?>)</a></li>
        <li><a href = "/Pet/admin/viewall_orders.php"><img src="../uploads/deliver.svg" class="navicons">Orders(<?php echo count_orders();?>)</a></li>
        <li ><a href= "/Pet/admin/viewall_coupons.php"><img src="../uploads/coupon.svg" class="navicons">Coupons</a></li> 
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
<p class = 'hed'>Add Organization</p>
<div>

    <div>
       
        <form method = "POST" enctype = "multipart/form-data"> 
            <tr>
                <label>Organization Name</label>
                <td><input type = "text" name = "org_name" /></td>
            </tr><br>
            <tr>
                <label>Organization Location</label>
                <td><input type = "text" name = "org_location" /></td>
            </tr><br>
            <tr>
                <label>Contact Number</label>
                <td><input type = "text" name = "org_contact_number" /></td>
            </tr><br>
            <tr>
                <label>Email Address</label>
                <td><input type = "text" name = "org_email_address" /></td>
            </tr><br>
            <tr>
                <label>Bank Detail</label>
                <td><input type = "text" name = "bank_details" /></td>
            </tr><br>
            <tr>
                <label>Website</label>
                <td><input type = "text" name = "website" /></td>
            </tr><br>
            <tr>
                <label>Paymaya</label>
                <td><input type = "text" name = "paymaya" /></td>
            </tr><br>
            <tr>
                <label>Organization Manager</label>
                <td><input type = "text" name = "org_manager" /></td>
            </tr><br>
            <tr>
                <label>Facebook</label>
                <td><input type = "text" name = "facebook" /></td>
            </tr><br>
            <tr>
                <label>Photo</label>
                <td><input type = "file" name = "org_photo" /></td>
            </tr><br>
            <tr>
                <td><button name = "add_org">Add Organization</button></td>
            </tr>
        </form>
    </div>
</div>

<?php
    echo add_partners();
?>

                </div>
                </div>
                
            <?php
                include ("inc/footer.php"); 
            
        ?>
    </body>



    <script>
        var month = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
        var today = new Date();
        var date = today.getFullYear()+'-'+month[(today.getMonth())]+'-'+today.getDate();
        var date2 = month[(today.getMonth())]+' '+today.getDate()+' '+today.getFullYear();
        document.getElementById("currentDate").innerHTML = date2;
    </script>
</html>




















