<?php
    include("inc/db.php");

    if(isset($_GET['view_pet']))
    {
        $user_id = $_GET['view_pet'];

        $sql = $con->prepare("SELECT * FROM pets WHERE user_id = '$user_id'");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();

        $row = $sql->fetch();

        echo
        "Pet: ".$row['pet']."<br>
        Pet Name: ".$row['pet_name']."<br>
        Pet Age: ".$row['pet_age']."<br>
        Pet Breed: ".$row['pet_breed']."<br>
        Pet Gender: ".$row['pet_gender']."<br>
        Pet Details: ".$row['pet_details']."<br>
        Vaccination Status: ".$row['vaccination_status']."<br>
        Pet Photo: ".$row['pet_photo']."<br>";

    }

    echo "<a href = 'confirmRequests.php'>Go Back</a>";
?>