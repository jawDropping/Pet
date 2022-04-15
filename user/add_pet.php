<div>
    <form method = "POST" enctype = "multipart/form-data">
        <tr>
            <td><label>Pet Name:</label></td>
            <td><input type = "text" name = "pet_name" placeholder = "Name" /></td>
        </tr><br>
        <tr>
            <td><label>Pet Age:</label></td>
            <td><input type = "text" name = "pet_age" placeholder = "Age" /></td>
        </tr><br>
        <tr>
            <td><label>Pet Breed:</label></td>
            <td><input type = "text" name = "pet_breed" placeholder = "Breed" /></td>
        </tr><br>
        <tr>
            <td><label>Pet Gender:</label></td>
            <td><input type = "text" name = "pet_gender" placeholder = "Gender" /></td>
        </tr><br>
        <tr>
            <td><label>Pet Details:</label></td>
            <td><input type = "text" name = "pet_details" placeholder = "Small Details of your pet" /></td>
        </tr><br>
        <tr>
            <td><label>Pet Photo:</label></td>
            <td><input type = "file" name = "pet_photo" /></td>
        </tr><br>
        <button name = 'add_pet'>Add Pet</button>
    </form>
</div>

<?php
    session_start();
    include("inc/db.php");

    if(!isset($_SESSION['user_username']))
    {
        echo "<script>window.open('login.php', '_self');</script>";
    }
    else
    {
        if(isset($_POST['add_pet']))
        {
            $user_username = $_SESSION['user_username'];
            $user = $con->prepare("SELECT * FROM users_table WHERE user_username = '$user_username'");
            $user->setFetchMode(PDO:: FETCH_ASSOC);
            $user->execute();
        
            $row = $user->fetch();
            $user_id = $row['user_id'];
    
            $pet_name = $_POST['pet_name'];
            $pet_age = $_POST['pet_age'];
            $pet_breed = $_POST['pet_breed'];
            $pet_gender = $_POST['pet_gender'];
            $pet_details = $_POST['pet_details'];
            
            $pet_photo = $_FILES['pet_photo']['name'];
            $pet_photo_tmp = $_FILES['pet_photo_tmp']['tmp_name'];
    
            move_uploaded_file($pet_photo_tmp,"../uploads/pets/$pet_photo");
    
            $add_pet = $con->prepare("INSERT INTO pets(
                        user_id,
                        pet_name,
                        pet_age,
                        pet_breed,
                        pet_gender,
                        pet_details,
                        pet_photo,
                        likes
            )
            VALUES (
                '$user_id',
                '$pet_name',
                '$pet_age',
                '$pet_breed',
                '$pet_gender',
                '$pet_details',
                '$pet_photo',
                '0'

            )");
            if($add_pet->execute())
            {
                echo "Pet Successfully Added";
            }
        }
    }
?>



