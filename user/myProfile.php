<html>
<head>
<title>Pet Society</title>
        <link rel = "stylesheet" href="css/profile.css" />
        <link rel = "stylesheet" href="css/style.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Fredoka+One&family=Open+Sans:wght@500&family=Palette+Mosaic&family=Rubik:wght@500&family=Varela+Round&display=swap" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php 
            include ("inc/header.php"); 
            include ("inc/navbar.php"); 
            include("inc/function.php");
        
        ?>
       
<form method = 'POST' enctype='multipart/form-data'>
                <div class='profileTable'>
                <div class = 'photo'>
                    <img src = '../uploads/user_profile/".$row['user_profilephoto']."' />
                    <input type = 'file' name = 'user_profilephoto' class = 'fileUpload' value = '".$row['user_profilephoto']."' required />
                </div>
                <p class='name'>User's Name</p>
                <div class = 'contf'>
                <div class='formt'>
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
                    <div class = 'usernameb'>
                        <button name = 'update_user'>Update Profile</button>
                    </div>
                    <div class = 'usernameh'>
                        <button class = 'back'><a href = 'index.php'>Back to Home</a></button>
                    </div>
                    </div>
                    <div class='rightSide'>
                        
                    </div>
                    </div>
                </div>
                
            </form>
            <?php
         call_user_func('add_pet_center_user');
         ?>
</body>
</html>
