<?php
    include("inc/db.php");

    if(isset($_GET['edit']))
    {
        $pet_id = $_GET['edit'];

        $view_pet = $con->prepare("SELECT * FROM pets WHERE id = '$pet_id'");
        $view_pet->setFetchMode(PDO:: FETCH_ASSOC);
        $view_pet->execute();

        $row = $view_pet->fetch();

        echo
        "<form method = 'POST' enctype = 'multipart/form-data'>
            Pet Name: <input type = 'text' name = 'pet_name' value = '".$row['pet_name']."'/><br>
            Pet Age: <input type = 'text' name = 'pet_age' value = '".$row['pet_age']."' /><br>
            Pet Breed: <input type = 'text' name = 'pet_breed' value = '".$row['pet_breed']."' /><br>
            Pet Gender: <input type = 'text' name = 'pet_gender' value = '".$row['pet_gender']."' /><br>
            Pet Details: <input type = 'text' name = 'pet_details' value = '".$row['pet_details']."' /><br>
            <button name = 'update'>Update</button>
        </form>";

        echo
        "<form method = 'POST' enctype = 'multipart/form-data'>
            Pet Photo: <img src ='../uploads/pets/".$row['pet_photo']."' class = 'imagePost'/>
            <input type = 'file' name = 'pet_photo' required/>
            <button name = 'update_img'>Update Image</button>
        </form>";

        echo 
        "<a href = 'myPet.php'>Go Back</a>";

        if(isset($_POST['update']))
        {   
            $pet_name = $_POST['pet_name'];
            $pet_age = $_POST['pet_age'];
            $pet_breed = $_POST['pet_breed'];
            $pet_gender = $_POST['pet_gender'];
            $pet_details = $_POST['pet_details'];

            $update = $con->prepare("UPDATE pets 
            SET 
            pet_name = '$pet_name',
            pet_age = '$pet_age',
            pet_breed = '$pet_breed',
            pet_gender = '$pet_gender',
            pet_details = '$pet_details'
            WHERE
            id = '$pet_id'");

            if($update->execute())
            {   
                echo "<script>alert('Updated!');</script>";
                echo "<script>window.open('myPet.php', '_self');</script>";
            }
        }

        if(isset($_POST['update_img']))
        {
            $pet_photo = $_FILES['pet_photo']['name'];
            $pet_photo_tmp = $_FILES['pet_photo']['tmp_name'];

            move_uploaded_file($pet_photo_tmp,"../uploads/pets/$pet_photo");

            $update_img = $con->prepare("UPDATE pets 
            SET 
            pet_photo = '$pet_photo'
            WHERE
            id = '$pet_id'");

            if($update_img->execute())
            {   
                echo "<script>alert('Updated!');</script>";
                echo "<script>window.open('myPet.php', '_self');</script>";
            }


        }

        
    }
?>