<html>
    <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&family=Palette+Mosaic&family=Rubik:wght@500&family=Varela+Round&display=swap" rel="stylesheet">
    </head>
    <body>
    <div id ='mainCont'>
        <div class='inner'>
            <div class="innerist">
            <div>
                <img src="../uploads/doggy.svg" id = 'imageMain'>
            </div>
            <div class="right">
            <h3>REGISTER</h3>
                <form method = 'POST' enctype = 'multipart/form-data'>
                    <div>
                        <tr>
                            <td>Name: </td>
                            <td><input type='text' name = 'pet_center_name' required /></td>
                        </tr>
                        <tr>
                            <td>Password: </td>
                            <td><input type='text' name =  'pet_center_password' required /></td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td><input type='email' name =  'email' required /></td>
                        </tr>
                        <tr>
                            <td>Contact Number: </td>
                            <td><input type='text' name =  'contact_number' required /></td>
                        </tr>
                        <tr>
                            <td>Will you accept coupons?  <p>Learn more about coupons</p></td>
                           
                            <td>Yes<input type = 'checkbox' name = 'accept_coupons' value = 'yes' /> No<input type = 'checkbox' name = 'accept_coupons' value = 'no'/></td>
                        </tr>
                    </div>
                    <button name = 'add_user' id = 'regs'>Register</button>
                </form>
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
            }
            #mainCont{
                
                display: flex;
                justify-content: center;
                
            }
            .inner{
                background: gray;
                width: 60%;
                margin-top: 20vh;
            }
            .innerist{
                padding: 30px;
                display: flex;
            }
            #imageMain{
                height: 30vh;
            }
            #regs{
                padding: 10px;
            }
    </style>
</html>
