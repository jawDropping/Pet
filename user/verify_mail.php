
<html>
    <head>
    <title>Forgot Password</title>
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
              
                
                    <?php
    include("inc/db.php");
    if(isset($_POST['continue']))
    {
        $user_email = $_POST['user_email'];
        $verification_code = generateRandomString();

        $check_email = $con->prepare("SELECT * FROM users_table WHERE user_email = '$user_email'");
        $check_email->setFetchMode(PDO:: FETCH_ASSOC);
        $check_email->execute();

        $row = $check_email->rowCount();
        $rows = $check_email->fetch();
        
        if($row>0)
        {
            
            echo 
            "<br>Verification Code was sent to: $user_email";
                echo
                "<form method = 'POST' action = 'verification.php' enctype = 'multipart/form-data'>
                    <input type = 'hidden' name = 'user_email' value = '".$user_email."' />
                    <input type = 'hidden' name = 'verification_code' value = '".$verification_code."' style = 'display:none;'/>
                    <input type = 'text' class = 'input' name = 'v_code' placeholder = 'Verification Code' />
                    <button name = 'next' class = 'button'>Continue</button>
                </form>";
                $receiver = $user_email;
                $subject = "Verification Code";
                $body = "Your Verification Code: $verification_code";
                $sender = "ianjohn0101@gmail.com";

            mail($receiver, $subject, $body, $sender);

        }
        else
        {
            echo "<script>alert('Email  incorrect! or not yet registered');</script>";
            echo "<script>window.open('vefiy_email.php', '_self');</script>";
        }
    }

    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
?>         
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
                height: 100%;
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



