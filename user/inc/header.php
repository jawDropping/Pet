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
        <img src = "../uploads/logo4.svg" class="logo"/>
        <a href = "index.php">PetSociety</a>
    </div><!-- <End of Logo> -->
   
   
    <div id = "search">
        <form method = "get" action = "search.php" enctype="multipart/form-data">
            <div class = 'asd'>
            <input type="text" class = 'intputs' name = 'user_query' placeholder = "Search here..">
            <button id = "search_btn" name = "search"><img src = "../uploads/search.svg" class = "searchIcon"></button>
            </div>
            <div id = 'link'>

            <?php
                if(isset($_SESSION['user_id']))
                {
                    // echo "<img class='profileImg' src = '../uploads/userIcon.svg'>";
                    // echo "
                    // <ul class ='dropcontent'>
                    // <li><a href = 'myProfile.php'>My Profile</a></li>
                    // <li><a href = 'logout.php'>Log Out</a></li>
                    // </ul>
                    // ";
                    include("inc/db.php");
                    $userid = $_SESSION['user_id'];
                    $getuserprofile = $con->prepare("SELECT * FROM users_table WHERE user_id = '$userid'");
                    $getuserprofile->setFetchMode(PDO:: FETCH_ASSOC);
                    $getuserprofile->execute();

                    $row = $getuserprofile->fetch();

                    echo "<img class='profileImg' src = '../uploads/user_profile/".$row['user_profilephoto']."'>
                            <ul class = 'dropcontent'>
                                <li><img src = '../uploads/forDropDown.png' class = 'imageDrop'><a href = 'myProfile.php'>Profile</a></li>
                                <li><img src = '../uploads/orderist.png' class = 'imageDrop'><a href = 'view_order.php?user_id=".$row['user_id']."'>My Orders</a></li>
                                <li><img src = '../uploads/history.png' class = 'imageDrop3'><a href = 'transaction_history.php?user_id=".$row['user_id']."'>Transaction History</a></li>
                                <li><img src = '../uploads/logouter.png' class = 'imageDrop2'><a href = 'logout.php'>Log Out</a></li>
                            </ul>";
                    
                }
                else
                {
                    echo "<button id = 'login_btn'><a href = 'login.php'>Login</a></button>";
                    echo "<script type='text/javascript'> 
                    document.getElementById('link').style.width = '11%';
                    </script>"; 
                }   
                ?>
            </div> <!-- <End of Link> -->

           
        </form>
        
    </div><!-- <End of Search> -->
        <div class="cartes">
        <button id = "cart_btn"><a href = 'cart.php'>Cart (<?php echo count($_SESSION['cart']); ?>)</a></button>
        </div>
    
    

    
  
</div><!-- <End of Header> -->
    <style>
        .imageDrop{
            height: 24px;
            margin-top: 8px;
            margin-left: 4px;
        }
        .imageDrop2{
            height: 18px;
            margin-top: 8px;
            margin-left: 6px;
        }
        .imageDrop3{
            height: 22px;
            margin-top: 8px;
            margin-left: 6px;
        }

    </style>
