<div id ='donation_form'>
    <div class='donation_form'>
        <h3>Donate</h3>
            <form method = 'POST' enctype = 'multipart/form-data'>
                <table>
                    <tr>
                        <td>Transaction Number: </td>
                        <td><input type='text' name = 'transaction_number' required/></td>
                    </tr>
                    <tr>
                        <td>First Name: </td>
                        <td><input type='text' name =  'first_name' required/></td>
                    </tr>
                    <tr>
                        <td>Last Name: </td>
                        <td><input type='text' name =  'last_name' required/></td>
                    </tr>
                    <tr>
                        <td>Contact Number: </td>
                        <td><input type='text' name =  'contact_number' required/></td>
                    </tr>
                    <tr>
                        <td>Proof of Payment: </td>
                        <td><input type = 'file' name = 'proof_photo' required /></td>
                    </tr>
                    <tr>
                        <td>Suffix: </td>
                        <td>
                            <select name = 'suffix'>
                                <option value = 'jr'>jr</option>
                                <option value = 'sr'>sr</option>
                                <option value = 'N/A'>N/A</option>
                            </select>
                            <label style = "color:red">*Select N/A if you don't have any suffix.</label>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>Select Organization: </td>
                        <td>
                            <select name = 'org_name' required>
                                <?php
                                     include("inc/function.php");
                                    call_user_func('viewall_org');
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <button name = 'donate'>Donate</button>
            </form>
        </div>
    </div>
<?php
    call_user_func('donate');
?>
