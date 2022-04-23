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

    <div class = 'forBkg'>
   
        <br>
    <div class='mainConers'>
        <div class = 'leftS'>
            <div class="sulod">
            <img src="../uploads/gcash.png" id = 'imageGcash' >
            <br><br>
            <p class = 'heading' >Inform Us with your Gcash Transaction with the Organization so that we can provide you the Coupon code :></p>
            
            </div>
      
        </div>
    <div class="second">
        <form method = "POST" enctype = "multipart/form-data" >
        
        <div class = 'donateDiv'>
            
   <div class="contData">
   <p class = 'lebel' >GCash Ref. Number</p>
   <input class = 'ints' type = "number" name = "transaction_number" required/>
   </div>
   <div class="contData">
 <p class = 'lebel' >GCash Number</p>
   <input class = 'ints' type = "text" name = "contact_number" required/>
 </div>
  <div class="contData">
  <p class = 'lebel' >Name</p>
   <input class = 'ints' type = "text" name = "first_name" required/>
  </div>
   <div class="contData">
   <p class = 'lebel' >Email Address</p>
   <input class = 'ints' type = "text" name = "email_address" required/>
   </div>
  <div class="contData">
  <p class = 'lebel' >Amount</p>
   <input class = 'ints' type = "text" name = "amount" required/>
  </div>
   
   
   
   <p class = 'lebel' >Photo</p>
   <input class = 'ints' type = "file" name = "proof_photo" required/>
   <div></div>
<button name = "donate" class='dons'>Apply For Coupon</button>
</div>
        </form>
        </div>
</div>

<?php
    include("inc/db.php");
    if(isset($_POST['donate']))
    {
        $transaction_number = $_POST['transaction_number'];
        $org_id = $_GET['donate'];
        $full_name = $_POST['full_name'];
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
            full_name,
            contact_number,
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
            '$full_name',
            '$contact_number',
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
           
            row-gap: 5px;
            column-gap: 10px;
            
           
            margin-top: 10px;
            padding: 20px;
            border-radius: 10px;
         
        }
        .heading{
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            text-align: right;
            margin-top: 10%;
        }
        .sulod{
            padding: 20px;
        }
        .sels{
            color: gray;
            font-size: 10px;
        }
        .deviants{
            display: flex;
        }
        .dons{
                  background: #ffb830;
                  outline: none;
                  border: 1px solid #ffb830;
                  width: 200px;
                  padding: 10px;
                  border-radius: 10px;
                  margin-right: 10px;
                  color: white;
                  font-weight: bold;
        }
       
        .mainConers{
            
            height: 90vh;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
            width: 80%;
            margin-left: 10%;
            display: flex;
            border-radius: 7px;
            margin-bottom: 10vh;
            
        }
        .forBkg{
            background-image: url(../uploads/backgrnd.jpg);

            background-size: cover;
        
        }
        .second{
          
            padding: 20px;
            width: 60%;
            background: rgba(200, 200, 200, 0.7);
            
        }
        .lebel{
            color: #888;
            font-size: 10px;
        }
        .ints{
            height: 42px;
            padding: 5px;
            border: none;
            outline: none;
            width: 100%;
         
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
         -webkit-appearance: none;
         margin: 0;
        }

        .leftS{
            width: 40%;
            background: rgba(0, 0, 0, 0.3);
        }
        .contData{
            background: white;
            border-radius: 5px;
            padding: 10px;
            width: 70%;
            margin-left: 15%;
            margin-bottom: 10px;
        }
       
    </style>
</html>


