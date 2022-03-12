<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="css/style.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fredoka&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400&family=Nunito:wght@200&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&family=Rubik:wght@500&family=Varela+Round&display=swap" rel="stylesheet">
    </head>
    <body>
    <?php 
    include("inc/function.php");
    echo LogInAdmin();
    ?>

    <div id ="LoginForm">
        <div class="container">
            <div class="left">
            
            </div>
            <div class="right">
            <div class="inside">
                <div class="ttle">
                    <img src = "../uploads/lock.svg" class = "icon"><h6>ADMIN LOGIN</h6>
                </div>

                <form method = "POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"; enctype = "multipart/form-data">
                <p class="ok">Lets Work :></p>
                <input type="text" name = "admin_name" placeholder = "username"/></br>
                <input type="password" name = "admin_password" placeholder = "password" /></br>
                <button name = "login_admin" id = "login_admin">Log In</button>
                </form>
                </br>
            </div>
            </div>
        </div>
    </div>

    </div>
    </body>
    <style>
        body{
            background-image: linear-gradient(to bottom left, #5a5bf3, #91e7d9);
        }
        #LoginForm{
            display: flex;
            justify-content: center;
            width: 100vw;
            color: #333;
            font-family: 'Open Sans', sans-serif;
        }
        .container{
            display: flex;
            justify-content: center;
            margin-top: 8vh;
            background: white;
            width: 90%;
            height: 80vh;
            box-shadow:4px 6px 16px 0px rgba(0, 0, 0, 0.2);
        }
        .inside{
            height: 100%;
            width: 90%;
            
        }
        .ttle{
            display: inline-flex;
            margin-top: 10px;
        }
        .ttle h6{
            padding-top: 10px;
            padding-left: 5px;
        }
        .icon{
            position: relative;
            width: 20px;
        }
        .left{
            width: 40%;
            background-image: url("../uploads/adminlogin.svg");
            background-repeat: no-repeat;

        }
        .right{
            width: 60%;
            background: #eee;
            display: flex;
            justify-content: center;
        }
        form{
            width: 90%;
            margin-left: 50px;
            margin-top: 50px;
        }
        .ok{
            font-size: 28px;
            margin-left: 5%;
        }
        input{
            width: 90%;
            margin-left: 5%;
            margin-top: 20px;
            border-radius: 20px;
            border: none;
            height: 46px;
            outline: none;
            padding-left: 10px;
        }
        #login_admin{
            margin-top: 30px;
            outline: none;
            border: none;
            background: #6C63FF;
            color: white;
            height: 52px;
            width: 90%;
            margin-left: 5%;
            border-radius: 25px;
            margin-bottom: 40px;
        }
        @media (max-width: 800px){
           .container{
               flex-direction: column;
               margin-top: 0%;
               height: 100vh;
               width: 100vw;
           }
           .right{
            background-image: linear-gradient(to bottom left, #5a5bf3, #91e7d9);
               width:95%;
               margin-left: 2.5%;
               transform: translate(0, -180px);
               border-radius: 10px;
               height: 100vh;
           }
           .left{
              height: 100vh;
               width: 100%;
           }
            form{
               margin-left: 30px;
           }
        }
        @media (max-height: 700px){
            .container{
                height: 100vh;
            }
            .right{
                height: 500px;
            }
        }
    </style>
</html>



