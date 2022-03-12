<div id = "header">
    <div class="firstlayer">
         <div class="logoSide">
             <img src="../uploads/logo2.png" class="logo"> <p class="petsociety">Pet Society Dashboard</p>
         </div>
         <div class="profile">
            <?php
                if(isset($_SESSION['admin_name']))
                {
                    echo "<div class='dropbtn'>
                            <img id = 'profilePic'/>
                            <p class='adminName'>".$_SESSION['admin_name']."</p>
                          </div>
                          <div class='drop-content'>
                            <a class='myProfile.php?login_user=".$_SESSION['admin_name']."'>Profile</a>
                            <a class='logout.php'>Logout</a>
                            <a class='gotoUser' href= '../user/index.php'>User Page</a>
                          </div>";
                }
            ?>
          </div>
        <div class="timeSide">
             <p id="currentDate"></p>
        </div>
    </div>

    
</div>