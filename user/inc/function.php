<?php
    session_start();

    function signUp()
    {
        include("inc/db.php");
        
        echo "<div id ='signUpForm'>
        <div class='signUpForm'>
            <h3>Registration</h3>
                <form method = 'POST' enctype = 'multipart/form-data'>
                    <table>
                        <tr>
                            <td>Name: </td>
                            <td><input type='text' name = 'user_username' required/></td>
                        </tr>
                        <tr>
                            <td>Password: </td>
                            <td><input type='text' name =  'user_password' required/></td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td><input type='text' name =  'user_email' required/></td>
                        </tr>
                        <tr>
                            <td>Municipality: </td>
                            <td><input type='text' name =  'municipality' required/></td>
                        </tr>
                        <tr>
                            <td>Barangay: </td>
                            <td><input type='text' name =  'barangay' required/></td>
                        </tr>
                        <tr>
                            <td>Full Address: </td>
                            <td><input type='text' name =  'address' required/></td>
                        </tr>
                        <tr>
                            <td>Contact Number: </td>
                            <td><input type='text' name =  'user_contactnumber' required/></td>
                        </tr>
                        <tr>
                            <td>Photo: </td>
                            <td><input type='file' name =  'user_profilephoto' required/></td>
                        </tr>
                    </table>
                    <button name = 'add_user'>Register</button>
                </form>
            </div>
        </div>";
        
        if(isset($_POST['add_user']))
        {
            $user_username = $_POST['user_username'];
            $user_password = $_POST['user_password'];
            $user_email = $_POST['user_email'];
            $user_contactnumber = $_POST['user_contactnumber'];
            $municipality = $_POST['municipality'];
            $barangay = $_POST['barangay'];
            $full_address = $_POST['full_address'];

            $user_profilephoto = $_FILES['user_profilephoto']['name'];
            $user_profilephoto_tmp = $_FILES['user_profilephoto']['tmp_name'];
        
            move_uploaded_file($user_profilephoto_tmp,"../uploads/user_profile/$user_profilephoto");

            $add_user = $con->prepare("INSERT INTO users_table(
                user_username,
                user_password,
                user_email,
                user_contactnumber,
                municipality,
                barangay,
                full_address,
                user_profilephoto
            ) 
            VALUES (
                '$user_username',
                '$user_password',
                '$user_email',
                '$user_contactnumber',
                '$municipality',
                '$barangay',
                '$full_address',
                '$user_profilephoto'
            )");

            if($add_user->execute())
            {
                echo "<script>alert('Registration Successfull!');</script>"; 
            }
            else
            {
                echo "<script>alert('Registration Unsuccessfull!');</script>";
            }
        }
    }

    function LogIn()
    {
        include("inc/db.php");
        if(isset($_POST['login_user']))
        {
            $user_username = $_POST['user_username'];
            $user_password = $_POST['user_password'];

            $fetchuser = $con->prepare("SELECT * FROM users_table WHERE user_username = '$user_username' AND user_password = '$user_password'");
            $fetchuser->setFetchMode(PDO:: FETCH_ASSOC);
            $fetchuser->execute();
            $countUser = $fetchuser->rowCount();

            $row = $fetchuser->fetch();
            $user_role = $row['user_type'];
            if($countUser>0)
            {
                $_SESSION['user_username'] = $_POST['user_username'];
                echo "<script>window.open('index.php?login_user=".$_SESSION['user_username']."','_self');</script>";
            }
            else
            {
                echo "<script>alert('Username or Password is incorrect!');</script>";
            }
        }
    }

    
    function myProfile()
    {
        include("inc/db.php");
        if(isset($_SESSION['user_username']))
        {
            $user_id = $_SESSION['user_username'];
            $fetch_user_username = $con->prepare("SELECT * FROM users_table WHERE user_username = '$user_id'");
            $fetch_user_username->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_user_username->execute();
    
            $row = $fetch_user_username->fetch();
            $id = $row['user_id'];
    
            echo 
            "<form method = 'POST' enctype='multipart/form-data'>
                <div class='profileTable'>
                <div class = 'photo'>
                    <img src = '../uploads/userIcon.svg'  />
                    <input type = 'file' name = 'user_profilephoto' class = 'fileUpload' />
                </div>
                <p class='name'>User's Name</p>
                <div class = 'contf'>
                <div class='formt'>
                    <div class='username'>
                        <p class='us'>username </p>
                        <input class='user_name'type = 'text' name =  'user_username' value = '".$row['user_username']."' />
                    </div>
                    <div class='username'>
                        <p class = 'us'>password </p>
                        <input class='user_name' type = 'password' name = 'user_password' value = '".$row['user_password']."' />
                    </div>
                    <div class = 'username'>
                        <p class='us'>email </p>
                        <input class='user_name' type = 'email' name = 'user_email' value = '".$row['user_email']."' />
                    </div>
                    <div class = 'username'>
                        <p class = 'us'>Contact Number: </p>
                        <input  class = 'user_name 'type = 'text' name = 'user_contactnumber' value = '".$row['user_contactnumber']."' />
                    </div>
                    <div class = 'usernameb'>
                        <button name = 'update_user'>Update Profile</button>
                    </div>
                    <div class = 'usernameh'>
                        <button class = 'back' onclick='window.location.href='/Pet/user/index.php'>Back to Home</button>
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
                $user_username = $_POST['user_username'];
                $user_password =  $_POST['user_password'];
                $user_contactnumber = $_POST['user_contactnumber'];
                $user_email = $_POST['user_email'];
                $user_profilephoto = $_POST['user_profilephoto'];
    
                $update_user = $con->prepare("UPDATE users_table 
                SET 
                    user_username='$user_username',
                    user_password = '$user_password',
                    user_contactnumber = '$user_contactnumber',
                    user_email = '$user_email',
                    user_profilephoto = '$user_profilephoto'
                WHERE 
                    user_id = '$id'");
    
                if($update_user->execute())
                {
                    echo "<script>alert('Your Information Successfully Updated!');</script>";
                    echo "<script>window.open('index.php?login_user=".$_SESSION['user_username']."', '_self');</script>";
                }
            }
        }
    }

    function getIp() 
    {
        $ip = $_SERVER['REMOTE_ADDR'];

        if(!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $ip;
    }

    function add_cart()
    {
        if(isset($_POST['cart_btn']))
        {
            array_push( $_SESSION['cart'], $_POST['pro_id']);
            echo "<script>window.open('/Pet/user/index.php?' ,'_self');</script>";  
        }
       
    }
    
    function cart_display()
    {   
        $net_total = "0";
        if(!empty($_SESSION['cart']))
        {
            include("inc/db.php");
            if(!isset($_SESSION['qty_array']))
            {
                $_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
            }
            $display_cart = $con->prepare("SELECT * FROM product_tbl WHERE pro_id IN (".implode(',',$_SESSION['cart']).")");
            $display_cart->setFetchMode(PDO:: FETCH_ASSOC);
            $display_cart->execute();
            
            echo "<table cellpadding='0' cellspacing = '0'>
                             <tr class='headerTitle'>
                                 <th style='width:10%'>Image</th>
                                 <th style='width:30%'>Product Name</th>
                                 <th>Quantity</th>
                                 <th>Price</th>
                                 <th>Sub Total</th>
                                 <th>Remove</th>
                             </tr>";
            while($row_pro = $display_cart->fetch()):
                echo "<form method = 'GET' action = '/Pet/user/update_cart_qty.php' enctype = 'multipart/form-data'>
                        <tr class ='data'>
                            <td>
                            <img class = 'cartDisplayImage' src = '../uploads/products/".$row_pro['pro_img']."' />
                            </td>
                            <td class = 'productNem'>
                               <p> ".$row_pro['pro_name']."</p>
                            </td>
                            <td>
                                <input type = 'number'  class = 'quantity' name = 'pro_quantity' value = '".array_count_values($_SESSION['cart'])[$row_pro['pro_id']]."' min = '1' max = '100
                                '/>
                                <input type = 'hidden' value = '".$row_pro['pro_id']."' name = 'pro_id'/>
                                <button id = 'pro_btn'>Update</button>
                            </td>
                            
                            <td  class = 'price'>
                                ".$row_pro['pro_price']."
                            </td>
                            <td class = 'sub_total'>";
                                $qty = array_count_values($_SESSION['cart'])[$row_pro['pro_id']];
                                $pro_price = $row_pro['pro_price'];
                                $sub_total = $qty * $pro_price;
                                echo $sub_total;
                                $net_total = $net_total + $sub_total;

                            echo "</td></form>
                           
                            <form method = 'GET' action = '/Pet/user/delete_cart.php' enctype = 'multipart/form-data'>
                            <td>
                            <input type = 'hidden' value = '".$row_pro['pro_id']."' name = 'delete' />
                            <button id = 'pro_btndelete'><img src = '../uploads/delete 1.svg' class='delete'></button></a>
                            </td>
                            </form>    
                        </tr>
                    </form>";

            endwhile;


            echo 
            "<tr style='height: 70px; box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);background:#F5F2E7; '>
                <td colspan = '4' style='border: none;'></td>
                <td style='color:#444; border: none;'>
                    Total Amount: ".$net_total."
                        <input type = 'hidden' name = 'totalprice' value = ".$net_total." />
                    </td>
                    <td style='border: none;'>
                    <a href = 'checkout.php' id = 'pro_btn' style='width: 90%;margin-top: 15px;' name = 'place_order'>Place Order</a>
                </td>
            </tr>";

                 if(isset($_GET['orders']))
                 {
                     include("checkout.php");
                 }
        }
        else
        {
            echo "
            <div class='emptyCart'>
            <img src = '../uploads/empty.svg' class = 'emptyImage'>
                <td>
                    <p id = 'cartText'><center>Your cart is empty!</p>
                 </td>
                 </br>
                 <td>
                    <a id = 'linkEmpty'href='/Pet/user/index.php'>Click Here to Buy a Product from our Store!</a>
                 </td>
            </div>";
        }
    }

    function view_orders()
    {
        include("inc/db.php");
        
        if(isset($_GET['user_id']))
        {
            $uID = $_GET['user_id'];

            $get_name = $con->prepare("SELECT * FROM users_table WHERE user_id = '$uID'");
            $get_name->setFetchMode(PDO:: FETCH_ASSOC);
            $get_name->execute();
            $row_get_user_id = $get_name->fetch();

            $userID = $row_get_user_id['user_id'];
            $display_order = $con->prepare("SELECT * FROM orders_tbl WHERE user_id = '$userID'");
            $display_order->setFetchMode(PDO:: FETCH_ASSOC);
            $display_order->execute();
            

            $net_total = 0;
           
            while($row = $display_order->fetch()):
                $pro_id = $row['pro_id'];
                $display_prod = $con->prepare("SELECT * FROM product_tbl WHERE pro_id = '$pro_id'");
                $display_prod->setFetchMode(PDO:: FETCH_ASSOC);
                $display_prod->execute();
                $row_get_prod_id = $display_prod->fetch();

                $qty = $row['qty'];
                $pro_price = $row_get_prod_id['pro_price'];
                $sub_total = $qty * $pro_price;

                echo 
                "<tr>
                    <td>".$row_get_prod_id['pro_name']."</td>
                    <td>".$row['qty']."</td>
                    <td>".$row['delivery_status']."</td>
                    <td><a href = 'cancel_order.php?cancel_order=".$row['order_id']."'>CANCEL</a></td>
                </tr>";
                $net_total = $net_total + $sub_total;
            endwhile;
            echo 
            "<tr>
                <td>TOTAL AMOUNT: ".$net_total."</td>
            </tr>";
        }    
    }

    function cancel_order()
    {
        include("inc/db.php");
        if(isset($_GET['cancel_order']))
        {
            $ordID = $_GET['cancel_order'];
            $query = $con->prepare("SELECT * FROM orders_tbl WHERE order_id = '$ordID'");
            $query->setFetchMode(PDO:: FETCH_ASSOC);
            $query->execute();

            $row = $query->fetch();
            if($row['delivery_status'] == "FOR DELIVERY")
            {
                echo "<script>alert('YOUR ORDER IS FOR DELIVERY, UNABLE TO CANCEL');</script>";
                echo "<script>window.open('view_order.php?user_id=".$row['user_id']."','_self');</script>";
            }
            elseif($row['delivery_status'] == "CONFIRMED")
            {
                echo "<script>alert('YOUR ORDER IS ALREADY CONFIRMED!');</script>";
                echo "<script>window.open('view_order.php?user_id=".$row['user_id']."','_self');</script>";
            }
            else
            {
                $del_query = $con->prepare("DELETE FROM orders_tbl WHERE order_id = '$ordID'");
                if($del_query->execute())
                {
                    echo "<script>alert('Item Removed Successfully!');</script>";
                    echo "<script>window.open('view_order.php?user_id=".$row['user_id']."','_self');</script>";
                }
            }
        }
    }

    function viewall_transactions()
    {
        include("inc/db.php");
        
        if(isset($_GET['user_id']))
        {
            $uID = $_GET['user_id'];

            $get_name = $con->prepare("SELECT * FROM users_table WHERE user_id = '$uID'");
            $get_name->setFetchMode(PDO:: FETCH_ASSOC);
            $get_name->execute();
            $row_get_user_id = $get_name->fetch();

            $userID = $row_get_user_id['user_id'];
            $display_order = $con->prepare("SELECT * FROM delivery_tbl WHERE user_id = '$userID'");
            $display_order->setFetchMode(PDO:: FETCH_ASSOC);
            $display_order->execute();
            
            while($row = $display_order->fetch()):
                $order_id = $row['order_id'];

                $my_orders = $con->prepare("SELECT * FROM orders_tbl WHERE order_id = '$order_id'");
                $my_orders->setFetchMode(PDO:: FETCH_ASSOC);
                $my_orders->execute();
    
                $row2 = $my_orders->fetch();
                $pro_id = $row2['pro_id'];
    
                $product_order = $con->prepare("SELECT * FROM product_tbl WHERE pro_id = '$pro_id'");
                $product_order->setFetchMode(PDO:: FETCH_ASSOC);
                $product_order->execute();
    
                $row3 = $product_order->fetch();
                $pro_name = $row3['pro_name'];

                echo 
                "<tr>
                    <td>".$pro_name."</td>
                    <td>".$row['qty']."</td>
                    <td>".$row['total_amount']."</td>
                    <td>".$row['date_delivered']."</td>
                </tr>";
            endwhile;
        
        }    
    }

    function viewall_org()
    {
        include("inc/db.php");
        $fetch_orgs=$con->prepare("SELECT * from organizations");
        $fetch_orgs->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_orgs->execute();
                            
        while($row=$fetch_orgs->fetch()):
            echo "<option value = '".$row['id']."'>".$row['org_name']."</option>";
        endwhile;
    }

    function donate()
    {
        include("inc/db.php");
        
        echo "<div id ='signUpForm'>
        <div class='signUpForm'>
            <h3>Donate</h3>
                <form method = 'POST' enctype = 'multipart/form-data'>
                    <table>
                        <tr>
                            <td>Transaction Number: </td>
                            <td><input type='text' name = 'transaction_number' required/></td>
                        </tr>
                        <tr>
                            <td>Select Organization Name </td>
                            <td>
                                <select name = 'org_name'>";
                                    echo viewall_org();
                                echo "<select>
                            </td>
                        </tr>
                        <tr>
                            <td>First Name: </td>
                            <td><input type='text' name =  'first_name' required/></td>
                        </tr>
                        <tr>
                            <td>Last Name: </td>
                            <td><input type='text' name =  'last_name' required/></td>
                        </tr>
                        <tr>
                            <td>Suffix: </td>
                            <td>
                                <select name = 'suffix'>
                                    <option name = 'jr'>jr</option>
                                    <option name = 'sr'>sr</option>
                                    <option name = 'N/A'>N/A</option>
                                </select><label style = 'color:red'>*SELECT N/A IF YOU DON'T HAVE ANY SUFFIX<label>
                            </td>
                        </tr>
                        <tr>
                            <td>Email Address: </td>
                            <td><input type = 'email' name = 'email_address' required/></td>
                        </tr>
                        <tr>
                            <td>Contact Number: </td>
                            <td><input type='text' name =  'contact_number' required/></td>
                        </tr>
                         <tr>
                            <td>Proof of Payment: </td>
                            <td><input type='file' name =  'proof_photo' required/></td>
                        </tr>
                    </table>
                    <button name = 'donate'>Donate!</button>
                </form>
            </div>
        </div>";
        if(isset($_POST['donate']))
        {
            $transaction_number = $_POST['transaction_number'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $suffix = $_POST['suffix'];
            $contact_number = $_POST['contact_number'];
            $org_name = $_POST['org_name'];
            $email_address = $_POST['email_address'];
            // $coupon_code = $_POST['coupon_code'];

            // <tr>
            //                 <td><input type = 'hidden' name = 'coupon_code' value = "; echo generateRandomString(); echo ">";
            //                 echo "</td>
            //             </tr>

            // $reciever = $_POST['email_address'];
            // $subject = "Coupon Code";
            // $body = "Thanks for donating, as a gratitude of kindess we will give you a coupon code that will use as a discount to avail discount to the selected services. Your Coupon Code: $coupon_code";
            // $sender = "ianjohn0101@gmail.com";

            $proof_photo = $_FILES['proof_photo']['name'];
            $proof_photo_tmp = $_FILES['proof_photo']['tmp_name'];
        
            move_uploaded_file($proof_photo_tmp,"../uploads/donations/$proof_photo");

            // if(mail($reciever, $subject, $body, $sender))
            // {
                
            // }
            $add_donation = $con->prepare("INSERT INTO donations SET
                            'transaction_number' = $transaction_number,
                            'first_name' = $first_name,
                            'last_name' = $last_name,
                            'suffix' = $suffix,
                            'contact_number' = $contact_number,
                            'org_name' = $org_name,
                            'coupon_code' = '',
                            'email_address' = $email_address,
                            'proof_photo' = $proof_photo

            )");

            if($add_donation->execute())
            {
                echo "SUCCESSFUL"; 
            }
            else
            {
                echo "UNSUCCESSFUL";
            }
        }
    }

    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    function dog_food_products()
    {
        include("inc/db.php");

        $fetch_cat = $con->prepare("SELECT * FROM pet_prod WHERE prod_id='1'");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();

        $row_cat=$fetch_cat->fetch();
        $cat_id = $row_cat['prod_id'];
        echo"<h3>".$row_cat['cat_name']."</h3>";

        $fetch_pro = $con->prepare("select * from product_tbl where cat_id='$cat_id' LIMIT 0,3");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        while($row_pro = $fetch_pro->fetch()):
            echo"
            
                <li>
                    <form method = 'post' enctype='multipart/form-data'>
                    <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                        <h4>".$row_pro['pro_name']."</h4>
                        <img src ='../uploads/products/".$row_pro['pro_img']."' />
                        <center>
                            <button id = 'pro_btnView'>
                                <a href = 'pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a>
                            </button>
                            <input type = 'hidden' value = '".$row_pro['pro_id']."' name = 'pro_id' />
                            <button id = 'pro_btn' name = 'cart_btn'>
                            Cart
                            </button>
                           
                        </center>
                    </a>
                    </form>
                </li>
            
                ";
        endwhile;
    }

    function view_all_pets()
    {
        include("inc/db.php");

        echo "<a href = 'add_pet.php'>Add Your Own Pet</a>";
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

            echo
            "<li>
                <form method = 'post' action = 'submit_entries.php' enctype='multipart/form-data'>
                <a>
                    <img src ='../uploads/pets/".$row['pet_photo']."' />
                    <center>
                    <p>".$user_username.":".$row['pet_details']."</p>
                        <button id = 'pro_btn' name = 'like' value = ".$row['id'].">
                        Like 👍 (".$likes.")";
                        echo "</button>
                    </center>
                    <div>
                        Comment: <input type = 'text' name = 'comment' placeholder = 'Write A Comment' />
                        <button name = 'submit' value = ".$row['id'].">Submit</button>
                    </div>
                </a>";
                $comment = $con->prepare("SELECT * FROM comment_tbl WHERE pet_id = '$pet_id'");
                $comment->setFetchMode(PDO:: FETCH_ASSOC);
                $comment->execute();
                while($row_comment = $comment->fetch()):
                    $user_id = $row_comment['user_id'];
            
                    $user = $con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
                    $user->setFetchMode(PDO:: FETCH_ASSOC);
                    $user->execute();
    
                    $row_user = $user->fetch();
                    echo "<img class='profileImg' src = '../uploads/user_profile/".$row_user['user_profilephoto']."'>:".$row_comment['comment']."";
                    
                endwhile;
                echo"</form>
            </li>";
        endwhile;
        
    }

    function fish_food_products()
    {
        include("inc/db.php");

        $fetch_cat = $con->prepare("SELECT * FROM pet_prod WHERE prod_id='4' LIMIT 0,3");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();

        $row_cat=$fetch_cat->fetch();
        $cat_id = $row_cat['prod_id'];
        echo"<h3>".$row_cat['cat_name']."</h3>";

        $fetch_pro = $con->prepare("select * from product_tbl where cat_id='$cat_id'");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        while($row_pro = $fetch_pro->fetch()):
            echo"
                <li>
                    <form method = 'post' enctype='multipart/form-data'>
                    <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                        <h4>".$row_pro['pro_name']."</h4>
                        <img src ='/uploads/products/".$row_pro['pro_img']."' />
                        <center>
                            <button id = 'pro_btn'>
                                <a href = 'pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a>
                            </button>
                            <input type = 'hidden' value = '".$row_pro['pro_id']."' name = 'pro_id' />
                            <button id = 'pro_btn' name = 'cart_btn'>Cart
                            </button>
                            
                        </center>
                    </a>
                    </form>
                </li>
                ";
        endwhile;
    }

    function pro_details()
    {
        include("inc/db.php");

        if(isset($_GET['pro_id']))
        {
            $pro_id = $_GET['pro_id'];
            $pro_fetch=$con->prepare("SELECT * FROM product_tbl WHERE pro_id = '$pro_id'");
            $pro_fetch->setFetchMode(PDO:: FETCH_ASSOC);
            $pro_fetch->execute();

            $row_pro = $pro_fetch->fetch();
            $cat_id = $row_pro['cat_id'];
            echo 
                "<div id = 'pro_img'>
                    <img src ='../uploads/products/".$row_pro['pro_img']."'/>
                    <ul>
                        <li>
                            <img src ='../uploads/products/".$row_pro['pro_img']."'/>
                        </li>
                        <li>
                            <img src ='../uploads/products/".$row_pro['pro_img2']."'/>
                        </li>
                        <li>
                            <img src ='../uploads/products/".$row_pro['pro_img3']."'/>
                        </li>
                        <li>
                            <img src ='../uploads/products/".$row_pro['pro_img4']."'/>
                        </li>
                    </ul>
                  </div>
                  <div id = 'pro_brand'>
                    <h3>".$row_pro['pro_name']."</h3>
                    <ul>
                        <li>
                            
                        </li>
                    </ul>
                    <ul>

                    </ul><br clear = 'all'>
                    <center>
                        <h4>Price: ".$row_pro['pro_price']."</h4>
                        <form method = 'POST'>
                            <input type = 'hidden' value = '".$row_pro['pro_id']."' name = 'pro_id' />
                            <button name = 'buy_now' id = 'buy_now' style = color:#000>Buy Now</button>
                            <button name = 'cart_btn'>Add to Cart</button>
                        </form>
                    </center>
                </div><br clear = 'all'>    
                <div id = 'sim_pro'>
                    <h3>Related Products</h3>
                    <ul>";
                        echo add_cart();
                        $sim_pro = $con->prepare("SELECT * from product_tbl WHERE pro_id!=$pro_id AND cat_id='$cat_id' LIMIT 0,5");
                        $sim_pro->setFetchMode(PDO:: FETCH_ASSOC);
                        $sim_pro->execute();

                        while($row=$sim_pro->fetch()):
                            echo "<li>
                                    <a href = 'pro_detail.php?pro_id=".$row['pro_id']."'>
                                        <img src ='../uploads/products/".$row['pro_img']."'/>
                                        <p>Product Name: ".$row['pro_name']."</p>
                                        <p>Price: ".$row['pro_price']."</p>
                                    </a>
                                  </li>";
                        endwhile;
                    echo "</ul>";
                "</div>";
            ;            
        }
    }
    function service_detail()
    {
        include("inc/db.php");

        if(isset($_GET['cat_id']))
        {
            $pro_id = $_GET['cat_id'];
            $pro_fetch=$con->prepare("SELECT * FROM services WHERE service_id = '$pro_id'");
            $pro_fetch->setFetchMode(PDO:: FETCH_ASSOC);
            $pro_fetch->execute();

            $row_pro = $pro_fetch->fetch();
            $cat_id = $row_pro['service_id'];
            $day_open = $row_pro['day_open'];
            $day_close = $row_pro['day_close'];

            $query = $con->prepare("SELECT * FROM daysweek WHERE id = '$day_open'");
            $query->setFetchMode(PDO:: FETCH_ASSOC);
            $query->execute();

            $row = $query->fetch();

            $query = $con->prepare("SELECT * FROM daysweek WHERE id = '$day_close'");
            $query->setFetchMode(PDO:: FETCH_ASSOC);
            $query->execute();

            $row2 = $query->fetch();
            

            echo 
                "<div id = 'pro_img'>
                    <img src ='../uploads/user_profile/".$row_pro['service_photo']."'/>
                </div><br><br><br><br>
                <div>
                    Service Name: ".$row_pro['services_name']."
                </div>
                <div>
                    Time Open: ".$row_pro['time_open']."
                </div>
                <div>
                    Time Close: ".$row_pro['time_close']."
                </div>
                <div>
                    Day Open From: ".$row['days']." To: ".$row2['days']."
                </div>
                <div>
                    Service Cost: P".$row_pro['service_cost']."
                </div>";
            echo "<a href = 'avail_service.php?avail_service=".$row_pro['service_id']."'><button>Reserve Service</button></a>";
        }
    }

    function all_cat() 
    {
        include("inc/db.php");
        $all_cat = $con->prepare("SELECT * FROM pet_prod");
        $all_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $all_cat->execute();

        while($row=$all_cat->fetch()):
            echo "<li>
                    <a href = 'cat_detail.php?cat_id=".$row['prod_id']."'>
                        ".$row['cat_name']."
                    </a>
                  </li>";
        endwhile;
    }

    function viewall_cat() 
    {
        include("inc/db.php");
        $all_cat = $con->prepare("SELECT * FROM service_cat");
        $all_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $all_cat->execute();

        while($row=$all_cat->fetch()):
            echo "<li>
                    <a href = 'service_cat_detail.php?cat_id=".$row['cat_id']."'>
                        ".$row['cat_name']."
                    </a>
                  </li>";
        endwhile;
    }

    function all_services()
    {
        include("inc/db.php");
        $all_services = $con->prepare("SELECT * FROM services");
        $all_services->setFetchMode(PDO:: FETCH_ASSOC);
        $all_services->execute();

        while($row=$all_services->fetch()):
            echo "<li>
                    <a href = 'services_detail.php?service_id=".$row['service_id']."'>
                        ".$row['services_name']."
                    </a>
                  </li>";
        endwhile;
    }

    

    function cat_detail()
    {
        include("inc/db.php");

        if(isset($_GET['cat_id']))
        {
            $cat_id = $_GET['cat_id'];
            $cat_pro = $con->prepare("SELECT * FROM product_tbl where cat_id = '$cat_id'");
            $cat_pro->setFetchMode(PDO:: FETCH_ASSOC);
            $cat_pro->execute();
            
            $fetch_cat_name = $con->prepare("SELECT * FROM pet_prod WHERE prod_id='$cat_id'");
            $fetch_cat_name->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_cat_name->execute();
    
            $row_cat=$fetch_cat_name->fetch();
            $cat_id = $row_cat['prod_id'];
            echo"<h3>".$row_cat['cat_name']."</h3>";

            while($row_cat = $cat_pro->fetch()):
                echo"
                    <li>
                        <a href='pro_detail.php?pro_id=".$row_cat['pro_id']."'>
                            <h4>".$row_cat['pro_name']."</h4>
                            <img src ='../uploads/products/".$row_cat['pro_img']."' />
                            <center>
                                <button id = 'pro_btnView'>
                                    <a href = 'pro_detail.php?pro_id=".$row_cat['pro_id']."'>View</a>
                                </button>
                                <input type = 'hidden' value = '".$row_cat['pro_id']."' name = 'pro_id' />
                                <button id = 'pro_btn' name = 'cart_btn'>Cart
                                </button>
                                
                            </center>
                        </a>
                    </li>
                    ";
            endwhile;
        }
    }
    function service_cat_detail()
    {
        include("inc/db.php");

        if(isset($_GET['cat_id']))
        {
            //service_cat
            $cat_id = $_GET['cat_id'];
            $cat_pro = $con->prepare("SELECT * FROM services where service_id = '$cat_id'");
            $cat_pro->setFetchMode(PDO:: FETCH_ASSOC);
            $cat_pro->execute();
            
            //services
            $fetch_cat_name = $con->prepare("SELECT * FROM service_cat WHERE cat_id='$cat_id'");
            $fetch_cat_name->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_cat_name->execute();
    
            $row_cat=$fetch_cat_name->fetch();
            $cat_id = $row_cat['cat_id'];
            echo"<h3>".$row_cat['cat_name']."</h3>";

            while($row_cat = $cat_pro->fetch()):
                echo"
                    <li>
                        <a href='service_detail.php?cat_id=".$row_cat['service_id']."'>
                            <h4>".$row_cat['services_name']."</h4>
                            <img src ='../uploads/user_profile/".$row_cat['service_photo']."' />
                            <center>
                                <button id = 'pro_btn'>
                                    <a href = 'services_detail.php?cat_id=".$row_cat['service_id']."'>View</a>
                                </button>
                            </center>
                        </a>
                    </li>
                    ";
            endwhile;
        }
    }


    function search() {
        include("inc/db.php");

        if(isset($_GET['search']) && isset($_GET['user_query']))
        {
            $user_query = $_GET['user_query'];
            $search = $con->prepare("SELECT * from product_tbl WHERE pro_name LIKE '%$user_query%' or pro_keyword LIKE '%$user_query%'");
            $search->setFetchMode(PDO:: FETCH_ASSOC);
            $search->execute();

            echo "<div id = 'bodyleft'><ul>";
            if($search->rowCount() == 0){
                echo "<h2>Product Not Found</h2>";
            }
            else
            {
                while($row=$search->fetch()):
                    echo"
                    </br>
                        <li>
                            <a href='pro_detail.php?pro_id=".$row['pro_id']."'>
                                <h4>".$row['pro_name']."</h4>
                                <img src ='./uploads/products/".$row['pro_img']."' />
                                <center>
                                <button id = 'pro_btnView'>
                                <a href = 'pro_detail.php?pro_id=".$row['pro_id']."'>View</a>
                            </button>
                             </center>
                            </a>
                        </li>
                        ";
                endwhile;
            }
            echo "</ul></div>";
        }
    }
?>



