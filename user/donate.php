<html>
<head>
        <title>Pet Society</title>
        <link rel = "stylesheet" href="css/style.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Fredoka+One&family=Open+Sans:wght@500&family=Palette+Mosaic&family=Rubik:wght@500&family=Varela+Round&display=swap" rel="stylesheet">
    </head>
    <body>
    <?php 
            include ("inc/function.php");
            include ("inc/header.php"); 
            include ("inc/navbar.php");  
          
            
        ?>
    <div>
    <div class='mainConers'>
        <form method = "POST" enctype = "multipart/form-data" >
        <div class = 'donateDiv'>
   
                <p>Transaction Number</p>
                <input type = "text" name = "transaction_number" required/>
           
  
                <p>First Name</p>
                <input type = "text" name = "first_name" required/>

                <p>Last Name</p>
                <input type = "text" name = "last_name" required/>
                <p>Suffix</p>
                <div class = 'deviants'>
                    <select name = "suffix" required>
                        <option name = "jr">jr</option>
                        <option name = "sr">sr</option>
                        <option name = "n/a">N/A</option>
                    </select>
                    <p class = 'sels'>*SELECT N/A IF YOU DON'T HAVE ANY SUFFIX</p>
                </div>
                <p>Contact Number</p>
                <input type = "text" name = "contact_number" required/>

                <p>Email Address</p>
                <input type = "text" name = "email_address" required/>
                <p>Amount</p>
                <input type = "text" name = "amount" required/>
                <p>Photo</p>
                <input type = "file" name = "proof_photo" required/>
                <div></div>
            <button name = "donate" class='dons'>Donate</button>
            </div>
        </form>
    
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
<?php 
            include ("inc/footer.php");
          
            
        ?>
    </body>
    <style>
        
        .donateDiv{
            display: grid;
            grid-template-columns: 15% 35%;
            row-gap: 5px;
            background: white;
        }
        .sels{
            color: gray;
            font-size: 10px;
        }
        .deviants{
            display: flex;
        }
        .dons{
            height: 52px;
        }
        .mainConers{
            padding: 10px;
        }
        .mainConers{
            height: 75vh;
        }
    </style>
</html>


