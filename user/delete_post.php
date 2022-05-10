<?php
    include("inc/db.php");

    if(isset($_GET['delete']))
    {
        $pet_id = $_GET['delete'];
        $del_post = $con->prepare("DELETE FROM pets WHERE id = '$pet_id'");
        $del_post->setFetchMode(PDO:: FETCH_ASSOC);
        $del_post->execute();

        if($del_post->execute())
        {
            echo "<script>alert('Post Deleted');</script>";
            echo "<script>window.open('myPet.php', '_self');</script>";
        }
    }
?>