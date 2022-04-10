<div>
    <div>
        <form method = "POST" enctype = "multipart/form-data">
            <tr>
                <label>Transaction Number</label>
                <td><input type = "text" name = "transaction_number" required/></td>
            </tr><br>
            <tr>
                <label>First Name</label>
                <td><input type = "text" name = "first_name" required/></td>
            </tr><br>
            <tr>
                <label>Last Name</label>
                <td><input type = "text" name = "last_name" required/></td>
            </tr><br>
            <tr>
                <label>Suffix</label>
                <td>
                    <select name = "suffix" required>
                        <option name = "jr">jr</option>
                        <option name = "sr">sr</option>
                        <option name = "n/a">N/A</option>
                    </select>
                </td>
                <label style = "color:red">*SELECT N/A IF YOU DON'T HAVE ANY SUFFIX</label>
            </tr><br>
            <tr>
                <label>Contact Number</label>
                <td><input type = "text" name = "contact_number" required/></td>
            </tr><br>
            <tr>
                <label>Email Address</label>
                <td><input type = "text" name = "email_address" required/></td>
            </tr><br>
            <tr>
                <label>Amount</label>
                <td><input type = "text" name = "amount" required/></td>
            </tr><br>
            <tr>
                <label>Photo</label>
                <td><input type = "file" name = "proof_photo" required/></td>
            </tr><br>
            <button name = "donate">Donate</button>
        </form>
    </div>
</div>

<?php
    include("inc/db.php");
    if(isset($_POST['donate']))
    {
        $transaction_number = $_POST['transaction_number'];
        $org_id = $_GET['donate'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $suffix = $_POST['suffix'];
        $contact_number = $_POST['contact_number'];
        $email_address = $_POST['email_address'];
        $amount = $_POST['amount'];
        $donation_status = "FOR CONFIRMATION";

        $proof_photo = $_FILES['proof_photo']['name'];
        $proof_photo_tmp = $_FILES['proof_photo']['tmp_name'];

        move_uploaded_file($proof_photo_tmp,"../uploads/donations/$proof_photo");

        $add_donation = $con->prepare("INSERT INTO donations
        (
            transaction_number,
            org_id,
            first_name,
            last_name,
            contact_number,
            suffix,
            email_address,
            proof_photo,
            donation_status,
            coupon_code,
            amount
        ) 
        VALUES
        (
            '$transaction_number',
            '$org_id',
            '$first_name',
            '$last_name',
            '$contact_number',
            '$suffix',
            '$email_address',
            '$proof_photo',
            '$donation_status',
            'N/A',
            '$amount'
        )
         ");

        if($add_donation->execute())
        {
            echo "<script>alert('Thanks for donating, check your email for exciting surprises!');</script>";
            echo "<script>window.open('donation.php' ,'_self');</script>";
        }
    }
?>
