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
   <input class = 'ints' type = "text" name = "full_name" required/>
  </div>
  <div class="contData">
  <p class = 'lebel' >Email</p>
   <input class = 'ints' type = "text" name = "email" required/>
  </div>
  <div class="contData">
  <p class = 'lebel' >Amount</p>
   <input class = 'ints' type = "text" name = "amount" required/>
  </div>
  <div class="drop-zone">
    <span class="drop-zone__prompt">Drop file here or click to upload</span>
    <input type="file" name="proof_photo" class="drop-zone__input">
  </div>
  <br><br>
   <div></div> <div></div>
<button name = "donate" class='dons'>Submit</button>
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
        $amount = $_POST['amount'];
        $email = $_POST['email'];
        $donation_status = "FOR CONFIRMATION";

        $proof_photo = $_FILES['proof_photo']['name'];
        $proof_photo_tmp = $_FILES['proof_photo']['tmp_name'];

        move_uploaded_file($proof_photo_tmp,"../uploads/donations/$proof_photo");

        $add_donation = $con->prepare("INSERT INTO donations
        (
            transaction_number,
            org_id,
            full_name,
            email,
            contact_number,
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
            '$email',
            '$contact_number',
            '$proof_photo',
            '$donation_status',
            'N/A',
            '$amount'
        )
         ");

        if($add_donation->execute())
        {
            echo "<script>alert('Please wait for the us to confirm your donation!');</script>";
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
            grid-template-columns: 50% 50%;
            row-gap: 5px;
            column-gap: 10px;
            margin-top: 10px;
            padding-top: 50px;
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
                  width: 80%;
                  padding: 15px;
                  border-radius: 5px;
                  margin-left: 5%;
                  margin-top: 10%;
                  color: white;
                  font-weight: bold;
                  
                  
        }
       
        .mainConers{
            
            height: 70vh;
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
            width: 80%;
            margin-left: 5%;
            margin-bottom: 10px;
        }
       


        .drop-zone {
            width: 80%;;
  height: 50px;
  padding: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  font-family: "Quicksand", sans-serif;
  font-weight: 500;
  font-size: 14px;
  cursor: pointer;
  color: #777;
  border: 2px dashed #009578;
  border-radius: 10px;
  margin-left: 5%;
            margin-bottom: 10px;
}

.drop-zone--over {
  border-style: solid;
}

.drop-zone__input {
  display: none;
}

.drop-zone__thumb {
  width: 100%;
  height: 100%;
  border-radius: 10px;
  overflow: hidden;
  background-color: #cccccc;
  background-size: cover;
  position: relative;
}

.drop-zone__thumb::after {
  content: attr(data-label);
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 5px 0;
  color: #ffffff;
  background: rgba(0, 0, 0, 0.75);
  font-size: 14px;
  text-align: center;
}



    </style>
    <script>
        document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
  const dropZoneElement = inputElement.closest(".drop-zone");

  dropZoneElement.addEventListener("click", (e) => {
    inputElement.click();
  });

  inputElement.addEventListener("change", (e) => {
    if (inputElement.files.length) {
      updateThumbnail(dropZoneElement, inputElement.files[0]);
    }
  });

  dropZoneElement.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZoneElement.classList.add("drop-zone--over");
  });

  ["dragleave", "dragend"].forEach((type) => {
    dropZoneElement.addEventListener(type, (e) => {
      dropZoneElement.classList.remove("drop-zone--over");
    });
  });

  dropZoneElement.addEventListener("drop", (e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
      inputElement.files = e.dataTransfer.files;
      updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
    }

    dropZoneElement.classList.remove("drop-zone--over");
  });
});

/**
 * Updates the thumbnail on a drop zone element.
 *
 * @param {HTMLElement} dropZoneElement
 * @param {File} file
 */
function updateThumbnail(dropZoneElement, file) {
  let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

  // First time - remove the prompt
  if (dropZoneElement.querySelector(".drop-zone__prompt")) {
    dropZoneElement.querySelector(".drop-zone__prompt").remove();
  }

  // First time - there is no thumbnail element, so lets create it
  if (!thumbnailElement) {
    thumbnailElement = document.createElement("div");
    thumbnailElement.classList.add("drop-zone__thumb");
    dropZoneElement.appendChild(thumbnailElement);
  }

  thumbnailElement.dataset.label = file.name;

  // Show thumbnail for image files
  if (file.type.startsWith("image/")) {
    const reader = new FileReader();

    reader.readAsDataURL(file);
    reader.onload = () => {
      thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
    };
  } else {
    thumbnailElement.style.backgroundImage = null;
  }
}

    </script>
</html>


