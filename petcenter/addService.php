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
                        <td><input type='text' name =  'services_loc' /></td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td><input type='text' name =  'services_email' /></td>
                    </tr>
                    <tr>
                        <td>Contact Number: </td>
                        <td><input type='text' name =  'services_contact_number' /></td>
                    </tr>
                    <tr>
                        <td>Service Day From: </td>
                        <td>
                            <select name = "day_open">
                                <?php
                                     include("inc/function.php");
                                    call_user_func('days');
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Service Day To: </td>
                        <td>
                            <select name = "day_close">
                                <?php
                                    call_user_func('days');
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Time Open: </td>
                        <td><input type="time" name =  'time_open' /></td>
                    </tr>
                    <tr>
                        <td>Time Close: </td>
                        <td><input type="time" name =  'time_close' /></td>
                    </tr>
                    <tr>
                        <td>Service Cost: </td>
                        <td><input type="text" name =  'service_cost' /></td>
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