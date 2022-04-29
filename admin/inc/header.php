<div id = "header">
    <div class="firstlayer">
         <div class="logoSide">
             <img src="../uploads/logo2.png" class="logo"> <p class="petsociety">Pet Society Dashboard</p>
         </div>
         <div class="profile">
            <?php
                if(isset($_SESSION['id']))
                {
                  $user_id = $_SESSION['id'];
                  $fetch_user_username = $con->prepare("SELECT * FROM admintbl WHERE id = '$user_id'");
                  $fetch_user_username->setFetchMode(PDO:: FETCH_ASSOC);
                  $fetch_user_username->execute();
          
                  $row = $fetch_user_username->fetch();
                    echo "<div class='dropbtn'>
                            <img id = 'profilePic'/>
                            <p class='adminName'>".$row['admin_name']."</p>
                          </div>
                          <div class='drop-content'>
                            <a href='myProfile.php?login_user=".$_SESSION['id']."'>Profile</a>
                            <a href ='logout.php'>Logout</a>
                            <a class='gotoUser' href= '../user/index.php'>User Page</a>
                          </div>";
                }
                else
                {
                  echo "<script>window.open('login.php', '_self');</script>";
                }
            ?>
          </div>
        <div class="timeSide">
             <p id="currentDate"></p>
        </div>
    </div>

    
</div>

