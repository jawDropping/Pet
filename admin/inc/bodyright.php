
<?php
    if(!isset($_GET['cat'])){
    if(!isset($_GET['viewall_sub_cat'])){
    if(!isset($_GET['add_products'])){
    if(!isset($_GET['viewall_products'])){
    if(!isset($_GET['viewall_users'])){
    if(!isset($_GET['viewall_orders'])){
    if(!isset($_GET['viewall_coupons'])){
    if(!isset($_GET['ledger'])){
    if(!isset($_GET['manage_donation'])){
    if(!isset($_GET['manage_partner'])){
    if(!isset($_GET['search_transaction_number'])){
    if(!isset($_GET['viewalldelivered_items'])){

?>

<div id = "bodyright">
    <?php 
    
        if(isset($_GET['edit_cat']))
        {
            include("edit_cat.php");
        } 
        if(isset($_GET['edit_prod']))
        {
            include("edit_prod.php");
        }
        if(isset($_GET['edit_sub_cat']))
        {
            include("edit_sub_cat.php");
        }
        if(isset($_GET['manage_partner']))
        {
            include("manage_partner.php");
        }
        if(isset($_GET['ledger']))
        {
            include("Ledger.php");
        }
        if(isset($_GET['viewall_orders']))
        {
            include("viewall_orders.php");
        }
        if(isset($_GET['search_transaction_number']))
        {
            include("search_transaction_number.php");
        }
    ?>
</div>

<?php }}}}}}}}}}}} ?>