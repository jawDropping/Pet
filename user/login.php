<?php 
    include("inc/function.php");
    echo LogIn();
?>
<html>
    <head>
    <title>Login</title>
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
        <div id ="LoginForm">
            <div class="container">
                <div class="inside">
                    <div class="logoSide">
                    <img src="../uploads/logo2.png" class="logo"> <p class="petsociety">Pet Society</p>
                    </div>
              
                <h3>Welcome to Pet Society</h3>
                <form method = "POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"; enctype = "multipart/form-data">
                 
                       
                        <input class = "input" type="text" name = "user_username" placeholder = "Username"/>               
                        <input class = "input"type="password" name = "user_password"  placeholder = "Password"/></br>
                        <p>Or <a href = "/Pet/admin/login.php">Log in as Pet Center?</a></p>
                            <button  class = "button" name = "login_user" id = "login_user" >LOGIN</button>
                            <button  class = "signup" name = "signup" id = "signup"><a href = "/Pet/user/signup.php">SIGNUP</a></button>
                        </br>
                     
                    </form>
                </div>
           
            </div>
           
    </div>
    </body>

    <style>
        *{
            font-family: "Varela Round", sans-serif;
            color: #5a5bf3;
            
        }
        #LoginForm{
            display: flex;
            justify-content: center;
            width: 100vw;
            
            
            
        }
        p{
            text-align: center;
            margin-top: 10px;
            color: #666;
        }
        .container{
            display: flex;
            justify-content: center;
            border-radius: 5px;
            margin-top: 5vh;
            margin-left: 15%;
            margin-right: 15%;
            background: white;
            width: 60%;
            height: 70vh;
            box-shadow:4px 6px 16px 0px rgba(0, 0, 0, 0.2);
        }
        .inside{
            height: 100%;
            width: 50%;
            padding-top: 20px; 
        }
        .input{
           width: 100%;
           height: 56px;
           border-radius: 10px;
           padding: 10px;
           text-align: left;
           outline: none;
           border: .5px solid #444;
           margin-top: 15px;
    
        }
        .button{
            width: 100%;
            height: 56px;
            border-radius: 25px;
            margin-top: 20px;
            outline: none;
            border: none;
            color: #888;
        }
        .signup{
            width: 100%;
            height: 56px;
            border-radius: 25px;
            margin-bottom: 20px;
            margin-top: 10px;
            background: white;
            border: .8px solid #eee;
            color: #888;
        }
        .signup a{
            text-decoration: none;
             color: #888;
             display: block;
        }
        .signup:hover{
            background:  #91e7d9;
           transition: .5s;
           color: white;
        }
        .logo{
            width: 25px;
             height: 25px;
        }
       .logoSide{
        display: inline-flex;
        border-bottom: .9px solid black;
        padding-bottom: 10px;
        margin-bottom: 20px;
       }
       .petsociety{
           margin-left: 10px;
           color: #444;
       }
       @media (max-width: 800px){
           .container{
               margin-left: 0%;
               margin-right: 0%;
               width: 100%;
           }
       }
       @media(max-height: 750px){
           .container{
               height: 500px;
           }

       }
       @media(max-width: 500px){
            .inside{
                width: 90%;

            }
       }

    </style>
    <script>
            let input = document.querySelector(".input");
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



