<?php
    include("inc/db.php");

    if(isset($_POST['edit_org']))
    {
        $id = $_POST['edit_org'];
        $edit_details = $con->prepare("SELECT * FROM organizations WHERE id = '$id'");
        $edit_details->setFetchMode(PDO:: FETCH_ASSOC);
        $edit_details->execute();

        $row = $edit_details->fetch();

        echo
        "<form method = 'POST'>
            <tr>
                <td><input type = 'text' name = 'org_name' value = '".$row['org_name']."' /></td>
            </tr><br>
            <tr>
                <td><input type = 'text' name = 'org_location' value = '".$row['org_location']."' /></td>
            </tr><br>
            <tr>
                <td><input type = 'text' name = 'org_contact_number' value = '".$row['org_contact_number']."' /></td>
            </tr><br>
            <tr>
                <td><input type = 'text' name = 'org_email_address' value = '".$row['org_email_address']."' /></td>
            </tr><br>
            <tr>
                <td><input type = 'file' name = 'org_photo' value = '".$row['org_photo']."'/></td>
            </tr><br>
            <button name = 'update'>Update</button>
        </form>";
    
        
        if(isset($_POST['update']))
        {
            $org_id = $_POST['update'];
            $org_name = $_POST['org_name'];
            $org_location = $_POST['org_location'];
            $org_contact_number = $_POST['org_contact_number'];
            $org_email_address = $_POST['org_email_address'];
            $org_photo = $_POST['org_photo'];

            $update_org = $con->prepare("UPDATE organizations 
            SET 
            org_name='$org_name',
            org_location='$org_location',
            org_contact_number='$org_contact_number',
            org_email_adddress='$org_email_adddress',
            org_photo='$org_photo'
            WHERE 
            id = '$id'");
    
            if($update_org->execute())
            {
                echo "<script>alert('Updated Successfully!');</script>";
                echo "<script>window.open('index.php?manage_partner', '_self');</script>";
            }
            else
            {
                die('asdsadasdsa');
            }
        }
    }

    if(isset($_POST['delete_org']))
    {
        $id = $_POST['delete_org'];
        $delete_org =$con->prepare("DELETE FROM organizations WHERE id = '$id'");
        $delete_org->setFetchMode(PDO:: FETCH_ASSOC);
        $delete_org->execute();

        if($delete_org->execute())
        {
            echo "<script>alert('Deleted Successfully!');</script>";
            echo "<script>window.open('index.php?manage_partner', '_self');</script>";
        }
    }
?>