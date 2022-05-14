<html>
    <head>
        <title>Pet Society</title>
        <link rel = "stylesheet" href="css/style.css" />
        <link rel = "stylesheet" href="css/addPet.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Fredoka+One&family=Open+Sans:wght@500&family=Palette+Mosaic&family=Rubik:wght@500&family=Varela+Round&display=swap" rel="stylesheet">
    </head>

    <body>
       
        <?php 
            include ("inc/db.php");
            include ("inc/function.php");
            include ("inc/header.php"); 
            include ("inc/navbar.php"); 
            ?>

<div class = 'main'>
    <div class="left">
    <div class = cont>
            <p class = "lebs">Pet Photo:</p>
            <div class='drop-zone'>
            <span class='drop-zone__prompt'>Drop file here or click to upload</span>
            <input type='file' name='proof_photo' class='drop-zone__input'>
            </div>
        </div>
    </div>
    <div class="right">
    <form method = "POST" enctype = "multipart/form-data">
        <div class="fills">
          <br>
            <p class="heads">Pet Information</p>
        
        <div class = 'cont'>
            <p class = 'lebs'>Pet Name:</p>
            <input class =  'ints' type = "text" name = "pet_name" placeholder = "Name" />
        </div>
        <div class = "cont">
            <p class = "lebs">Pet Age:</p>
            <input class = 'ints' type = "text" name = "pet_age" placeholder = "Age" />
        </div>
        <div class="conts">
            <input type="radio" id="Dog" name="cat" value="Dog">
             <label class = 'ok' for="Dog">Dog</label>
             <input type="radio" id="Cat" name="cat" value="Cat">
             <label class = 'ok' for="Cat">Cat</label>
            <input type="radio" id="Bird" name="cat" value="Bird">
            <label class = 'ok' for="Bird">Bird</label>
            <input type="radio" id="Fish" name="cat" value="Fish">
            <label class = 'ok' for="Fish">Fish</label>
            <input type="radio" id="Others" name="cat" value="Others">
            <label class = 'ok' for="Others">Others</label>
           </div>
        <div class = cont>
            <p class = "lebs">Pet Breed:</p>
            <input class =  'ints' type = "text" name = "pet_breed" placeholder = "Breed" />
        </div>
        <div class = cont>
            <p class = "lebs">Pet Gender:</p>
            <input class =  'ints' type = "text" name = "pet_gender" placeholder = "Gender" />
        </div>
        <div class = cont>
            <p class = "lebs">Vaccination Status</p>
            <input class =  'ints' type = "text" name = "pet_gender" placeholder = "Vaccination" />
        </div>
        <div class = cont>
            <p class = "lebs">Pet Details:</p>
            <input class =  'ints' type = "text" name = "pet_details" placeholder = "Small Details of your pet" />
        </div>
       
        <div class="cont">
        <button name = 'add_pet' class = "btn">Save</button>
        </div>
           
        </div>
        
    </form>
    </div>
   

</div>

<?php
    include("inc/db.php");

    if(!isset($_SESSION['user_id']))
    {
        echo "<script>window.open('login.php', '_self');</script>";
    }
    else
    {
        if(isset($_POST['add_pet']))
        {
            $users_id = $_SESSION['user_id'];
            $user = $con->prepare("SELECT * FROM users_table WHERE user_id = '$users_id'");
            $user->setFetchMode(PDO:: FETCH_ASSOC);
            $user->execute();
        
            $row = $user->fetch();
            $user_id = $row['user_id'];
    
            $pet_name = $_POST['pet_name'];
            $pet_age = $_POST['pet_age'];
            $pet_breed = $_POST['pet_breed'];
            $pet_gender = $_POST['pet_gender'];
            $pet_details = $_POST['pet_details'];

            $currentDate = new DateTime();
            $today = $currentDate->format('Y-m-d H:i:s');
            
            $pet_photo = $_FILES['pet_photo']['name'];
            $pet_photo_tmp = $_FILES['pet_photo']['tmp_name'];
    
            move_uploaded_file($pet_photo_tmp,"../uploads/pets/$pet_photo");
    
            $add_pet = $con->prepare("INSERT INTO pets(
                        user_id,
                        pet_name,
                        pet_age,
                        pet_breed,
                        pet_gender,
                        pet_details,
                        pet_photo,
                        likes,
                        date_time_posted
            )
            VALUES (
                '$user_id',
                '$pet_name',
                '$pet_age',
                '$pet_breed',
                '$pet_gender',
                '$pet_details',
                '$pet_photo',
                '0',
                '$today'

            )");
            if($add_pet->execute())
            {
                echo "<script>alert('Pet Successfully Added');</script>";
                echo "<script>window.open('viewall_pets.php', '_self');</script>";
            }
        }
    }
?>
<div class="fot">
  <?php
     include ("inc/footer.php");
  ?>
</div>
</body>
<script>
                        function myFuction(){
            varOne = document.getElementById('municipal').value;
                if(varOne == 'Mandaue City'){
                    document.getElementById('mandaue').setAttribute('name', 'barangays');
                    document.getElementById('Cebu').setAttribute('name', 'barangay');
                    document.getElementById('Lapulapu').setAttribute('name', 'barangay');
                    document.getElementById('Consolacion').setAttribute('name', 'barangay');
                    document.getElementById('mandaue').style.display = "block";
                    document.getElementById('Cebu').style.display = 'none';
                    document.getElementById('Lapulapu').style.display = "none";
                    document.getElementById('Consolacion').style.display = "none";
                    console.log(varOne);
                }
                if(varOne == ''){
                    
                    document.getElementById('mandaue').style.display = "none";
                    document.getElementById('Cebu').style.display = 'none';
                    document.getElementById('Lapulapu').style.display = "none";
                    document.getElementById('Consolacion').style.display = "none";
                    //console.log(varOne);
                }
                if(varOne == 'Cebu City'){
                    document.getElementById('mandaue').setAttribute('name', 'barangay');
                    document.getElementById('Cebu').setAttribute('name', 'barangays');
                    document.getElementById('Lapulapu').setAttribute('name', 'barangay');
                    document.getElementById('Consolacion').setAttribute('name', 'barangay');
                    document.getElementById('Cebu').style.display = 'block';
                    document.getElementById('mandaue').style.display = "none";
                    document.getElementById('Lapulapu').style.display = "none";
                    document.getElementById('Consolacion').style.display = "none";
                    console.log(varOne);
                }
                if(varOne == 'Consolacion'){
                    document.getElementById('mandaue').setAttribute('name', 'barangay');
                    document.getElementById('Cebu').setAttribute('name', 'barangay');
                    document.getElementById('Lapulapu').setAttribute('name', 'barangay');
                    document.getElementById('Consolacion').setAttribute('name', 'barangays');
                    document.getElementById('Cebu').style.display = 'none';
                    document.getElementById('mandaue').style.display = "none";
                    document.getElementById('Lapulapu').style.display = "none";
                    document.getElementById('Consolacion').style.display = "block";
                   console.log(varOne);
                }
                if(varOne == 'Lapu-Lapu City'){
                    document.getElementById('mandaue').setAttribute('name', 'barangay');
                    document.getElementById('Cebu').setAttribute('name', 'barangay');
                    document.getElementById('Lapulapu').setAttribute('name', 'barangays');
                    document.getElementById('Consolacion').setAttribute('name', 'barangay');
                    document.getElementById('Cebu').style.display = 'none';
                    document.getElementById('mandaue').style.display = "none";
                    document.getElementById('Lapulapu').style.display = "block";
                    document.getElementById('Consolacion').style.display = "none";
                    console.log(varOne);
                }
                
                
   
            

        }


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


