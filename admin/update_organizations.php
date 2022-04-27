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
<p class = 'hed'>Edit Organization</p>
<?php
    include("inc/db.php");

    if(isset($_POST['edit_org']))
    {
        $id = $_POST['edit_org'];
        $edit_details = $con->prepare("SELECT * FROM organizations WHERE id = '$id'");
        $edit_details->setFetchMode(PDO:: FETCH_ASSOC);
        $edit_details->execute();

        $row = $edit_details->fetch();

        echo
        "<form method = 'POST'>
            <tr>
                <td><input type = 'text' name = 'org_name' value = '".$row['org_name']."' /></td>
            </tr><br>
            <tr>
                <td><input type = 'text' name = 'org_location' value = '".$row['org_location']."' /></td>
            </tr><br>
            <tr>
                <td><input type = 'text' name = 'org_contact_number' value = '".$row['org_contact_number']."' /></td>
            </tr><br>
            <tr>
                <td><input type = 'text' name = 'org_email_address' value = '".$row['org_email_address']."' /></td>
            </tr><br>
            <tr>
                <td><input type = 'file' name = 'org_photo' value = '".$row['org_photo']."'/></td>
            </tr><br>
            <button name = 'update'>Update</button>
        </form>";
    
        
        if(isset($_POST['update']))
        {
            $org_id = $_POST['update'];
            $org_name = $_POST['org_name'];
            $org_location = $_POST['org_location'];
            $org_contact_number = $_POST['org_contact_number'];
            $org_email_address = $_POST['org_email_address'];
            $org_photo = $_POST['org_photo'];

            $update_org = $con->prepare("UPDATE organizations 
            SET 
            org_name='$org_name',
            org_location='$org_location',
            org_contact_number='$org_contact_number',
            org_email_adddress='$org_email_adddress',
            org_photo='$org_photo'
            WHERE 
            id = '$id'");
    
            if($update_org->execute())
            {
                echo "<script>alert('Updated Successfully!');</script>";
                echo "<script>window.open('index.php?manage_partner', '_self');</script>";
            }
            else
            {
                die('asdsadasdsa');
            }
        }
    }

    if(isset($_POST['delete_org']))
    {
        $id = $_POST['delete_org'];
        $delete_org =$con->prepare("DELETE FROM organizations WHERE id = '$id'");
        $delete_org->setFetchMode(PDO:: FETCH_ASSOC);
        $delete_org->execute();

        if($delete_org->execute())
        {
            echo "<script>alert('Deleted Successfully!');</script>";
            echo "<script>window.open('index.php?manage_partner', '_self');</script>";
        }
    }
?>

              
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
        margin-left: 2vw;
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






