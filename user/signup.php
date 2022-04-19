<!DOCTYPE html>
<html>
    <head>
    <link rel = "stylesheet" href = "css/signup.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&family=Palette+Mosaic&family=Rubik:wght@500&family=Varela+Round&display=swap" rel="stylesheet">
        <title>Sign Up</title>
    </head>
    <body>
    <?php  include("inc/db.php"); ?>
    <div class = "mainContainer">
            <div class="insideDiv">
                <div class="rightSide">
                    <div class="topDiv">
                    <p id = "signUpHead">Sign Up</p> <img src="../uploads/home.svg" alt="" id="homies" onclick="window.location.href = 'index.php';">
                    </div>
                
                <form method = "POST" enctype = 'multipart/form-data'>
                    <div class="fieldMain">
                    <div class="fieldCont">
                        <p class = "label">Name:</p>
                        <input type="text" name = "user_username" class = "inputs" required>
                    </div>
                    <div class="fieldCont">
                        <p class = "label">Email:</p>
                        <input type="email" name = "user_email" class = "inputs" required>
                    </div>

                    <div class="fieldCont">
                        <p class = "label">Contact Number: </p>
                        <input type="text" name ="user_contactnumber" class = "inputs" autocomplete = "username" required>
                    </div>
                    <div class="fieldCont">
                        <p class = "label">Municipality:</p>
                        <input type="text" name = "municipality" class = "inputs" required>
                    </div>
                    <div class="fieldCont">
                        <p class = "label">Barangay :</p>
                        <input name = "barangay"  id = "pass" class = "inputs" autocomplete = "new-password" required>
                    </div>
                    <div class="fieldCont">
                        <p class = "label">Street :</p>
                        <input type="text" class = "inputs"  name = "user_address" autocomplete = "new-password" required>
                    </div>
                    <div class="fieldCont">
                        <p class = "label">Password :</p>
                        <input type="password" id = "confirmPass" class = "inputs"  name = "user_password" autocomplete = "new-password" required>
                    </div>
                    <div class="fieldCont">
                        <p class = "label">Confirm Password :</p>
                        <input type="password"  class = "inputs"  name = "conf_password" autocomplete = "new-password" required>
                    </div>
                    </div>
                    <button id = "sngup" name = "add_user">Sign Up</button><br>  
                </form>
                <?php 
                 include("inc/function.php"); call_user_func('signUp');?>
                </div>
                <div class="leftSide">
                
                        <img src="../uploads/signGirl.svg" alt="" id="imgLeft">
                </div>
            </div>
              
        </div>
    </body>
</html>


</div>



    