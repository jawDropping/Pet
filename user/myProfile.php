<html>
    <head>
    <title>Pet Society</title>
        <link rel = "stylesheet" href="css/style.css" />
        <link rel = "stylesheet" href="css/profile.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Fredoka+One&family=Open+Sans:wght@500&family=Palette+Mosaic&family=Rubik:wght@500&family=Varela+Round&display=swap" rel="stylesheet">
    </head>
    <body>
    <?php 
            include ("inc/function.php");
            include ("inc/header.php"); 
            include ("inc/navbar.php"); 
        ?>
        <div class="mainDiv">

        <?php
    if(!isset($_SESSION['user_id']))
    {
        header("Location: login.php");
    }
    else
    {
        include("inc/db.php");
        $user_id = $_SESSION['user_id'];
        $fetch_user_username = $con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
        $fetch_user_username->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_user_username->execute();

        $row = $fetch_user_username->fetch();
        $id = $row['user_id'];

        echo 
        
        "<div class='profileTable'>
        <div class = 'contf'>
        <form method = 'POST' enctype = 'multipart/form-data' id = 'pikt'>
        <div class = 'photo'>
            <div class = 'piktur'>
                <img id = 'profs' src = '../uploads/user_profile/".$row['user_profilephoto']."' />
            </div>
            <div class = 'intpus'>
            <div id = 'arden'>
                <p class ='uss'>Change Profile Picture</p>
                <input type = 'file'  name = 'user_profilephoto' id = 'checks' class = 'fileUpload' value = '".$row['user_profilephoto']."'/><br>
                </div>
                <button id = 'regss' name = 'update_profile'>Update Profile Picture</button>
            </div>
         </div>
         
        </form>
        
       <form method = 'POST' enctype='multipart/form-data' id = 'datapkt'>
            
           
            <div id = 'forBckgnd'>
            <div class='formt'>
            <div class = 'innerFormt'>
                <div class='username'>
                    <p class='us'>username </p>
                    <input class='user_name'type = 'text' name =  'user_username' value = '".$row['user_username']."' />
                </div>
                <div class='username'>
                    <p class = 'us'>password </p>
                    <input class='user_name' type = 'password' name = 'user_password' value = '".$row['user_password']."' />
                </div>
                <div class = 'username'>
                    <p class='us'>email </p>
                    <input class='user_name' type = 'email' name = 'user_email' value = '".$row['user_email']."' />
                </div>
                <div class = 'username'>
                    <p class = 'us'>Contact Number: </p>
                    <input  class = 'user_name 'type = 'text' name = 'user_contactnumber' value = '".$row['user_contactnumber']."' />
                </div>
                <div class = 'username'>
                    <p class = 'us'>Municipality: </p>
                    <input  class = 'user_name 'type = 'text' name = 'municipality' value = '".$row['municipality']."' />
                </div>
                <div class = 'username'>
                <p class = 'us'> Barangay: </p>
                <input  class = 'user_name 'type = 'text' name = 'barangay' value = '".$row['barangay']."' />
                 </div>
                <div class = 'username'>
                <p class = 'us'> Street: </p>
                <input  class = 'user_name 'type = 'text' name = 'user_address' value = '".$row['user_address']."' />
                 </div>
                 <div></div>
                </div>
                <div class = 'bottomBtn'>
                <div class = 'btn'>
                    <button id = 'regs2'><a id = 'bckHm' href = 'Pet/index.php'>Back to Home</a></button>
                </div>
                <div class = 'btn'>
                    <button name = 'update_user' id = 'regs'>Update Profile</button>
                </div>
                
                </div>
                </div>
                </div>
                </div>
            </div>
            </div>
        </form>
        </div>";
        

        if(isset($_POST['update_user']))
        {
            $user_username = $_POST['user_username'];
            $user_password =  $_POST['user_password'];
            $user_contactnumber = $_POST['user_contactnumber'];
            $user_email = $_POST['user_email'];
            $user_address = $_POST['user_address'];
            $barangay = $_POST['barangay'];
            $municipality = $_POST['municipality'];

            if(is_numeric($user_contactnumber))
            {
                if(strlen($user_contactnumber) <= 11)
                {
                    if(strlen($pet_center_password) >= 9 &&
                    preg_match('/[A-Z]/', $pet_center_password) > 0 &&
                    preg_match('/[a-z]/', $pet_center_password) > 0)
                    {
                        echo "Password must at least 8 characters in length with at least 1 special character, 1 number!";
                    }
                    else
                    {
                        $update_user = $con->prepare("UPDATE users_table 
                        SET 
                            user_username='$user_username',
                            user_password = '$user_password',
                            user_contactnumber = '$user_contactnumber',
                            user_email = '$user_email',
                            user_address = '$user_address',
                            barangay = '$barangay',
                            municipality = '$municipality'
                        WHERE 
                            user_id = '$id'");

                        if($update_user->execute())
                        {
                            echo "<script>alert('Your Information Successfully Updated!');</script>";
                            echo "<script>window.open('index.php?login_user=".$_SESSION['user_id']."', '_self');</script>";
                        }
                    }
                }
                else
                {
                    echo "Contact Number must at least 11 digits only!";
                }
            }
            else
            {
                echo "Only digits allowed!";
            }

        }
        if(isset($_POST['update_profile']))
        {
            $user_profilephoto = $_FILES['user_profilephoto']['name'];
            $user_profilephoto_tmp = $_FILES['user_profilephoto']['tmp_name'];

            move_uploaded_file($user_profilephoto_tmp,"..uploads/user_profile/$user_profilephoto");

            $update_profile = $con->prepare("UPDATE users_table SET user_profilephoto = '$user_profilephoto' WHERE user_id = '$id'");

            if($update_profile->execute())
            {
                echo "<script>alert('Profile Updated!');</script>";
                echo "<script>window.open('index.php?login_user=".$_SESSION['user_id']."', '_self');</script>";
            }
        }
    }
    
?>


</div>
<?php
include ("inc/footer.php"); 
?>
</body>
<script>
     let input = document.querySelector("#checks");
            let button = document.querySelector(".button");
            button.disabled = true;

            input.addEventListener("change", stateHandle);

            function stateHandle() {
           if (document.querySelector(".input").value === "") {
              button.disabled = true; //button remains disabled
              button.style.background = "#fafafa";
              button.style.boxShadow = "none";
              button.style.color = "#888";
             } else {
                  button.disabled = false; //button is enabled
                  button.style.background = "#5a5bf3";
                  button.style.boxShadow = "5px 7px 8px #aaa";
                  button.style.color = "white";
                  }
            }
</script>
</html>