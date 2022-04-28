<?php
    session_start();

    function LogIn()
    {
        include("inc/db.php");
        if(isset($_POST['login_user']))
        {
            $email = $_POST['email'];
            $pet_center_password = $_POST['pet_center_password'];

            
            $check_email = $con->prepare("SELECT * FROM pet_center_tbl WHERE email = '$email'");
            $check_email->setFetchMode(PDO::FETCH_ASSOC);
            $check_email->execute();

            $verified = $check_email->fetch();
            $isVerified = $verified['verified'];

            if($isVerified == 1)
            {
                $fetchuser = $con->prepare("SELECT * FROM pet_center_tbl WHERE email = '$email' AND pet_center_password = '$pet_center_password'");
                $fetchuser->setFetchMode(PDO:: FETCH_ASSOC);
                $fetchuser->execute();
                
                $row = $fetchuser->fetch();
                $countUser = $fetchuser->rowCount();
                if($countUser>0)
                {
                    $_SESSION['pet_center_name'] = $row['pet_center_name'];
                    echo "<script>window.open('index.php?login_user=".$_SESSION['pet_center_name']."','_self');</script>";
                }
                else
                {
                    echo "<script>alert('Username or Password is incorrect!');</script>";
                }
            }
            else
            {
                echo "Please verify your email!";
            }
        }
    }

    function verify()
    {
        include("inc/db.php");
        if(isset($_POST['verify_key']))
        {
            $user_email = $_POST['email'];
            $v_key = $_POST['v_key'];

            $check_email = $con->prepare("SELECT * FROM pet_center_tbl WHERE email = '$user_email' AND v_key = '$v_key'");
            $check_email->setFetchMode(PDO:: FETCH_ASSOC);
            $check_email->execute();

            $row = $check_email->rowCount();
            if($row>0)
            {
                $update_verification = $con->prepare("UPDATE pet_center_tbl SET verified = 1 WHERE email = '$user_email'");
                if($update_verification->execute())
                {
                    echo "You can now log in!";
                }
            }
            else
            {
                echo "Email or Verification Code is incorrect!";
            }
        }
    }

    function timeline()
    {
        include("inc/db.php");
        
        if(!isset($_SESSION['pet_center_name']))
        {
            header('Location: login.php');
        }
        else
        {
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
            $verification_key = generateRandomString();

            $view_email = $con->prepare("SELECT COUNT(*) AS pet_center_email FROM pet_center_tbl WHERE email = '$email'");
            $view_email->setFetchMode(PDO::FETCH_ASSOC);
            $view_email->execute();

            $row = $view_email->fetch();

            $view_name = $con->prepare("SELECT COUNT(*) AS pet_cent_name FROM pet_center_tbl WHERE pet_center_name = '$pet_center_name'");
            $view_name->setFetchMode(PDO::FETCH_ASSOC);
            $view_name->execute();

            $row2 = $view_name->fetch();

            if($row['pet_center_email']>0)
            {
                echo "Email Exists";
            }
            elseif($row2['pet_cent_name']>0)
            {
                echo "Name Exists";
            }
            elseif(!is_numeric($contact_number))
            {
                echo "Only Digits Allowed!";
            }
            elseif(strlen($contact_number)>=12)
            {
                echo "Number must at least 11 digits!";
            }
            elseif(strlen($pet_center_password) >= 9 &&
            preg_match('/[A-Z]/', $pet_center_password) > 0 &&
            preg_match('/[a-z]/', $pet_center_password) > 0)
            {
                echo "Password must at least 8 characters in length!";
            }
            else
            {
                $receiver = $user_email;
                $subject = "Email Verification";
                $body = "Use this Verification Code: $verification_key to verify your email!";
                $sender = "ianjohn0101@gmail.com";

                if(mail($receiver, $subject, $body, $sender))
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

        
            
        $datenow = getdate();

        $today = $datenow['year'] . '-' . $datenow['mon'] . '-' . $datenow['mday'];

        while($row2 = $sql2->fetch()):
            $reserve_id = $row2['reserve_id'];
            $user_id = $row2['user_id'];
            $date = $row2['reserve_date'];
            $transaction_code = $row2['transaction_code'];
            $service_id = $row2['service_id'];
            $service_cost = $row2['service_cost'];
            $coupon_code = $row2['coupon_code'];

            $view_service = $con->prepare("SELECT * FROM services WHERE service_id = '$service_id'");
            $view_service->setFetchMode(PDO:: FETCH_ASSOC);
            $view_service->execute();

            $row_service = $view_service->fetch();
            $service_name = $row_service['services_name'];


            $view_user = $con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
            $view_user->setFetchMode(PDO:: FETCH_ASSOC);
            $view_user->execute();

            $row_user = $view_user->fetch();
            $user_username = $row_user['user_username'];
            $empty_coupon = "N/A";
            echo
            "<form method = 'POST'>
                <tr>
                    <td><input type = 'hidden' name = 'pet_center_id' value = '".$pet_center_id."' /></td>
                    <td><input type = 'hidden' name = 'service_id' value = '".$service_id."' /></td>
                    <td><input type = 'hidden' name = 'user_id' value = '".$user_id."' /></td>
                    <td><input type = 'hidden' name = 'coupon_code' value = '".$coupon_code."' /></td>
                    <td><input type = 'hidden' name = 'transaction_code' value = '".$transaction_code."' /></td>
                    <td><input type = 'hidden' name = 'date_confirmed' value = '".$today."' /></td>
                    <td><input type = 'hidden' name = 'service_cost' value = '".$service_cost."' /></td>
                    <td>".$user_username."</td>
                    <td>".date('g:i A', strtotime($row2['reserve_time']))."</td>";
                    if($row2['coupon_code'] == '')
                    {
                        echo "<td>".$empty_coupon."</td>";
                    }
                    else
                    {
                        echo "<td>".$coupon_code."</td>";
                    }
                    echo "<td>".$transaction_code."</td> 
                    <td><button name = 'confirm_request' value = ".$reserve_id.">Confirm</button></td>
                </tr>
            </form>";
        endwhile;
        
        $receiver = $row_user['user_email'];
        $subject = "Reserve Confirmation";
        $body = 
        "
        Greetings! 

        This is from $service_name we are hoping for your best experience for the service we provide. 
        Please come with the respective date $date, with the Transacton Code: $transaction_code
        
        Respecfully yours,
        $service_name";
        $sender = "ianjohn0101@gmail.com";


        if(mail($receiver, $subject, $body, $sender))
        {
            // var_dump($pet_center_id);
            // var_dump($service_id);
            // var_dump($user_id);
            // var_dump($coupon_code);
            // var_dump($transaction_code);
            // var_dump($today);
            // var_dump($service_cost);
            if(isset($_POST['confirm_request']))
            {
                $reserve_id = $_POST['confirm_request'];
                $pet_center_id = $_POST['pet_center_id'];
                $service_id = $_POST['service_id'];
                $user_id = $_POST['user_id'];
                $coupon_code = $_POST['coupon_code'];
                $transaction_code = $_POST['transaction_code'];
                $date_confirmed = $_POST['date_confirmed'];
                $amount = $_POST['service_cost'];
                $confirm = $con->prepare("INSERT INTO confirmed_services
                (
                    pet_center_id,
                    service_id,
                    user_id,
                    coupon_code,
                    transaction_code,
                    date_confirmed,
                    amount
                ) 
                VALUES
                (
                    '$pet_center_id',
                    '$service_id',
                    '$user_id',
                    '$coupon_code',
                    '$transaction_code',
                    '$today',
                    '$service_cost'
                )");
                if($confirm->execute())
                {
                    $delete_reservation = $con->prepare("DELETE FROM reserve_services WHERE reserve_id = '$reserve_id'");
                    if($delete_reservation->execute())
                    {
                        echo "<script>alert('Services Successfully Confirmed!');</script>";
                        echo "<script>window.open('confirmRequests.php', '_self');</script>";
                    }
                }
            }
        }
    }

    function viewHistory()
    {
        include("inc/db.php");
        $user_name = $_SESSION['pet_center_name'];
        $sql = $con->prepare("SELECT * FROM pet_center_tbl WHERE pet_center_name = '$user_name'");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();

        $row = $sql->fetch();
        $pet_center_id = $row['pet_center_id'];

        $sql2 = $con->prepare("SELECT * FROM confirmed_services");
        $sql2->setFetchMode(PDO:: FETCH_ASSOC);
        $sql2->execute();

        $sql3 = $con->prepare("SELECT SUM(amount) FROM confirmed_services");
        $sql3->setFetchMode(PDO:: FETCH_ASSOC);
        $sql3->execute();

        $row2 = $sql3->fetch();

        // <th>User Name</th>
        //     <th>Coupon Code</th>
        //     <th>Transaction Code</th>
        //     <th>Date Confirmed</th>
        //     <th>Amount</th>
        $total_amount = 0;
        while($row = $sql2->fetch()):
            $user_id = $row['user_id'];

            $fetch_username=$con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
            $fetch_username->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_username->execute();

            $row_username = $fetch_username->fetch();
            $empty = "N/A";
            echo
            "<tr>
                <td>".$row_username['user_username']."</td>";
                if($row['coupon_code'] == '')
                {
                    echo "<td>".$empty."</td>";
                }
                else
                {
                    echo "<td>".$row['coupon_code']."</td>";
                }
                echo 
                "<td>".$row['transaction_code']."</td>
                <td>".$row['amount']."</td>
                <td>".$row['date_confirmed']."</td>
            </tr>";   
        endwhile;
        echo 
        "<tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Total Amount: ".$row2['SUM(amount)']."</td>
        </tr>";
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
              
                <p class='name'>User's Details</p>
                <div class = 'contf'>
                <div class='formt'>
                    <div class='username'>
                        <p class='us'>username </p>
                        <input class='user_name'type = 'text' name =  'pet_center_name' value = '".$row['pet_center_name']."' />
                    </div>
                    <div class='username'>
                        <p class = 'us'>password </p>
                        <input class='user_name' type = 'password' name = 'pet_center_password' value = '".$row['pet_center_password']."' />
                    </div>
                    <div class = 'username'>
                        <p class='us'>email </p>
                        <input class='user_name' type = 'email' name = 'email' value = '".$row['email']."' />
                    </div>
                    <div class = 'username'>
                        <p class = 'us'>Contact Number: </p>
                        <input  class = 'user_name 'type = 'text' name = 'contact_number' value = '".$row['contact_number']."' />
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
             
                
            </form>
            <form method = 'POST' enctype = 'multipart/form-data'>
                <tr>
                    <td>
                        <label>Profile Picture</label>
                        <img src = '../uploads/user_profile/".$row['pet_center_photo']."'  style = 'height:50px;width:50px;' />
                        <br><input type = 'file' name = 'pet_center_photo' value = '".$row['pet_center_photo']."' required/><br>
                    </td>
                </tr><br>
                <button name = 'update_profile'>Update Proifle</button>
            </form>";
    
            if(isset($_POST['update_user']))
            {
                $pet_center_name = $_POST['pet_center_name'];
                $pet_center_password =  $_POST['pet_center_password'];
                $contact_number = $_POST['contact_number'];
                $email = $_POST['email'];

                if(is_numeric($contact_number))
                {
                    if(strlen($contact_number) <= 11)
                    {
                        if(strlen($pet_center_password) >= 9 &&
                        preg_match('/[A-Z]/', $pet_center_password) > 0 &&
                        preg_match('/[a-z]/', $pet_center_password) > 0)
                        {
                            echo "Password must at least 8 characters in length with at least 1 special character, 1 number!";
                        }
                        else
                        {
                            $update_user = $con->prepare("UPDATE pet_center_tbl 
                            SET 
                                pet_center_name='$pet_center_name',
                                pet_center_password = '$pet_center_password',
                                contact_number = '$contact_number',
                                email = '$email'
                            WHERE 
                                pet_center_id = '$id'");
                
                            if($update_user->execute())
                            {
                                echo "<script>alert('Your Information Successfully Updated!');</script>";
                                echo "<script>window.open('index.php?login_user=".$_SESSION['pet_center_name']."', '_self');</script>";
                            }
                        }
                    }
                    else
                    {
                        echo "Contact Number must at least 11 digits only!";
                    }
                }
                else
                {
                    echo "Only digits allowed!";
                }
                
            }
            if(isset($_POST['update_profile']))
            {
                $pet_center_photo = $_FILES['pet_center_photo']['name'];
                $pet_center_photo_tmp = $_FILES['pet_center_photo']['tmp_name'];

                move_uploaded_file($pet_center_photo_tmp,"../uploads/user_profile/$pet_center_photo");

                $update_profile = $con->prepare("UPDATE pet_center_tbl SET pet_center_photo = '$pet_center_photo' WHERE pet_center_id = '$id'");

                if($update_profile->execute())
                {
                    echo "<script>alert('Profile Updated!');</script>";
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

    function search() {
        include("inc/db.php");

        if(isset($_GET['search']) && isset($_GET['user_query']))
        {
            $user_query = $_GET['user_query'];

            $search = $con->query("SELECT * FROM confirmed_services WHERE transaction_code LIKE '%$user_query%'");
            $search->setFetchMode(PDO:: FETCH_ASSOC);
            $search->execute();

            echo "<div id = 'bodyleft'><ul>";
            if($search->rowCount() == 0){
                echo "<h2>NOT FOUND!</h2>";
            }
            else
            {
                while($row = $search->fetch()):
                    $pet_center_id = $row['pet_center_id'];
                    $current_user = $_SESSION['pet_center_name'];

                    $view_user = $con->query("SELECT * FROM pet_center_tbl");
                    $view_user->setFetchMode(PDO:: FETCH_ASSOC);
                    $view_user->execute();
                    
                    $row_user = $view_user->fetch();
                    $pet_center_name = $row_user['pet_center_name'];
                    
                    if($current_user == $pet_center_name)
                    {
                        $service_id = $row['service_id'];
                        $user_id = $row['user_id'];
                        $coupon_code = $row['coupon_code'];
                        $transaction_code = $row['transaction_code'];
                        $date_confirmed = $row['date_confirmed'];
                        $amount = $row['amount'];
        
                        $view_service = $con->prepare("SELECT * FROM services WHERE service_id = '$service_id'");
                        $view_service->setFetchMode(PDO:: FETCH_ASSOC);
                        $view_service->execute();
        
                        $row_service = $view_service->fetch();
                        $service_name = $row_service['services_name'];
        
        
                        $view_user = $con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
                        $view_user->setFetchMode(PDO:: FETCH_ASSOC);
                        $view_user->execute();
        
                        $row_user = $view_user->fetch();
                        $user_username = $row_user['user_username'];
        
                        echo
                        "<tr>
                            <td>".$service_name."</td>
                            <td>".$user_username."</td>
                            <td>".$coupon_code."</td>
                            <td>".$transaction_code."</td>
                            <td>".$date_confirmed."</td>
                            <td>".$amount."</td>
                        </tr>";
                    }
                    
                endwhile;
            }
        }
    }


    

    

?>