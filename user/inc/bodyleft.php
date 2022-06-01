<?php
    if(!isset($_GET['myPet'])){
    if(!isset($_GET['donation'])){
    if(!isset($_GET['orders'])){
?>
<div id = "bodyleft">
<div id = "insideDiv">
        
            <a class = 'contDiv' href = "showdogfood.php" style = "text-decoration: none;color:#000;"><img class = "image" src="../uploads/dog.svg" alt="">Dog</a>
            <a class = 'contDiv' href = "showcatfood.php" style = "text-decoration: none;color:#000;"><img class = "image2" src="../uploads/cat.svg" alt="">Cat</a>
            <a class = 'contDiv' href = "showfishfood.php" style = "text-decoration: none;color:#000;"><img class = "image" src="../uploads/fish.png" alt="">Fish</a>
            <a class = 'contDiv' href = "showbirdfood.php" style = "text-decoration: none;color:#000;"><img class = "image" src="../uploads/bird.jpg" alt="">Bird</a>
            <a class = 'contDiv' href = "showotherfoods.php" style = "text-decoration: none;color:#000;"><img class = "image" src="../uploads/spider.svg" alt="">others</a>
        </div>
        <div id = "slider">
        <div class="slideHead">
        <img class = "image" src="../uploads/featureProd.gif" alt="">
        <p class = "hedss">Pet Products</p>
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
    <h3>Dog Products</h3>
    <div class = 'fDogs'><?php echo featured_dog_food_products(); ?></div><br clear='all' />
    <h3>Cat Products</h3>
    <div  class = 'fDogs'><?php echo featured_cat_food_products(); ?></div><br clear='all' />
    <h3>Fish Products</h3>
    <div  class = 'fDogs' ><?php echo featured_fish_food_products(); ?></div><br clear='all' />
    <h3>Bird Products</h3>
    <div  class = 'fDogs' ><?php echo featured_bird_food_products(); ?></div><br clear='all' />
    <h3>Other Products</h3>
    <div  class = 'fDogs'><?php echo featured_other_food_products(); ?></div><br clear='all' />
    </div>
   
</div><!-- <End of Bodyleft> -->
<?php }}}?>

<style>
    .hedss{
  font-family: 'Varela Round', sans-serif;
  color: #444;
  font-size: 16px;
}
</style>