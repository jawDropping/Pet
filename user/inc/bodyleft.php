<?php
    if(!isset($_GET['myPet'])){
    if(!isset($_GET['donation'])){
    if(!isset($_GET['orders'])){
?>
<div id = "bodyleft">

    <div id = "slider">
        <p>FEATURED PRODUCTS</p>
        <img src = "/Pet/uploads/slider/pet-food-1.png">
    </div>

    <?php
    if(isset($_GET['myPet'])){
        include("myPet.php");
    }
    if(isset($_GET['donation'])){
        include("donate.php");
    }
    if(isset($_GET['orders'])){
        include("orders.php");
    }
    ?>
    <div class="bottomDiv">
    <ul><?php echo dog_food_products(); ?></ul><br clear='all' />
    <ul><?php echo fish_food_products(); ?></ul><br clear='all' />
    </div>
   
</div><!-- <End of Bodyleft> -->
<?php }}}?>