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
                <li><a href="manage_partner.php">Manage Partners</a></li>
                <li><a href="ledger.php">Ledger</a></li>
            </ul>
        <li><a href = "/Pet/admin/sales_inventory.php"><img src="../uploads/sales4.svg" class="navicons">Products</a></li>
        <li class = 'selection' ><a href = "/Pet/admin/add_products.php"><img src="../uploads/box.svg" class="navicons">Product Management</a></li>
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

                <div class = 'addProduct'>
        <h3>Add Products</h3>
        <form method = 'POST' enctype = 'multipart/form-data'>
            <div class='formleft'>
    
            </div>
            <div class='formright'>
    
            </div>
            <table>
                <tr>
                    <td>Enter Product Name: </td>
                    <td><input type='text' name = 'pro_name' required/></td>
                </tr>
                <tr>
                    <td>Select Category Name: </td>
                    <td>
                        <select name = 'cat_name'>";
             
                                echo viewall_cat(); 
                            
                       echo" </select>
                    </td>
                </tr>
                <tr>
                    <td>Other Category: </td>
                    <td><input type='text' name = 'pro_brand' placeholder = 'Other category you prefer..'/></td>
                    
                </tr>
                <tr>
                    <td>Enter Product Brand: </td>
                    <td><input type='text' name = 'pro_brand' required /></td>
                </tr>
                <tr>
                    <td>Select 1st Product Image: </td>
                    <td><input type='file' name = 'pro_img' required/></td>
                </tr>
                <tr>
                    <td>Select 2nd Product Image: </td>
                    <td><input type='file' name = 'pro_img2' required/></td>
                </tr>
                <tr>
                    <td>Select 3rd Product Image: </td>
                    <td><input type='file' name = 'pro_img3' required/></td>
                </tr>
                <tr>
                    <td>Select 4th Product Image: </td>
                    <td><input type='file' name = 'pro_img4' required/></td>
                </tr>
                <tr>
                    <td>Enter Price: </td>
                    <td><input type= 'text' name = 'pro_price' required/></td>
                </tr>
                <tr>
                    <td>Enter Quantity: </td>
                    <td><input type='text' name = 'pro_quantity' required/></td>
                </tr>
                <tr>
                    <td>Enter KeyWord: </td>
                    <td><input type= 'text' name = 'pro_keyword' required/></td>
                </tr>
            </table>
            <button name = 'add_prod'>Add Product</button>
        </form>
        </div>
                </div>
                </div>
                
            <?php
                include ("inc/footer.php"); 
            
        ?>
    </body>
    <style>
    .addProduct {
      margin-top: 7vh;
      width: 100%;
      }
      .selection {
  background: #28287774;
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


