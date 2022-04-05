<?php
    session_start();
    include("inc/db.php");

    if(!isset($_SESSION['user_username']))
    {
        echo "<script>window.open('login.php', '_self');</script>";
    }
    else
    {
        if(isset($_POST['submit']))
        {
            $user_username = $_SESSION['user_username'];
            $user = $con->prepare("SELECT * FROM users_table WHERE user_username = '$user_username'");
            $user->setFetchMode(PDO:: FETCH_ASSOC);
            $user->execute();
            $row = $user->fetch();

            $user_id = $row['user_id'];
            $pet_id = $_POST['submit'];
            $comment = $_POST['comment'];

            $add_val = $con->prepare("INSERT INTO comment_tbl(user_id, pet_id, comment) VALUES($user_id, $pet_id, '$comment')
            ");

            if($add_val->execute())
            {
                echo "<script>window.open('viewall_pets.php', '_self');</script>";
            }
        }

        if(isset($_POST['like']))
        {
            $user_username = $_SESSION['user_username'];
            $user = $con->prepare("SELECT * FROM users_table WHERE user_username = '$user_username'");
            $user->setFetchMode(PDO:: FETCH_ASSOC);
            $user->execute();
            
            $row = $user->fetch();
            $user_id = $row['user_id'];
            $pet_id = $_POST['like'];

            $sql = $con->prepare("SELECT * FROM pets WHERE id = $pet_id");
            $sql->setFetchMode(PDO:: FETCH_ASSOC);
            $sql->execute();

            while($row = $sql->fetch()):
                $like = $row['likes'];

                $sql3 = $con->prepare("UPDATE pets SET likes=$like+1 WHERE id = $pet_id");
                $sql3->setFetchMode(PDO:: FETCH_ASSOC);
                $sql3->execute();

                if($sql3->execute())
                {
                    $sql2 = $con->prepare("INSERT INTO posts_like SET
                              pet_id = $pet_id,
                              user_id = $user_id
                      ");
                    if($sql2->execute())
                    {
                        echo "<script>window.open('viewall_pets.php', '_self');</script>";
                    }
                }
            endwhile;
        }
    }
?>