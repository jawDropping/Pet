<html>
    <head>
    <title>Admin Panel</title>
        <link rel = "stylesheet" href="css/style.css" />
        <link rel = "stylesheet" href="css/add_part.css" />
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
        <li><a href = "/Pet/admin/products.php"><img src="../uploads/sales4.svg" class="navicons">Products</a></li>
        <li><a href = "/Pet/admin/add_products.php"><img src="../uploads/box.svg" class="navicons">Add Product</a></li>
        <li><a href = "/Pet/admin/viewall_products.php"><img src="../uploads/deliver.svg" class="navicons">Deliveries(<?php echo count_deliveries();?>)</a></li>
        <li><a href = "/Pet/admin/viewall_orders.php"><img src="../uploads/deliver.svg" class="navicons">Orders(<?php echo count_orders();?>)</a></li>
        <li><a href= "/Pet/admin/users.php"><img src="../uploads/user.svg" class="navicons">Users</a></li> 
        <li><a href= "/Pet/admin/sales.php"><img src="../uploads/deliver.svg" class="navicons">Generate Report</a></li>
        <li  class = 'selection' ><a href= "/Pet/admin/petcenterApplication.php"><img src="../uploads/deliver.svg" class="navicons">Pet Center Application</a></li>
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
<p class = 'hed'>Pet Center Applicant</p>
<div>

    <div class = "body">
     
<?php

if(isset($_GET['view']))
{
    $pet_center_id = $_GET['view'];
    $view = $con->prepare("SELECT * FROM pet_center_tbl WHERE pet_center_id = '$pet_center_id'");
    $view->setFetchMode(PDO:: FETCH_ASSOC);
    $view->execute();

    $row = $view->fetch();

    echo
    "<form method = 'POST' enctype = 'multipart/form-data'>
        Pet Center Name: <p>".$row['pet_center_name']."</p>
        Contact Number: <p>".$row['contact_number']."</p>
        Email: <p>".$row['email']."</p>
        Business Permit: <img class = 'bimg' src = '../uploads/business_permits/".$row['business_permit']."' style = 'height:50px;width:50px;'/>
       <button name = 'confirm' value = ".$pet_center_id.">Confirm Application</button>
    </form>";

    if(isset($_POST['confirm']))
    {
        $pet_center_id = $_POST['confirm'];

        $sql2 = $con->prepare("SELECT * FROM pet_center_tbl WHERE pet_center_id = '$pet_center_id'");
        $sql2->setFetchMode(PDO:: FETCH_ASSOC);
        $sql2->execute();
        
        $v_key = generateRandomString();

        $row = $sql2->fetch();
        
        if($row['verified'] == 1)
        {
            echo "<script>alert('This account has been confirmed!');</script>";
            echo "<script>window.open('petcenterApplication.php' ,'_self');</script>";
        }
        else
        {
            $receiver = $row['email'];
            $subject = "Account Confirmation!";
            $body = "Your account has been confirmed, please use this OTP Code: $v_key to validate your account!";
            $sender = "ianjohn0101@gmail.com";

            $sql = $con->prepare("UPDATE pet_center_tbl SET v_key = '$v_key' WHERE pet_center_id = '$pet_center_id'");
            $sql->setFetchMode(PDO:: FETCH_ASSOC);
            $sql->execute();
            
            if(!$sql->execute())
            {
                return;
            }

            mail($receiver, $subject, $body, $sender);
            echo "<script>alert('Confirmed!');</script>";
            echo "<script>window.open('petcenterApplication.php' ,'_self');</script>";
            
        }
    }
}
?>

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
    <style>
        .body{
        margin-top: 7vh;
        background: #fff;
        width: 80%;
        border-radius: 5px;
        padding: 20px;
        margin-left: 40px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;

    }
    </style>
</html>









