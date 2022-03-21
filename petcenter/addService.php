<div id ='signUpForm'>
    <div class='signUpForm'>
        <h3>Add Service</h3>
            <form method = 'POST' enctype = 'multipart/form-data'>
                <table>
                    <tr>
                        <td>Name: </td>
                        <td><input type='text' name = 'services_name' /></td>
                    </tr>
                    <tr>
                        <td>Location: </td>
                        <td><input type='text' name =  'service_loc' /></td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td><input type='text' name =  'service_email' /></td>
                    </tr>
                    <tr>
                        <td>Contact Number: </td>
                        <td><input type='text' name =  'service_contact_number' /></td>
                    </tr>
                    <tr>
                        <td>Time Open: </td>
                        <td><input type='text' name =  'service_date_open' /></td>
                    </tr>
                    <tr>
                        <td>Photo: </td>
                        <td><input type='file' name =  'service_photo' /></td>
                    </tr>
                    <tr>
                    <td>Select Category Name: </td>
                    <td>
                        <select name = "cat_name">
                            <?php 
                                include("inc/function.php");
                                call_user_func('viewall_cat'); 
                            ?>
                        </select>
                     </td>
                    </tr>
                </table>
                <button name = 'add_service'>Add Service</button>
            </form>
        </div>
    </div>
<?php
    call_user_func('add_service');
?>