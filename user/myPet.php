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

<?php
    $current_user = $_SESSION['user_id'];
    $sql = $con->prepare("SELECT * FROM pets WHERE user_id = '$current_user'");
    $sql->setFetchMode(PDO:: FETCH_ASSOC);
    $sql->execute();

    $row = $sql->fetch();

    echo
    "<form method = 'POST' enctype = 'multipart/form-data'>
        <p>Pet Name</p><input type = 'text' name = 'pet_name' value = '".$row['pet_name']."' />
        <p>Pet Age</p><input type = 'text' name = 'pet_age' value = '".$row['pet_age']."' />
        <p>Pet</p><input type = 'text' name = 'pet' value = '".$row['pet']."' />
        <p>Pet Breed</p><input type = 'text' name = 'pet_breed' value = '".$row['pet_breed']."' />
        <p>Pet Gender</p><input type = 'text' name = 'pet_gender' value = '".$row['pet_gender']."' />
        <p>Vaccination Status</p><input type = 'text' name = 'vaccination_status' value = '".$row['vaccination_status']."' />
        <p>Pet Details</p><input type = 'text' name = 'pet_details' value = '".$row['pet_details']."' />
        <button name = 'update' value = ".$row['id'].">Update</button>
    </form>";

    echo
    "<form method = 'POST' enctype = 'multipart/form-data'>
      <img src = '../uploads/pets/".$row['pet_photo']."' />
      <input type = 'file' name = 'pet_photo' required/>
      <button name = 'update_img' value = ".$row['id'].">Update Image</button>
    </form>";

    if(isset($_POST['update']))
    {
        $id = $_POST['update'];
        $pet_name = $_POST['pet_name'];
        $pet_age = $_POST['pet_age'];
        $pet = $_POST['pet'];
        $pet_breed = $_POST['pet_breed'];
        $pet_gender = $_POST['pet_gender'];
        $vaccination_status = $_POST['vaccination_status'];
        $pet_details = $_POST['pet_details'];

        $update_pet = $con->prepare("UPDATE pets 
                      SET
                      pet = '$pet',
                      vaccination_status = '$vaccination_status',
                      pet_name = '$pet_name',
                      pet_age = '$pet_age',
                      pet_breed = '$pet_breed',
                      pet_gender = '$pet_gender',
                      pet_details = '$pet_details'
                      WHERE
                      id = $id
                      ");
        if($update_pet->execute())
        {
          echo "<script>alert('Updated!');</script>";
          echo "<script>window.open('myPet.php','_self');</script>";
        }
    }

    if(isset($_POST['update_img']))
    {
        $id = $_POST['update_img'];
        $pet_photo = $_FILES['pet_photo']['name'];
        $pet_photo_tmp = $_FILES['pet_photo']['tmp_name'];

        move_uploaded_file($pet_photo_tmp,"../uploads/pets/$pet_photo");

        $update_img = $con->prepare("UPDATE pets SET pet_photo = '$pet_photo' WHERE id = $id");

        if($update_img->execute())
        {
          echo "<script>alert('Updated!');</script>";
          echo "<script>window.open('myPet.php','_self');</script>";
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


