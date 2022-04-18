<html>
    <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&family=Palette+Mosaic&family=Rubik:wght@500&family=Varela+Round&display=swap" rel="stylesheet">
        <title>Register</title>
    </head>
    <body>
    <div id ='mainCont'>
        <div class='inner'>
            <div class="innerist">
            <div id = 'innerer'>
                <br><br><br><br>
                <img src="../uploads/doggy.svg" id = 'imageMain'>
            </div>
            <div class="right">
                <div class="innerRight">
                <h3>REGISTER</h3>
                <form method = 'POST' enctype = 'multipart/form-data'>
                    <div id = 'contInn'>
                        <div>
                            <input class = 'inputer' type='text' name = 'pet_center_name' placeholder = 'Pet Centers Name' size = '50' required/>
                        </div>
                        <div>
                            <input class = 'inputer' type='text' name = 'email' placeholder = 'Email Address' size = '50' required/>
                        </div>
                        <div>
                            <input class = 'inputer' type='text' name = 'contact_number' placeholder = 'Contact Number' size = '50' required />
                        </div>
                        <div>
                            <input class = 'inputer' type='text' name = 'pet_center_password' placeholder = 'Password' size = '50' required />
                        </div>
                        <div>
                            <br>
                            <p>Will you accept coupons? <a class = 'ask'>Learn more about coupons</a></p> 
                           <br>
                            <p>Yes <input type = 'checkbox' name = 'accept_coupons' value = 'yes' /> No <input type = 'checkbox' name = 'accept_coupons' value = 'no'/></p>
                        </div><br>
                        <button name = 'add_user' id = 'regs'>Register</button>
                        <buttonon onclick="window.location.href = 'login.php';" id = 'backHome'>Back to Home</buttonon>
                    </div>
                    
                </form>
                </div>
           
            </div>
           
            </div> 
            </div>
        </div>
        <?php
         include("inc/function.php");
         call_user_func('add_pet_center_user');
        ?>  
    </body>
    <style>
            *{
                padding: 0;
                margin: 0;
                font-family: Verdana, Geneva, Tahoma, sans-serif;
            }
            #mainCont{
                
                display: flex;
                justify-content: center;
                
            }
            .inner{
                background: white;
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                width: 80%;
                margin-top: 12vh;
                height: 70vh;
            }
            .innerist{
                padding: 30px;
                display: flex;
            }
            #imageMain{
                height: 30vh;
            }
            #regs{
                background: #ffb830;
                  outline: none;
                  border: 1px solid #ffb830;
                  width: 150px;
                  padding: 10px;
                  border-radius: 10px;
                  margin-right: 10px;
                  color: white;
                  font-weight: bold;
            }
            .right{
                width: 60%;
                
            }
            .innerRight{
                padding-left: 30px;
                padding-right: 30px;
                padding-bottom: 30px;
            }
            .inputer{
                padding: 10px;
                outline: none;
                margin-bottom: 20px;
                border: 1px solid white;
                background: #fafafa;
                box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.1);
                height: 54px;
            }
            h3{
                color: #999;
                margin-bottom: 10px;
            }
            #innerer{
                padding: 30px;
                width: 30%;
            }
            #contInn{
                margin-left: 30px;
            }
            .ask{
                color: #888;
                font-size: 12px;
            }
            #backHome{
                border: 1px solid #ffb830;
                color: gray;
                width: 150px;
                padding: 10px;
                border-radius: 10px;
                margin-right: 10px;
                font-weight: bold;
                font-size: 14px;
                outline: none;
                cursor: default;
            }
    </style>
</html>
