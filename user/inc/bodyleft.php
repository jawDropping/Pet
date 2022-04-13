<?php
    if(!isset($_GET['myPet'])){
    if(!isset($_GET['donation'])){
    if(!isset($_GET['orders'])){
?>
<div id = "bodyleft">
<div id = "insideDiv">
            <div class="contDiv">
            <img class = "image" src="../uploads/dog.svg" alt="">
            <a href = "showdogfood.php">Dog</a>
            </div>
            <div class="contDiv">
            <img class = "image2" src="../uploads/cat.svg" alt="">
            <a href = "showcatfood.php">Cat</a>
            </div>
            <div class="contDiv">
            <img class = "image" src="../uploads/fish.png" alt="">
            <a href = "showfishfood.php">Fish</a>
            </div>
            <div class="contDiv">
            <img class = "image" src="../uploads/bird.jpg" alt="">
            <a href = "showbirdfood.php">Bird</a>
            </div>
            <div class="contDiv">
            <img class = "image" src="../uploads/spider.svg" alt="">
            <a href = "showotherfoods.php">others</a>
            </div>
        </div>
        <div id = "slider">
        <div class="slideHead">
        <img class = "image" src="../uploads/featureProd.gif" alt="">
        <p>FEATURED PRODUCTS</p>
        </div>
       
      
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
    <ul><?php echo featured_dog_food_products(); ?></ul><br clear='all' />
    <ul><?php echo featured_fish_food_products(); ?></ul><br clear='all' />
    </div>
   
</div><!-- <End of Bodyleft> -->
<?php }}}?>