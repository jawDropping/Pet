<?php 
    include("inc/function.php");
    echo LogInAdmin();
?>

<div id ="LoginForm">
    <h3>Admin Login</h3>
    <form method = "POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"; enctype = "multipart/form-data">
        <table>
            <tr>
                <td>Enter Username: </td>
                <td><input type="text" name = "admin_name" /></td>
            </tr>
            <tr>
                <td>Enter Password: </td>
                <td><input type="password" name = "admin_password" /></td>
            </tr>
        </table>
        <button name = "login_admin" id = "login_admin">Log In</button>
        <a href = "/Pet/user/login.php">Click here to Log in as a User</a>
    </form>
</div>


