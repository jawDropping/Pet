<html>
    <head>
    <title>Pet Society</title>
        <link rel = "stylesheet" href="css/style.css" />
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
    if(!isset($_SESSION['user_username']))
    {
        header("Location: login.php");
    }
    else
    {
        include("inc/db.php");
        $user_id = $_SESSION['user_username'];
        $fetch_user_username = $con->prepare("SELECT * FROM users_table WHERE user_username = '$user_id'");
        $fetch_user_username->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_user_username->execute();

        $row = $fetch_user_username->fetch();
        $id = $row['user_id'];

        echo 
        "<form method = 'POST' enctype='multipart/form-data'>
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
        ";

        if(isset($_POST['update_user']))
        {
            $user_username = $_POST['user_username'];
            $user_password =  $_POST['user_password'];
            $user_contactnumber = $_POST['user_contactnumber'];
            $user_email = $_POST['user_email'];

            $user_profilephoto = $_FILES['user_profilephoto']['name'];
            $user_profilephoto_tmp = $_FILES['user_profilephoto']['tmp_name'];

            move_uploaded_file($user_profilephoto_tmp,"..uploads/user_profile/$user_profilephoto");

            $update_user = $con->prepare("UPDATE users_table 
            SET 
                user_username='$user_username',
                user_password = '$user_password',
                user_contactnumber = '$user_contactnumber',
                user_email = '$user_email',
                user_profilephoto = '$user_profilephoto'
            WHERE 
                user_id = '$id'");

            if($update_user->execute())
            {
                echo "<script>alert('Your Information Successfully Updated!');</script>";
                echo "<script>window.open('index.php?login_user=".$_SESSION['user_username']."', '_self');</script>";
            }
        }
    }
    
?>


</div>
</body>

<style>
    *{
        padding: 0;
        margin: 0;
    }
    #ordPic{
        height: 30px;
        margin-right: 10px;
    }
    .useless{
        display: none;
    }
    .mainDiv{
        width: 90%;
        margin-left: 5%;
    }
    #headist{
        margin-top: 10px;
     font-size: 22px;
    }
    #confLine{
        font-size: 14px;
        background: #ffb830;
        padding: 5px;
    }
    
    .info{
        margin-top: 10px;
    }
    .info{
        background: white;
        border-radius: 5px;
        width: 100%;
        margin-bottom: 30px;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    }
    .innerInfo{
        padding: 10px;
    }
    
    #productDet{
        background: white;
        width: 100%;
        border-radius: 5px;
        border: 1px solid #0080fe;
    }
    #innerproductDet{
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 30px;
        padding-top: 20px;
    }
    .btnSection{
        margin-right: 15%;
        height: 45px;
        width: 100%;
        display: flex;
        justify-content: right;
        margin-top: 30px;
    }
    .place{
        background: #ffb830;
        outline: none;
        border: none;
        width: 150px;
        padding: 10px;
        border-radius: 10px;
        margin-right: 10px;
        color: white;
        font-weight: bold;
        
        
    }
    #placelink{
        text-decoration: none;
        color: white;
    }
    .cancelBtn{
        background: white;
        outline: none;
        border: 1px solid  #ffb830;
        color:  gray;
        font-weight: bold;
        padding: 10px;
        width: 120px;
        border-radius: 10px;
       
    }
    .cancelBtn a{
        text-decoration: none;
        color:  gray;
        font-weight: bold;
    }
    #locatePng{
        height: 15px;
    }
    #locationDiv{
        
        margin-top: 10px;
    }
    .group{
        
        display: grid;
        grid-template-columns: 10% 50%;
        gap: 20px;
        

    }
    #groupContainer{
        width: 90%;
        margin-left: 20px;
        margin-top: 20px;
    }
    .inputed{
        height: 42px;
        border: none;
        border: 1px solid #ddd;
        margin-bottom: 10px;
        padding: 4px;
    }
    .tag{
        font-size: 12px;
        color: gray;
        text-align: right;
        padding-top: 15px;
    }
    .ttl{
        width: 60%;
    }
</style>
</html>