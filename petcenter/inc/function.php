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

    function timeline()
    {
        include("inc/db.php");
        
        $user = $_SESSION['pet_center_name'];
        $view_user = $con->prepare("SELECT * FROM pet_center_tbl WHERE pet_center_name = '$user'");
        $view_user->setFetchMode(PDO:: FETCH_ASSOC);
        $view_user->execute();

        $row_user = $view_user->fetch();
        $pet_center_id = $row_user['pet_center_id'];

        $view_user_service = $con->prepare("SELECT * FROM services WHERE pet_center_id = '$pet_center_id'");
        $view_user_service->setFetchMode(PDO:: FETCH_ASSOC);
        $view_user_service->execute();

        while($row = $view_user_service->fetch()): 
            echo
            "<li>
                <form method = 'post' enctype='multipart/form-data'>
                <a href='show_service_info.php?id=".$row['id']."'>
                    <h4>".$row['services_name']."</h4>
                    <img src ='../uploads/user_profile/".$row['service_photo']."' />
                    <center>
                        <button id = 'pro_btnView'>
                            <a href = 'show_service_info.php?id=".$row['id']."'>Show Info</a>
                        </button>
                        <input type = 'hidden' value = '".$row['id']."' name = 'pro_id' />
                    </center>
                </a>
                </form>
            </li>";
        endwhile;
       
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
        if(isset($_POST['add_user']))
        {
            $pet_center_name = $_POST['pet_center_name'];
            $pet_center_password = $_POST['pet_center_password'];
            $email = $_POST['email'];
            $contact_number = $_POST['contact_number'];
            $accept_coupons = $_POST['accept_coupons'];

            if(strlen($pet_center_password) >= 8 &&
            preg_match('/[A-Z]/', $pet_center_password) > 0 &&
            preg_match('/[a-z]/', $pet_center_password) > 0)
            {
                $add_service = $con->prepare("INSERT INTO pet_center_tbl (
                    pet_center_name,
                    pet_center_password,
                    email,
                    contact_number,
                    pet_center_photo,
                    active_coupon
                ) 
                VALUES (
                    '$pet_center_name',
                    '$pet_center_password',
                    '$email',
                    '$contact_number',
                    'userIcon.svg',
                    '$accept_coupons'
                )");
    
                if($add_service->execute())
                {
                    echo "
                    <script>
                    alert('Registered Successful!');
                    if ( window.history.replaceState ) {
                       window.history.replaceState( null, null, window.location.href );
                   }            
                    </script>"; 
                }
                else
                {
                    echo "<script>alert('Registered Unsuccessful!');</script>";
                }
            }
            else
            {
                echo "Password must have 8 characters long, an uppercase and at least 1 special character!";
            }
        }
    }
    function add_service()
    {   
        echo
        "<form method = 'POST' enctype = 'multipart/form-data'>
        <table>
        <tr>
            <td>Name: </td>
            <td><input type='text' name = 'services_name' required /></td>
        </tr>
        <tr>
            <td>Location: </td>
            <td><input type='text' name =  'services_loc' required /></td>
        </tr>
        <tr>
            <td>Email: </td>
            <td><input type='text' name =  'services_email' required /></td>
        </tr>
        <tr>
            <td>Contact Number: </td>
            <td><input type='text' name =  'services_contact_number' required /></td>
        </tr>
        <tr>
            <td>Service Day From: </td>
            <td>
                <select name = 'day_open' required>";
                    echo days();
                echo "</select>
            </td>
        </tr>
        <tr>
            <td>Service Day To: </td>
            <td>
                <select name = 'day_close' required>";
                    echo days();
                echo "</select>
            </td>
        </tr>
        <tr>
            <td>Time Open: </td>
            <td><input type='time' name =  'time_open' required/></td>
        </tr>
        <tr>
            <td>Time Close: </td>
            <td><input type='time' name =  'time_close' required/></td>
        </tr>
        <tr>
            <td>Service Cost: </td>
            <td><input type='text' name =  'service_cost' required/></td>
        </tr>
        <tr>
            <td>Photo: </td>
            <td><input type='file' name =  'service_photo' required/></td>
        </tr>
       
        <tr>
            <td>Select Category:</td>
            <td>
                <select name = 'service_cat' required>";
                    echo viewall_cat();
                echo"</select>
            </td>
        </tr>
    
    </table>
    <button name = 'add_service'>Add Service</button>
        </form>";
        include ("inc/db.php");
        if(isset($_POST['add_service']))
        {
            $pet_center_name = $_SESSION['pet_center_name'];
          

            $fetch_name = $con->prepare("SELECT * FROM pet_center_tbl WHERE pet_center_name = '$pet_center_name'");
            $fetch_name->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_name->execute();

            $row = $fetch_name->fetch();

            $pet_center_id = $row['pet_center_id'];

            $service_id = $_POST['service_cat'];
            $services_name = $_POST['services_name'];
            $services_loc = $_POST['services_loc'];
            $services_email = $_POST['services_email'];
            $services_contact_number = $_POST['services_contact_number'];
            $day_open = $_POST['day_open'];
            $day_close = $_POST['day_close'];
            $time_open = $_POST['time_open'];
            $time_close = $_POST['time_close'];
            $service_cost = $_POST['service_cost'];

            $service_photo = $_FILES['service_photo']['name'];
            $service_photo_tmp = $_FILES['service_photo']['tmp_name'];
            move_uploaded_file($service_photo_tmp,"../uploads/user_profile/$service_photo");


            $query = $con->prepare("INSERT INTO services
            (
                service_id,
                pet_center_id,
                services_name,
                services_loc,
                services_email,
                services_contact_number,
                day_open,
                day_close,
                time_open,
                time_close,
                service_cost,
                service_photo
            ) 
            VALUES
            (
                $service_id,
                $pet_center_id,
                '$services_name',
                '$services_loc',
                '$services_email',
                '$services_contact_number',
                '$day_open',
                '$day_close',
                '$time_open',
                '$time_close',
                '$service_cost',
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

    function view_service()
    {
        echo "<a href = 'addService.php'>Add Service</a>";
        include("inc/db.php");
        $user_name = $_SESSION['pet_center_name'];
        $sql = $con->prepare("SELECT * FROM pet_center_tbl WHERE pet_center_name = '$user_name'");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();

        $row = $sql->fetch();
        $pet_center_id = $row['pet_center_id'];

        $sql2 = $con->prepare("SELECT * FROM services WHERE pet_center_id = '$pet_center_id'");
        $sql2->setFetchMode(PDO:: FETCH_ASSOC);
        $sql2->execute();

        while($row2 = $sql2->fetch()):
            $service_id = $row2['service_id'];
            $sql3 = $con->prepare("SELECT * FROM service_cat WHERE cat_id = '$service_id'");
            $sql3->setFetchMode(PDO:: FETCH_ASSOC);
            $sql3->execute();

            $row3 = $sql3->fetch();
            $day_open = $row2['day_open'];
            $day_close = $row2['day_close'];

            $sql4 = $con->prepare("SELECT * FROM daysweek WHERE id = '$day_open'");
            $sql4->setFetchMode(PDO:: FETCH_ASSOC);
            $sql4->execute();
            $row4 = $sql4->fetch();

            $sql5 = $con->prepare("SELECT * FROM daysweek WHERE id = '$day_close'");
            $sql5->setFetchMode(PDO:: FETCH_ASSOC);
            $sql5->execute();
            $row5 = $sql5->fetch();

            echo 
            "<tr>
                <td>".$row3['cat_name']."</td>
                <td>".$row2['services_name']."</td>
                <td>".$row2['services_loc']."</td>
                <td>".$row2['services_email']."</td>
                <td>".$row2['services_contact_number']."</td>
                <td>".$row4['days']." - ".$row5['days']."</td>
                <td>".date('g:i A', strtotime($row2['time_open']))." - ".date('g:i A', strtotime($row2['time_close']))."</td>
                <td>".$row2['service_cost']."</td>
                <td>".$row2['service_photo']."</td>
                <td><a href = 'edit_service.php?edit_service=".$row2['id']."'>Edit</a></td>
                <td><a href = 'delete_service.php?delete_service=".$row2['id']."'>Delete</a></td>
            </tr>";
        endwhile;

    }

    function view_requests()
    {
        include("inc/db.php");
        $user_name = $_SESSION['pet_center_name'];
        $sql = $con->prepare("SELECT * FROM pet_center_tbl WHERE pet_center_name = '$user_name'");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();

        $row = $sql->fetch();
        $pet_center_id = $row['pet_center_id'];

        $sql2 = $con->prepare("SELECT * FROM reserve_services WHERE pet_center_id = '$pet_center_id'");
        $sql2->setFetchMode(PDO:: FETCH_ASSOC);
        $sql2->execute();

        while($row2 = $sql2->fetch()):
            $user_id = $row2['user_id'];
            $view_user = $con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
            $view_user->setFetchMode(PDO:: FETCH_ASSOC);
            $view_user->execute();

            $row_user = $view_user->fetch();
            $user_username = $row_user['user_username'];
            $empty_coupon = "N/A";
            echo
            "<form method = 'POST'>
                <tr>
                    <td>".$user_username."</td>
                    <td>".date('g:i A', strtotime($row2['reserve_time']))."</td>";
                    if($row2['coupon_code'] == '')
                    {
                        echo "<td>".$empty_coupon."</td>";
                    }
                    else
                    {
                        echo "<td>".$row2['coupon_code']."</td>";
                    }
                    echo "<td>".$row2['transaction_code']."</td> 
                    <td><button name = 'confirm_request' value = ".$row2['reserve_id'].">Confirm</button></td>
                </tr>
            </form>";
        endwhile;
        
        $receiver = $row_user['user_email'];
        $subject = "Reserve Confirmation";
        $body = "Reservation Confirmed!";
        $sender = "ianjohn0101@gmail.com";

        if(mail($receiver, $subject, $body, $sender))
        {
            if(isset($_POST['confirm_request']))
            {
                $reserve_id = $_POST['confirm_request'];
                $confirm = $con->prepare("UPDATE reserve_services SET service_status = 'CONFIRMED' WHERE reserve_id = '$reserve_id'");
                $confirm->setFetchMode(PDO:: FETCH_ASSOC);
                $confirm->execute();
    
                if($confirm->execute())
                {
                    echo "<script>alert('Services Successfully Updated!');</script>";
                    echo "<script>window.open('confirmRequests.php', '_self');</script>";
                }
            }
        }
    }

    function edit_service()
    {
        include("inc/db.php");
        if(isset($_GET['edit_service']))
        {
            $service_id = $_GET['edit_service'];
            $query = $con->prepare("SELECT * FROM services WHERE id = '$service_id'");
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();

            $row = $query->fetch();

            $day_open = $row['day_open'];
            $day_close = $row['day_close'];

            $sql4 = $con->prepare("SELECT * FROM daysweek WHERE id = '$day_open'");
            $sql4->setFetchMode(PDO:: FETCH_ASSOC);
            $sql4->execute();
            $row4 = $sql4->fetch();

            $sql5 = $con->prepare("SELECT * FROM daysweek WHERE id = '$day_close'");
            $sql5->setFetchMode(PDO:: FETCH_ASSOC);
            $sql5->execute();
            $row5 = $sql5->fetch();
            echo 
            "<form method = 'POST' enctype='multipart/form-data'>
                <div>
                    <input type = 'text' name = 'services_name' value = '".$row['services_name']."' />
                </div>
                <div>
                    <input type = 'text' name = 'services_loc' value = '".$row['services_loc']."' />
                </div>
                <div>
                    <input type = 'text' name = 'services_email' value = '".$row['services_email']."' />
                </div>
                <div>
                    <input type = 'text' name = 'services_contact_number' value = '".$row['services_contact_number']."' />
                </div>
                <div>
                    <input type = 'text' name = 'service_cost' value = '".$row['service_cost']."' />
                </div>
                <div>
                    <input type = 'time' name = 'time_open' value = '".$row['time_open']."' />
                </div>
                <div>
                    <input type = 'time' name = 'time_close' value = '".$row['time_close']."' />
                </div>
                <div>
                    <select name = 'day_open' required>";
                        echo days();
                    echo" </select>
                </div>
                <div>
                    <select name = 'day_close' required>";
                        echo days();
                    echo" </select>
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
                $services_loc =  $_POST['services_loc'];
                $services_email = $_POST['services_email'];
                $services_contact_number = $_POST['services_contact_number'];
                $day_open = $_POST['day_open'];
                $day_close = $_POST['day_close'];
                $time_open = $_POST['time_open'];
                $time_close = $_POST['time_close'];
                $service_cost = $_POST['service_cost'];
              
                $service_photo = $_FILES['service_photo']['name'];
                $service_photo_tmp = $_FILES['service_photo']['tmp_name'];

                move_uploaded_file($service_photo_tmp,"../uploads/user_profile/$service_photo");
                
                $update_service = $con->prepare("UPDATE services 
                SET 
                    services_name='$services_name',
                    services_loc = '$services_loc',
                    services_email = '$services_email',
                    services_contact_number = '$services_contact_number',
                    day_open = '$day_open',
                    day_close = '$day_close',
                    time_open = '$time_open',
                    time_close = '$time_close',
                    service_cost = '$service_cost',
                    service_photo = '$service_photo'
                WHERE 
                    id = '$service_id'");
    
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
        $delete_service  = $con->prepare("DELETE from services where id = '$service_id'");
        if($delete_service->execute())
        {
            echo "<script>alert('Service Deleted Successfully!');</script>";
            echo "<script>window.open('index.php?login_user=".$_SESSION['pet_center_name']."', '_self');</script>";
        }
    }

    function count_requests()
    {
        include("inc/db.php");
        $count_orders = $con->prepare("SELECT * FROM reserve_services");
        $count_orders->setFetchMode(PDO:: FETCH_ASSOC);
        $count_orders->execute();

        $count = $count_orders->rowCount();
        echo $count;
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

    function days()
    {
        include("inc/db.php");
        $viewdays = $con->prepare("SELECT * FROM daysweek");
        $viewdays->setFetchMode(PDO:: FETCH_ASSOC);
        $viewdays->execute();

        while($row=$viewdays->fetch()):
            echo "<option value = '".$row['id']."'>".$row['days']."</option>";
        endwhile;
    }

    

    

?>