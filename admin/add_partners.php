<div>
    <div>
        <h2>Add Org</h2>
        <form method = "POST" enctype = "multipart/form-data"> 
            <tr>
                <label>Organization Name</label>
                <td><input type = "text" name = "org_name" /></td>
            </tr><br>
            <tr>
                <label>Organization Location</label>
                <td><input type = "text" name = "org_location" /></td>
            </tr><br>
            <tr>
                <label>Contact Number</label>
                <td><input type = "text" name = "org_contact_number" /></td>
            </tr><br>
            <tr>
                <label>Email Address</label>
                <td><input type = "text" name = "org_email_address" /></td>
            </tr><br>
            <tr>
                <label>Photo</label>
                <td><input type = "file" name = "org_photo" /></td>
            </tr><br>
            <tr>
                <td><button name = "add_org">Add Organization</button></td>
            </tr>
        </form>
    </div>
</div>

<?php
    include("inc/function.php");
    echo add_partners();
?>