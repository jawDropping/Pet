<?php
    
?>


<div id = "header">
    <div id = "logo">
        <a href = "index.php"><img src = "../uploads/logo2.png" class="logo"/></a>
    </div><!-- <End of Logo> -->
   
   
    <div id = "search">
        <form method = "get" action = "search.php" enctype="multipart/form-data">
            <input type="text" name = 'user_query' placeholder = "Search services here..">
            <button id = "search_btn" name = "search"><img src = "../uploads/search.svg" class = "searchIcon"></button>
            <div id = 'link'>

            <?php
                if(isset($_SESSION['pet_center_name']))
                {
                    // echo "<img class='profileImg' src = '../uploads/userIcon.svg'>";
                    // echo "
                    // <ul class ='dropcontent'>
                    // <li><a href = 'myProfile.php'>My Profile</a></li>
                    // <li><a href = 'logout.php'>Log Out</a></li>
                    // </ul>
                    // ";
                    include("inc/db.php");
                    $pet_center_name = $_SESSION['pet_center_name'];
                    $getuserprofile = $con->prepare("SELECT * FROM pet_center_tbl WHERE pet_center_name = '$pet_center_name'");
                    $getuserprofile->setFetchMode(PDO:: FETCH_ASSOC);
                    $getuserprofile->execute();

                    $row = $getuserprofile->fetch();

                    echo "<img class='profileImg' src = '../uploads/user_profile/".$row['pet_center_photo']."'>
                            <ul class = 'dropcontent'>
                                <li><a href = 'myProfile.php'>My Profile</a></li>
                                <li><a href = 'logout.php'>Log Out</a></li>
                                <li><a href = 'viewServices.php?pet_center_id=".$row['pet_center_id']."'>My Services</a><li>
                            </ul>";
                    
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
        </form>
    </div><!-- <End of Search> -->

    

    
   <!-- <End of Link> -->
</div><!-- <End of Header> -->
