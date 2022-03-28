<?php
    session_start();

    function LogIn()
    {
        include("inc/db.php");
        if(isset($_POST['login_user']))
        {
            $pet_center_name = $_POST['pet_center_name'];
            $pet_center_password = $_POST['pet_center_password'];

            $fetchuser = $con->prepare("SELECT * FROM pet_center_tbl WHERE pet_center_name = '$pet_center_name' AND pet_center_password = '$pet_center_password'");
            $fetchuser->setFetchMode(PDO:: FETCH_ASSOC);
            $fetchuser->execute();
            $countUser = $fetchuser->rowCount();

            $row = $fetchuser->fetch();
            $user_role = $row['user_type'];
            if($countUser>0)
            {
                $_SESSION['pet_center_name'] = $_POST['pet_center_name'];
                echo "<script>window.open('index.php?login_user=".$_SESSION['pet_center_name']."','_self');</script>";
            }
            else
            {
                echo "<script>alert('Username or Password is incorrect!');</script>";
            }
        }
    }

    function add_service_cat()
    {
        include("inc/db.php");
        if(isset($_POST['add_service_cat']))
        {
            $cat_name = $_POST['cat_name'];
            $add_cat = $con->prepare("insert into service_cat(cat_name) values('$cat_name')");
            
            if($add_cat->execute())
            {
                echo "<script>alert('Category Added Successfully!');</script>"; 
                echo "<script>window.open('index.php?login_user=".$_SESSION['pet_center_name']."','_self');</script>";
            }
            else
            {
                echo "<script>alert('Category Not Added Successfully!');</script>";
            }
        }
    }

    

    function viewall_cat()
    {   
        include("inc/db.php");
        $fetch_cat=$con->prepare("SELECT * from service_cat");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();
                            
        while($row=$fetch_cat->fetch()):
            echo "<option value = '".$row['cat_id']."'>".$row['cat_name']."</option>";
        endwhile;
    }
    
    function add_pet_center_user()
    {
        include("inc/db.php");
        
        echo "<div id ='signUpForm'>
        <div class='signUpForm'>
            <h3>Add Pet Center</h3>
                <form method = 'POST' enctype = 'multipart/form-data'>
                    <table>
                        <tr>
                            <td>Name: </td>
                            <td><input type='text' name = 'pet_center_name' /></td>
                        </tr>
                        <tr>
                            <td>Password: </td>
                            <td><input type='text' name =  'pet_center_password' /></td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td><input type='text' name =  'email' /></td>
                        </tr>
                        <tr>
                            <td>Contact Number: </td>
                            <td><input type='text' name =  'contact_number' /></td>
                        </tr>
                        <tr>
                            <td>Photo: </td>
                            <td><input type='file' name =  'pet_center_photo' /></td>
                        </tr>
                    </table>
                    <button name = 'add_user'>Add Service</button>
                </form>
            </div>
        </div>";
        if(isset($_POST['add_user']))
        {
            $pet_center_name = $_POST['pet_center_name'];
            $pet_center_password = $_POST['pet_center_password'];
            $email = $_POST['email'];
            $contact_number = $_POST['contact_number'];

            $pet_center_photo = $_FILES['pet_center_photo']['name'];
            $pet_center_photo_tmp = $_FILES['pet_center_photo']['tmp_name'];
        
            move_uploaded_file($pet_center_photo_tmp,"../uploads/user_profile/$pet_center_photo");

            $add_service = $con->prepare("INSERT INTO pet_center_tbl (
                pet_center_name,
                pet_center_password,
                email,
                contact_number,
                pet_center_photo
            ) 
            VALUES (
                '$pet_center_name',
                '$pet_center_password',
                '$email',
                '$contact_number',
                '$pet_center_photo'
            )");

            if($add_service->execute())
            {
                echo "<script>alert('Registered Successful!');</script>"; 
            }
            else
            {
                echo "<script>alert('Registered Unsuccessful!');</script>";
            }
        }
    }

    function view_service()
    {
        include("inc/db.php");
        $fetch_pro = $con->prepare("SELECT * from services");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        while($row=$fetch_pro->fetch()):
            echo "<tr>
                    <td>".$row['services_name']."</td>
                    <td>".$row['service_loc']."</td>
                    <td>".$row['service_email']."</td>
                    <td>".$row['service_contact_number']."</td>
                    <td>".$row['service_date_open']."</td>
                    <td><a href = 'edit_service.php?edit_service=".$row['service_id']."'>Edit</a></td>
                    <td><a href = 'delete_service.php?delete_service=".$row['service_id']."'>Delete</a></td>
                 </tr>";
        endwhile;
        echo 
        "<tr>
        <td><a href = 'addService.php?add_service=".$_SESSION['pet_center_name']."'>Add</a></td>
        </tr>";
    }

    function edit_service()
    {
        include("inc/db.php");
        if(isset($_GET['edit_service']))
        {
            $service_id = $_GET['edit_service'];
            $query = $con->prepare("SELECT * FROM services WHERE service_id = '$service_id'");
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();

            $row = $query->fetch();
            echo 
            "<form method = 'POST' enctype='multipart/form-data'>
                <div>
                    <input type = 'text' name = 'services_name' value = '".$row['services_name']."' />
                </div>
                <div>
                    <input type = 'text' name = 'service_loc' value = '".$row['service_loc']."' />
                </div>
                <div>
                    <input type = 'text' name = 'service_email' value = '".$row['service_email']."' />
                </div>
                <div>
                    <input type = 'text' name = 'service_contact_number' value = '".$row['service_contact_number']."' />
                </div>
                <div>
                    <input type = 'text' name = 'service_date_open' value = '".$row['service_date_open']."' />
                </div>
                <div>
                    <input type = 'file' name = 'service_photo' value = '".$row['service_photo']."' />
                </div>
                <div>
                    <button name = 'update_service'>Update Service</button>
                </div>
            </form>";
            if(isset($_POST['update_service']))
            {
                $services_name = $_POST['services_name'];
                $service_loc =  $_POST['service_loc'];
                $service_email = $_POST['service_email'];
                $service_contact_number = $_POST['service_contact_number'];
                $service_date_open = $_POST['service_date_open'];
                $service_photo = $_POST['service_photo'];
    
                $update_service = $con->prepare("UPDATE services 
                SET 
                    services_name='$services_name',
                    service_loc = '$service_loc',
                    service_email = '$service_email',
                    service_contact_number = '$service_contact_number',
                    service_date_open = '$service_date_open',
                    service_photo = '$service_photo'
                WHERE 
                    service_id = '$service_id'");
    
                if($update_service->execute())
                {
                    echo "<script>alert('Services Successfully Updated!');</script>";
                    echo "<script>window.open('index.php?login_user=".$_SESSION['pet_center_name']."', '_self');</script>";
                }
            }
        }
    }

    function delete_service()
    {
        include("inc/db.php");
        $service_id = $_GET['delete_service'];
        $delete_service  = $con->prepare("DELETE from services where service_id = '$service_id'");
        if($delete_service->execute())
        {
            echo "<script>alert('Service Deleted Successfully!');</script>";
            echo "<script>window.open('index.php?login_user=".$_SESSION['pet_center_name']."', '_self');</script>";
        }
    }

    function myProfile()
    {
        include("inc/db.php");
        if(isset($_SESSION['pet_center_name']))
        {
            $user_id = $_SESSION['pet_center_name'];
            $fetch_user_username = $con->prepare("SELECT * FROM pet_center_tbl WHERE pet_center_name = '$user_id'");
            $fetch_user_username->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_user_username->execute();
    
            $row = $fetch_user_username->fetch();
            $id = $row['pet_center_id'];
    
            echo 
            "<form method = 'POST' enctype='multipart/form-data'>
                <div class='profileTable'>
                <div class = 'photo'>
                    <img src = '../uploads/userIcon.svg'  />
                    <input type = 'file' name = 'pet_center_photo' class = 'fileUpload' />
                </div>
                <p class='name'>User's Name</p>
                <div class = 'contf'>
                <div class='formt'>
                    <div class='username'>
                        <p class='us'>username </p>
                        <input class='user_name'type = 'text' name =  'user_username' value = '".$row['pet_center_name']."' />
                    </div>
                    <div class='username'>
                        <p class = 'us'>password </p>
                        <input class='user_name' type = 'password' name = 'user_password' value = '".$row['pet_center_password']."' />
                    </div>
                    <div class = 'username'>
                        <p class='us'>email </p>
                        <input class='user_name' type = 'email' name = 'user_email' value = '".$row['email']."' />
                    </div>
                    <div class = 'username'>
                        <p class = 'us'>Contact Number: </p>
                        <input  class = 'user_name 'type = 'text' name = 'user_contactnumber' value = '".$row['contact_number']."' />
                    </div>
                    <div class = 'usernameb'>
                        <button name = 'update_user'>Update Profile</button>
                    </div>
                    <div class = 'usernameh'>
                        <button class = 'back' onclick='window.location.href='/Pet/petcenter/index.php'>Back to Home</button>
                    </div>
                    </div>
                    <div class='rightSide'>
                        
                    </div>
                    </div>
                </div>
                
            </form>
            ";
    
            if(isset($_POST['update_user']))
            {
                $pet_center_name = $_POST['pet_center_name'];
                $pet_center_password =  $_POST['pet_center_password'];
                $contact_number = $_POST['contact_number'];
                $email = $_POST['email'];
                $pet_center_photo = $_POST['pet_center_photo'];
    
                $update_user = $con->prepare("UPDATE pet_center_tbl 
                SET 
                    pet_center_name='$pet_center_name',
                    pet_center_password = '$pet_center_password',
                    contact_number = '$contact_number',
                    email = '$email',
                    pet_center_photo = '$pet_center_photo'
                WHERE 
                    pet_center_id = '$id'");
    
                if($update_user->execute())
                {
                    echo "<script>alert('Your Information Successfully Updated!');</script>";
                    echo "<script>window.open('index.php?login_user=".$_SESSION['pet_center_name']."', '_self');</script>";
                }
            }
        }
    }

    function add_service()
    {
        include ("inc/db.php");
        if(isset($_POST['add_service']))
        {
            $pet_center_name = $_SESSION['pet_center_name'];
            $sql = $con->prepare("SELECT * FROM pet_center_tbl WHERE pet_center_name = '$pet_center_name'");
            $sql->setFetchMode(PDO:: FETCH_ASSOC);
            $sql->execute();

            $row = $sql->fetch();
            $petId = $row['pet_center_id'];

            $services_name = $_POST['services_name'];
            $service_loc = $_POST['service_loc'];
            $service_email = $_POST['service_email'];
            $service_contact_number = $_POST['service_contact_number'];
            $service_date_open = $_POST['service_date_open'];

            $service_photo = $_FILES['service_photo']['name'];
            $service_photo_tmp = $_FILES['service_photo']['tmp_name'];
            move_uploaded_file($service_photo_tmp,"../uploads/user_profile/$service_photo");

            $query = $con->prepare("INSERT INTO services
            (
                pet_center_id,
                services_name,
                service_loc,
                service_email,
                service_contact_number,
                service_date_open,
                service_photo
            ) 
            VALUES
            (
                '$petId',
                '$services_name',
                '$service_loc',
                '$service_email',
                '$service_contact_number',
                '$service_date_open',
                '$service_photo'
            )");

            if($query->execute())
            {
                echo "Service Successfully Added!";
            }
            else
            {
                echo "Unsuccessful!";
            }
           
        }
    }

    

?>