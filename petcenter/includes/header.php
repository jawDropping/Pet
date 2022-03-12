<?php
	//initialize cart if not set or is unset
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
 
	//unset quantity
	unset($_SESSION['qty_array']);
?>

<div id = "header">
    <div id = "logo">
        <a href = "index.php"><img src = "../uploads/logo2.png" class="logo"/></a>
    </div><!-- <End of Logo> -->
   
   
    <div id = "search">
        <form method = "get" action = "search.php" enctype="multipart/form-data">
            <input type="text" name = 'user_query' placeholder = "Search products here..">
            <button id = "search_btn" name = "search"><img src = "../uploads/search.svg" class = "searchIcon"></button>
            <div id = 'link'>

            <?php
                if(isset($_SESSION['user_username']))
                {
                echo "<img class='profileImg' src = '../uploads/userIcon.svg'>";
                echo "
                <ul class ='dropcontent'>
                <li><a>My Profile</a></li>
                <li><a href = 'logout.php'>Log Out</a></li>
                </ul>
                ";
                }
                else
                {
                echo "<button id = 'login_btn'><a href = 'login.php'>LOGIN</a></button>";
                echo "<script type='text/javascript'> 
                document.getElementById('link').style.width = '11%';
                </script>"; 
                }   
                ?>
            </div>

            <button id = "cart_btn"><a href = 'cart.php'>Cart (<?php echo count($_SESSION['cart']); ?>)</a></button>
        </form>
    </div><!-- <End of Search> -->

    

    
   <!-- <End of Link> -->
</div><!-- <End of Header> -->
