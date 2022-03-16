<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <div id ="signUpForm">
        <div class="container">
        <h3>Sign Up</h3>
        <form method = "POST" enctype = "multipart/form-data">
        <table>
            <tr>
                <td>Enter Username: </td>
                <td><input type="text" name = "user_username" /></td>
            </tr>
            <tr>
                <td>Enter Password: </td>
                <td><input type="password" name = "user_pass" /></td>
            </tr>
            <tr>
                <td>Repeat Password: </td>
                <td><input type="password" name = "repeat_user_pass" /></td>
            </tr>
            <tr>
                <td>Sign up as: </td>
                <td>
                    <select name = "user_type">
                        <option name = "">Customer</option>
                        <option name = "">Pet Center</option>
                    </select>
                </td>
            </tr>
        </table>
        <button name = "sign_up" id = "sign_up">Sign Up</button>
        </form>
        </div>
  
</div>

    </body>
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        #signUpForm{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100vw;
            height: 100vh;
        }
        .container{
            display: flex;
            justify-content: center;
            border-radius: 5px;
            margin-left: 15%;
            margin-right: 15%;
            background: white;
            width: 60%;
            height: 100%;
            box-shadow:4px 6px 16px 0px rgba(0, 0, 0, 0.2);
           
        }
        form{
            background: red;
            width: 70%;
            margin-top: 8vh;
        }

        @media(max-width: 680px) {
            .container{
                width: 100%;
                margin-left: 0%;
            margin-right: 0%;
            }
        }
    </style>
</html>