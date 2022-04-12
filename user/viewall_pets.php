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
            include ("inc/db.php");
            include ("inc/function.php");
            include ("inc/header.php"); 
            include ("inc/navbar.php"); 
        ?>
        <div id='pinakaMain'>
        <?php
            //////////////
            
            include("inc/db.php");

            echo "
            <div class = 'container'>
            <div class = 'firstCont'>
            <a href = 'add_pet.php'>Share Moments with your Pet :)</a><br></div>";
        
            $viewall_pets = $con->prepare("SELECT * FROM pets");
            $viewall_pets->setFetchMode(PDO:: FETCH_ASSOC);
            $viewall_pets->execute();
    
    
            while($row = $viewall_pets->fetch()):
            $pet_id = $row['id'];
            $user_id = $row['user_id'];
            $likes = $row['likes'];
    
            $user = $con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
                    $user->setFetchMode(PDO:: FETCH_ASSOC);
                    $user->execute();
            
            $row_user = $user->fetch();
            $user_username = $row_user['user_username'];
            $profile = $row_user['user_profilephoto'];
            $comment = $con->prepare("SELECT * FROM comment_tbl WHERE pet_id = '$pet_id'");
            $comment->setFetchMode(PDO:: FETCH_ASSOC);
            $comment->execute();
    
            $count_comments = $comment->rowCount();
///////////
            
///////////////
                echo
                "
                
                    <div class = 'innerCont'>
                    <div class = 'forPadding'>
                    <form method = 'post' action = 'submit_entries.php' enctype='multipart/form-data'>
                    <div id = 'userHead'>
                    <img class='profileImg2' src = '../uploads/user_profile/".$row_user['user_profilephoto']."'>
                    <p class = 'postName'>".$user_username."</p>
                    </div>
                        <img src ='../uploads/pets/".$row['pet_photo']."' class = 'imagePost'/>
                       
                        
                            <button id = 'likeBtn' name = 'like' value = ".$row['id'].">
                            <img src ='../uploads/like.png' class = 'likeBtnImg'>
                            </button>
                            <p>".$likes." likes</p>
                            <p>".$user_username.":".$row['pet_details']."</p>
                            ";
                            echo "
                       
                        <div style = 'margin-left: 14.5rem; margin-top: -.5rem'>
                            ".$count_comments." Comment/s
                        </div>
                        <div>
                            Comment: <input type = 'text' name = 'comment' placeholder = 'Write A Comment' />
                            <button name = 'submit' value = ".$row['id'].">Submit</button>
                        </div>";
////////////////                    
                    while($row_comment = $comment->fetch()):
                    $users_id = $row_comment['user_id'];
                    $likes = $row_comment['likes'];
    
                    $user = $con->prepare("SELECT * FROM users_table WHERE user_id = '$users_id'");
                    $user->setFetchMode(PDO:: FETCH_ASSOC);
                    $user->execute();

                    $row_users = $user->fetch();
//////////////
                        
                        echo "<img class='profileImg' src = '../uploads/user_profile/".$row_users['user_profilephoto']."'>:".$row_comment['comment']."";
                        
                        if(isset($_SESSION['user_username']))
                        {
                            //check kinsay naka login
                            $current_user = $_SESSION['user_username'];
                            $check_user = $con->prepare("SELECT * FROM users_table WHERE user_username = '$current_user'");
                            $check_user->setFetchMode(PDO:: FETCH_ASSOC);
                            $check_user->execute();
    
                            $row_check_user = $check_user->fetch();
                            $current_user_id = $row_check_user['user_id'];
    
                            //compare ang id sa user og ang nag comment
                            //if ang current user naka login
                            //maka like edit og comment siya
                            if($current_user_id == $users_id)
                            {
                                echo "<button name = 'like_comment' value = ".$row_comment['id'].">Like(".$likes.")</button>";
                                echo "<button name = 'edit_comment' value = ".$row_comment['id'].">Edit</button>";
                                echo "<button name = 'delete_comment' value = ".$row_comment['id'].">Delete</button>";
                            }
                            //if dili gani siya
                            //maka like ra sia sa comment sa uban
                            else
                            {
                                echo "<button name = 'like_comment' value = ".$row_comment['id'].">Like(".$likes.")</button>";
                            }
                        }
                    endwhile;
                    echo"</form>
                    </div>
                    </div>
                ";
            endwhile;
                 echo"</div>
                  </div>";

                  ///////////////////////////////
            include ("inc/footer.php"); 
        ?>
        </div>
        
    </body>
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        #pinakaMain{
            width:80vw;
            margin-left: 10vw;
         

        }
       
        .container{
            width: 60%;
            margin-left: 20%;

        }
        #userHead{
            display: flex;
            margin-bottom: 10px;
        }
        .innerCont{
            width: 100%;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
        }
        .imagePost{
            margin-left: -1.5%;
            width: 103%;
            height: 50vh;
        }
        .forPadding{
            padding: 10px;
        }
        .postName{
            margin-top: 15px;
            margin-left: 15px;
            
        }
        .profileImg2{
            border-radius: 30px;
            width: 30px;
            height: 30px;
            color: #333;
            float: center;
            margin-top: 10px;
        }
        #likeBtn{
            margin-top: 10px;
            border: none;
            background: white;
        }
        .likeBtnImg{
            height: 30px;
        }
        .firstCont{
            height: 60px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            margin-bottom: 10px;
            margin-top: 10px;
        }
    </style>
    <script>

    </script>
</html>