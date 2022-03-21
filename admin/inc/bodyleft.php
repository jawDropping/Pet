<div id = "bodyleft">
<div class="leftBody">
<ul>
        <li class =  "donate"><a href = "index.php"><img src="../uploads/donation2.1.svg" class="navicons">Donations</a></li>
            <ul class="subList">
                <li><a href="index.php?manage_donation">Manage Donations</a></li>
                <li><a href="index.php?manage_partner">Manage Partners</a></li>
                <li><a href="index.php?ledger">Ledger</a></li>
            </ul>
        <li><a href = "/Pet/admin/index.php?sales_inventory"><img src="../uploads/sales4.svg" class="navicons">Sales Inventory</a></li>
        <li><a href = "/Pet/admin/index.php?add_products"><img src="../uploads/box.svg" class="navicons">Product Management</a></li>
        <li><a href = "/Pet/admin/index.php?viewall_products"><img src="../uploads/deliver.svg" class="navicons">Deliveries</a></li>
        <li><a href = "/Pet/admin/index.php?viewall_orders"><img src="../uploads/deliver.svg" class="navicons">Orders</a></li>
        <li><a href= "/Pet/admin/index.php?viewall_users"><img src="../uploads/coupon.svg" class="navicons">Coupons</a></li> 
        <li><a href= "/Pet/admin/index.php?viewall_users"><img src="../uploads/user.svg" class="navicons">View All Users</a></li> 

    </ul>
</div>
    <div class="leftFooter">
        <div class="iconContainer">
            <img src="../uploads/settings.svg" class="footicons">
            <img src="../uploads/notification.svg" class="footicons">
        </div>
    </div>
</div>

<?php
    if(isset($_GET['cat']))
    {
        include("cat.php");
    }
    if(isset($_GET['manage_donation']))
    {
        include('manage_donation.php');
    }
    if(isset($_GET['manage_partner'])){
        include('manage_partner.php');
    }
    if(isset($_GET['ledger']))
    {
        include("Ledger.php");
    }
    if(isset($_GET['sales_inventory']))
    {
        include("sales_inventory.php");
    }
    if(isset($_GET['viewall_products']))
    {
        include("viewall_products.php");
    }
    if(isset($_GET['viewall_orders']))
    {
        include("viewall_orders.php");
    }
    if(isset($_GET['add_products']))
    {
        include("add_products.php");
    }
    if(isset($_GET['viewall_users']))
    {
        include("viewall_users.php");
    }

?>