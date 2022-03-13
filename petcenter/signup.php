<div id ="signUpForm">
    <h3>Sign Up</h3>
    <form method = "POST" enctype = "multipart/form-data">
        <table>
            <tr>
                <td>Username: </td>
                <td><input type="text" name = "PCusername" /></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><input type="password" name = "PCpassword" /></td>
            </tr>
            <tr>
                <td>Email: </td>
                <td><input type="text" name = "PCemail" /></td>
            </tr>
            <tr>
                <td>Pet Center Name: </td>
                <td><input type="text" name = "PCname" /></td>
            </tr>
            <tr>
                <td>Contact Number: </td>
                <td><input type="text" name = "PCcontact_number" /></td>
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

<?php 
    include("includes/function.php");
    echo signUp();
?>