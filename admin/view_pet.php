<?php

    include("inc/db.php");
    if(isset($_GET['view']))
    {
        $user_id = $_GET['view'];

        $sql = $con->prepare("SELECT * FROM pets WHERE user_id = '$user_id'");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        $row = $sql->fetch();

        echo
        "Pet Name: ".$row['pet_name']."
        Pet: ".$row['pet']."
        Vaccination Status: ".$row['vaccination_status']."
        Pet Age: ".$row['pet_age']."
        Pet Breed: ".$row['pet_breed']."
        Pet Gender: ".$row['pet_gender']."
        Pet Details: ".$row['pet_details']."
        Pet Photo: <img class = 'imaged' src = '../uploads/pets/".$row['pet_photo']."' />
        ";
    }
?>