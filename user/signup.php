<div id ='signUpForm'>
        <div class='signUpForm'>
            <h3>Registration</h3>
                <form method = 'POST' enctype = 'multipart/form-data'>
                    <table>
                        <tr>
                            <td>Name: </td>
                            <td><input type='text' name = 'user_username' required/></td>
                        </tr>
                        <tr>
                            <td>Password: </td>
                            <td><input type='text' name =  'user_password' required/></td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td><input type='text' name =  'user_email' required/></td>
                        </tr>
                        <tr>
                            <td>Municipality: </td>
                            <td><input type='text' name =  'municipality' required/></td>
                        </tr>
                        <tr>
                            <td>Barangay: </td>
                            <td><input type='text' name =  'barangay' required/></td>
                        </tr>
                        <tr>
                            <td>Full Address: </td>
                            <td><input type='text' name =  'address' required/></td>
                        </tr>
                        <tr>
                            <td>Contact Number: </td>
                            <td><input type='text' name =  'user_contactnumber' required/></td>
                        </tr>
                        <tr>
                            <td>Photo: </td>
                            <td><input type='file' name =  'user_profilephoto' required/></td>
                        </tr>
                    </table>
                    <button name = 'add_user'>Register</button>
                </form>
            </div>
        </div>
<?php 
    include("inc/function.php");
    call_user_func('signUp');
    
?>

    