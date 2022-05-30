
<html>
    <head>
    <title>Verify Email</title>
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
                <div class="colorSide">
                <img class = 'hello' src="../uploads/petS.svg">
                </div>
                <div class="inside">
                    <div class="insider">
                    <div class="logoSide">
                    <img src="../uploads/logo2.png" class="logo"> <p class="petsociety">Pet Society</p>
                    </div>
              
                <h3>Verify Email</h3>
                <form method = "POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"; enctype = "multipart/form-data">
                 
                       
                        <input class = "input" type="email" name = "email" placeholder = "Email"/>               
                        <input class = "input"type="text" name = "v_key"  placeholder = "Verification Key"/></br>
                            <button  class = "button" name = "submit" id = "login_user" >VERIFY</button>
                            
                        </br>
                     
                    </form>
                   
                    <a href = 'login.php'>Login</a>
                </div>
           
            </div>
            <?php
    include("inc/db.php");

    if(isset($_POST['submit']))
    {
        $email = $_POST['email'];
        $v_key = $_POST['v_key'];
        $sql = $con->prepare("SELECT * FROM pet_center_tbl WHERE email = '$email' AND v_key = '$v_key'");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();
        
        $row = $sql->rowCount();
        $rows = $sql->fetch();

        $pet_center_id = $rows['pet_center_id'];
        if($row>0)
        {
            $update = $con->prepare("UPDATE pet_center_tbl SET verified = '1' WHERE pet_center_id = '$pet_center_id'");
            $update->execute();

            if($update->execute())
            {
                echo "<script>alert('Account Verified!');</script>";
                echo "<script>window.open('login.php', '_self');</script>";
            }
        }
        else
        {
            echo "<script>alert('Email or Verification Key is invalid!');</script>";
            echo "<script>window.open('verify_email.php', '_self');</script>";
        }
    }
?>
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
            display: grid;
            grid-template-columns: 30% 70%;
            justify-content: center;
            border-radius: 5px;
            margin-top:  7vh;
            margin-left: 15%;
            margin-right: 15%;
            background: white;
            width: 60%;
            height: 70vh;
            box-shadow:4px 6px 16px 0px rgba(0, 0, 0, 0.2);
        }
        .inside{
           
        }
        .insider{
            height: 100%;
            width: 80%;
             margin-left: 10%;
        }
        .colorSide{
            background: #ffb830;
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
            background: #0080fe;
           transition: .5s;
           color: white;
        }
        .signup:hover a{
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
        margin-top: 5%;
       }
       .petsociety{
           margin-left: 10px;
           color: #444;
       }
       .hello{
           margin-top: 70%;
           width: 80%;
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
       a{
           text-decoration: none;
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



