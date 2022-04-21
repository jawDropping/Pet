<?php
    session_start();

    function signUp()
    {
        include("inc/db.php");
        
        
        if(isset($_POST['add_user']))
        {
            $user_username = $_POST['user_username'];
            $user_password = $_POST['user_password'];
            $user_email = $_POST['user_email'];
            $user_contactnumber = $_POST['user_contactnumber'];
            $municipality = $_POST['municipality'];
            $barangay = $_POST['barangay'];
            $user_address = $_POST['user_address'];

            $view_emails = $con->prepare("SELECT * FROM users_table");
            $view_emails->setFetchMode(PDO:: FETCH_ASSOC);
            $view_emails->execute();

            $row = $view_emails->fetch();
            $email = $row['user_email'];
            if($email == $user_email)
            {
               echo "Email already existed!";
            }
            else
            {
                if(strlen($user_password) >= 8 &&
                preg_match('/[A-Z]/', $user_password) > 0 &&
                preg_match('/[a-z]/', $user_password) > 0)
                {
                    $add_user = $con->prepare("INSERT INTO users_table(
                        user_username,
                        user_email,
                        user_contactnumber,
                        user_password,
                        municipality,
                        barangay,
                        user_address,
                        user_profilephoto
                    ) 
                    VALUES (
                        '$user_username',
                        '$user_email',
                        '$user_contactnumber',
                        '$user_password',
                        '$municipality',
                        '$barangay',
                        '$user_address',
                        'userIcon.svg'
                    )");
        
                    if($add_user->execute())
                    {
                        echo "<script>alert('Registration Successfull!');</script>"; 
                        echo "<script>
                        if ( window.history.replaceState ) {
                           window.history.replaceState( null, null, window.location.href );
                       }            
                        </script>";
                    }
                    else
                    {
                        echo "<script>alert('Registration Unsuccessfull!');</script>";
                    }
                }
                else
                {
                    echo "Password must have 8 characters long, an uppercase and at least 1 special character!";
                }
            }
        }
    }

    function LogIn()
    {
        include("inc/db.php");
        if(isset($_POST['login_user']))
        {
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];

            $fetchuser = $con->prepare("SELECT * FROM users_table WHERE user_email = '$user_email' AND user_password = '$user_password'");
            $fetchuser->setFetchMode(PDO:: FETCH_ASSOC);
            $fetchuser->execute();

            $row = $fetchuser->fetch();
            $countUser = $fetchuser->rowCount();
            if($countUser>0)
            {
                $_SESSION['user_username'] = $row['user_username'];
                echo "<script>window.open('index.php?login_user=".$_SESSION['user_username']."','_self');</script>";
            }
            else
            {
                echo "<script>alert('Email or Password is incorrect!');</script>";
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
                    <img src = '../uploads/user_profile/".$row['user_profilephoto']."' />
                    <input type = 'file' name = 'user_profilephoto' class = 'fileUpload' value = '".$row['user_profilephoto']."' required />
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
                        <button class = 'back'><a href = 'index.php'>Back to Home</a></button>
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
             
                $user_profilephoto = $_FILES['user_profilephoto']['name'];
                $user_profilephoto_tmp = $_FILES['user_profilephoto']['tmp_name'];

                move_uploaded_file($user_profilephoto_tmp,"..uploads/user_profile/$user_profilephoto");
    
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
                    <a href = 'checkout.php' id = 'pro_btn' style='text-decoration:none; padding: 5px; width: 90%;margin-top: 15px;' name = 'place_order'>Place Order</a>
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

            $user_id = $row_get_user_id['user_id'];

            $net_total = 0;
            $display_prod = $con->prepare("SELECT p.pro_id, p.pro_name, SUM(o.qty), o.delivery_status, o.user_id from orders_tbl o join product_tbl p on o.pro_id = p.pro_id where o.user_id = '$user_id' group by p.pro_id, p.pro_name, o.delivery_status");
            $display_prod->setFetchMode(PDO:: FETCH_ASSOC);
            $display_prod->execute();
            while($row = $display_prod->fetch()):
              
                $prod_id = $row['pro_id'];

                $prod_name = $con->prepare("SELECT * FROM orders_tbl WHERE pro_id = '$prod_id'");
                $prod_name->setFetchMode(PDO:: FETCH_ASSOC);
                $prod_name->execute();
                $row_prod = $prod_name->fetch();

                $order_id = $row_prod['order_id'];
                $pro_id = $row_prod['pro_id'];
                

                $display_prods = $con->prepare("SELECT * FROM product_tbl WHERE pro_id = '$pro_id'");
                $display_prods->setFetchMode(PDO:: FETCH_ASSOC);
                $display_prods->execute();
                $row_get_prod_id = $display_prods->fetch();

                $qty = $row['SUM(o.qty)'];
                $pro_price = $row_get_prod_id['pro_price'];
                $sub_total = $qty * $pro_price;
                echo
                "
                    <div class = 'dataHolders'>
                    <p class = 'dataCont' >".$row_get_prod_id['pro_name']."</p>
                    </div>
                    <div class = 'dataHolder'>
                    <p class = 'dataCont'>".$row['SUM(o.qty)']."</p>
                    </div>
                    <div class = 'dataHolder'>
                    <p class = 'dataCont'>".$row_prod['delivery_status']."</p>
                    </div>
                    <div class = 'dataHolder'>
                    <p class = 'dataCont'><a class = 'dataLenk' href = 'cancel_order.php?cancel_order=".$row_prod['order_id']."'>Cancel</a></p>
                    </div>
                ";
                $net_total = $net_total + $sub_total;
              
               
            endwhile;
            echo 
            "<div></div><div></div><div></div>
            <div class = 'dataHolderTot'>
                <p class = 'dataCont'>TOTAL AMOUNT: ".$net_total."</p>
            </div>";
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
            $display_order = $con->prepare("SELECT * FROM delivered_items WHERE user_id = '$userID'");
            $display_order->setFetchMode(PDO:: FETCH_ASSOC);
            $display_order->execute();
            
            while($row = $display_order->fetch()):
                $pro_name = $row['pro_name'];
    
                $product_order = $con->prepare("SELECT * FROM product_tbl WHERE pro_name = '$pro_name'");
                $product_order->setFetchMode(PDO:: FETCH_ASSOC);
                $product_order->execute();
    
                $row3 = $product_order->fetch();
                $pro_name = $row3['pro_name'];

                echo 
                "<tr>
                    <td>".$pro_name."</td>
                    <td>".$row['qty']."</td>
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
        echo "<h3>Select Organization to Donate </h3>";
        include("inc/db.php");
        $sql = $con->prepare("SELECT * FROM organizations");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();

        while($row = $sql->fetch()):
            echo
            "<li>
            <form method = 'post' enctype='multipart/form-data'>
            <a href='org_detail.php?id=".$row['id']."'>
                <h4>".$row['org_name']."</h4>
                <img src ='../uploads/orgs/".$row['org_photo']."' />
                <center>
                    <button id = 'pro_btnView'>
                        <a href = 'org_detail.php?id=".$row['id']."'>Show Info</a>
                    </button>
                    <input type = 'hidden' value = '".$row['id']."' name = 'pro_id' />
                </center>
            </a>
            </form>
        </li>";
        endwhile;
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

    function org_detail()
    {
        include("inc/db.php");

        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $fetch_org=$con->prepare("SELECT * FROM organizations WHERE id = '$id'");
            $fetch_org->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_org->execute();

            $row_org = $fetch_org->fetch();
            echo 
                "<div id = 'pro_img'>
                    <img src ='../uploads/orgs/".$row_org['org_photo']."'/>
                    
                  </div>
                  <div id = 'pro_brand'>
                    <h3>".$row_org['org_name']."</h3>
                    <ul>
                        <li>
                            Org Location: ".$row_org['org_location']."
                        </li>
                        <li>
                        Org Contact Number: ".$row_org['org_contact_number']."
                       
                        </li>
                        <li>
                        Org Email Address: ".$row_org['org_email_address']."
                        </li>
                    </ul>
                    <a href = 'donate.php?donate=".$row_org['id']."'>Donate</a>
                </div>";          
        }
    }
    
    function featured_dog_food_products()
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
                            Add to Cart
                            </button>";
                            
                        //    echo add_cart();
                        echo"</center>
                    </a>
                    </form>
                </li>
            
                ";
        endwhile;
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

        $fetch_pro = $con->prepare("select * from product_tbl where cat_id='$cat_id'");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        while($row_pro = $fetch_pro->fetch()):
            echo"
            
                <li>
                    <form method = 'post' enctype='multipart/form-data'>
                    <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                        <img src ='../uploads/products/".$row_pro['pro_img']."' />
                        
                        <center>
                        <h4>".$row_pro['pro_name']."</h4>
                            <button id = 'pro_btnView'>
                                <a href = 'pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a>
                            </button>
                            <input type = 'hidden' value = '".$row_pro['pro_id']."' name = 'pro_id' />
                            <button name = 'cart_btn'>
                            Add to Cart
                            </button>";
                            
                        //    echo add_cart();
                        echo"</center>
                    </a>
                    </form>
                </li>
            
                ";
        endwhile;
    }

   

    function featured_fish_food_products()
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
                            <button name = 'cart_btn'>
                            Add to Cart
                            </button>";
                            
                            
                        echo"</center>
                    </a>
                    </form>
                </li>
                ";
        endwhile;
    }

    function fish_food_products()
    {
        include("inc/db.php");

        $fetch_cat = $con->prepare("SELECT * FROM pet_prod WHERE prod_id='4'");
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
                            <button name = 'cart_btn'>
                            Add to Cart
                            </button>";
                            
                            
                        echo"</center>
                    </a>
                    </form>
                </li>
                ";
        endwhile;
    }
    //wala pa
    function bird_food_products()
    {
        include("inc/db.php");

        $fetch_cat = $con->prepare("SELECT * FROM pet_prod WHERE prod_id='3' LIMIT 0,3");
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
                            <button name = 'cart_btn'>
                            Add to Cart
                            </button>";
                            
                        echo "</center>
                    </a>
                    </form>
                </li>
                ";
        endwhile;
    }

    //wala pa
    function cat_food_products()
    {
        include("inc/db.php");

        $fetch_cat = $con->prepare("SELECT * FROM pet_prod WHERE prod_id='2' LIMIT 0,3");
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
                        <img src ='../uploads/products/".$row_pro['pro_img']."' />
                        <center>
                            <button id = 'pro_btn'>
                                <a href = 'pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a>
                            </button>
                            <input type = 'hidden' value = '".$row_pro['pro_id']."' name = 'pro_id' />
                            <button name = 'cart_btn'>
                            Add to Cart
                            </button>";
                        echo "</center>
                    </a>
                    </form>
                </li>
                ";
        endwhile;
    }

    //wala pa
    function other_food_products()
    {
        include("inc/db.php");

        $fetch_cat = $con->prepare("SELECT * FROM pet_prod WHERE prod_id='5' LIMIT 0,3");
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
                            <button name = 'cart_btn'>
                            Add to Cart
                            </button>";
                          
                        echo"</center>
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
                        <li>";
                            if($row_pro['pro_quantity'] > 0)
                            {
                                echo "Availability: In Stock";
                                echo "<center>
                                <h4>Price: ".$row_pro['pro_price']."</h4>
                                <form method = 'POST'>
                                    <input type = 'hidden' value = '".$row_pro['pro_id']."' name = 'pro_id' />
                                    <button name = 'buy_now' id = 'buy_now' style = color:#000>Buy Now</button>
                                    <button name = 'cart_btn'>Add to Cart</button>
                                </form>
                            </center>";
                            }
                            else
                            {
                                echo "<label style = 'color:red'>NO STOCKS!</label>";
                            }
                        echo"</li>
                    </ul>
                    <ul>

                    </ul><br clear = 'all'>
                    
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
    function viewall_services()
    {
    
        include("inc/db.php");
        $sql = $con->prepare("SELECT * FROM services");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();

        while($row = $sql->fetch()):
            echo "<h3>Services Available </h3>";
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

    function service_info()
    {
        include("inc/db.php");
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $fetch_services=$con->prepare("SELECT * FROM services WHERE id = '$id'");
            $fetch_services->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_services->execute();

            $row_services = $fetch_services->fetch();
            $pet_center_id = $row_services['pet_center_id'];

            $query = $con->prepare("SELECT * FROM pet_center_tbl WHERE pet_center_id = '$pet_center_id'");
            $query->setFetchMode(PDO:: FETCH_ASSOC);
            $query->execute();

            $row_pet_center = $query->fetch();
            $pet_center_location = $row_pet_center['location'];
            $location = str_replace(" ", "+", $pet_center_location);

            $service_cat = $row_services['service_id'];

            $sql = $con->prepare("SELECT * FROM service_cat WHERE cat_id = '$service_cat'");
            $sql->setFetchMode(PDO:: FETCH_ASSOC);
            $sql->execute();

            $row = $sql->fetch();
            $cat_name = $row['cat_name'];

            $time_open = $row_services['time_open'];
            $time_close = $row_services['time_close'];
            $close_time = date('g:i A', strtotime($time_close));
            $open_time = date('g:i A', strtotime($time_open));
            echo 
                "<div id = 'pro_img'>
                    <img src ='../uploads/user_profile/".$row_services['service_photo']."'/>
                    
                  </div>
                  <div id = 'pro_brand'>
                    <h3>".$row_services['services_name']."</h3>
                    <ul>
                        <li>
                            Service Category: ".$cat_name."
                        </li>
                        <li>
                            Contact Number: ".$row_services['services_contact_number']."
                        </li>
                        <li>
                         Email Address: ".$row_services['services_email']."
                        </li>
                        <li>
                            Time Open: ".$open_time."
                        </li>
                        <li>
                            Time Close: ".$close_time."
                        </li>
                        <li>
                            Service Cost: ".$row_services['service_cost']."
                        </li>
                        <li>
                            <a href = 'avail_service.php?avail_service=".$row_services['id']."' style='margin: 20% 0% 0% 50%;text-decoration:none;color:#fff;background-color:#0000ff;padding:13px;border-radius:4px;font-size:14px;'>Avail Service</a>
                            <td><a href = 'review_service.php?review_service=".$row_services['id']."' style='text-decoration:none;color:#fff;background-color:#0000ff;padding:13px;border-radius:4px;font-size:14px;'>Give Feedback</a></td>
                        </li>
                        Location:
                        <iframe style = 'width:640px;height:500px;margin: 20px 20% 0% 0%;' src='https://maps.google.com/maps?q=".$location."&output=embed'></iframe>
                    </ul>
                </div>";   
                
            echo 
            "Services Feedbacks: ";
            $sql2 = $con->prepare("SELECT * FROM feedback_tbl WHERE service_id = '$id'");
            $sql2->setFetchMode(PDO:: FETCH_ASSOC);
            $sql2->execute();
            
            while($row_feedbacks = $sql2->fetch()):
                $user_id = $row_feedbacks['user_id'];

                $view_user = $con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
                $view_user->setFetchMode(PDO:: FETCH_ASSOC);
                $view_user->execute();

                while($row_user = $view_user->fetch()):
                    echo 
                    "<br><tr>
                        <td>".$row_user['user_username'].": ".$row_feedbacks['comment']."</td>
                    </tr>"; 
                endwhile;
            endwhile;
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
                    <a href = 'services_detail.php?id=".$row['id']."'>
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

            $search = $con->query("SELECT pro_name FROM product_tbl WHERE pro_name LIKE '%$user_query%' UNION SELECT services_name FROM services WHERE services_name LIKE '%$user_query%' UNION SELECT org_name FROM organizations WHERE org_name LIKE '%$user_query%'");
            $search->setFetchMode(PDO:: FETCH_ASSOC);
            $search->execute();

            echo "<div id = 'bodyleft'><ul>";
            if($search->rowCount() == 0){
                echo "<h2>NOT FOUND!</h2>";
            }
            else
            {
                while($row=$search->fetch()):
                    echo 
                    "</br>
                    <li>";
                    $name = $row['pro_name'];
                    $sql = $con->prepare("SELECT * FROM product_tbl");
                    $sql->setFetchMode(PDO:: FETCH_ASSOC);
                    $sql->execute();

                    $row_pro = $sql->fetch();
                    $pro_name = $row_pro['pro_name'];

                    $sql2 = $con->prepare("SELECT * FROM services");
                    $sql2->setFetchMode(PDO:: FETCH_ASSOC);
                    $sql2->execute();

                    $row_service = $sql2->fetch();
                    $services_name = $row_service['services_name'];

                    $sql3 = $con->prepare("SELECT * FROM organizations");
                    $sql3->setFetchMode(PDO:: FETCH_ASSOC);
                    $sql3->execute();

                    $row_org = $sql3->fetch();
                    $org_name = $row_org['org_name'];

                   
                    if($name == $pro_name)
                    {
                        echo
                        "<a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                        <h4>".$row_pro['pro_name']."</h4>
                        <img src ='../uploads/products/".$row_pro['pro_img']."' />
                        <center>
                            <button id = 'pro_btnView'>
                                <a href = 'pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a>
                            </button>
                            <input type = 'hidden' value = '".$row_pro['pro_id']."' name = 'pro_id' />
                            <button id = 'pro_btn' name = 'cart_btn'>Cart
                            </button>
                            
                        </center>
                    </a>";
                    }
                    elseif($name == $services_name)
                    {
                        echo 
                        "<a href='service_detail.php?cat_id=".$row_service['service_id']."'>
                            <h4>".$row_service['services_name']."</h4>
                            <img src ='../uploads/user_profile/".$row_service['service_photo']."' />
                                <center>
                                    <button id = 'pro_btn'>
                                        <a href = 'show_service_info.php?id=".$row_service['id']."'>Show Info</a>
                                    </button>
                                </center>
                            </a>
                        </li>";
                    }
                    elseif($name == $org_name)
                    {
                        echo
                        "<a href='org_detail.php?id=".$row_org['id']."'>
                            <h4>".$row_org['org_name']."</h4>
                            <img src ='../uploads/orgs/".$row_org['org_photo']."' />
                                <center>
                                    <button id = 'pro_btnView'>
                                        <a href = 'org_detail.php?id=".$row_org['id']."'>Show Info</a>
                                    </button>
                                </center>
                            </a>
                        </li>";
                    }
                endwhile;
                echo "</ul></div>";
            }
            echo "</ul></div>";
            // SELECT 
            // p.pro_id, 
            // p.pro_name, 
            // SUM(o.qty), 
            // o.delivery_status, 
            // o.user_id from orders_tbl 
            // o join product_tbl 
            // p on o.pro_id = p.pro_id 
            // where o.user_id = '$user_id' 
            // group by p.pro_id, p.pro_name, 
            // o.delivery_status
            // $search = $con->prepare("SELECT * from product_tbl WHERE pro_name LIKE '%$user_query%' or pro_keyword LIKE '%$user_query%'");
            // $search->setFetchMode(PDO:: FETCH_ASSOC);
            // $search->execute();

            // echo "<div id = 'bodyleft'><ul>";
            // if($search->rowCount() == 0){
            //     echo "<h2>Product Not Found</h2>";
            // }
            // else
            // {
            //     while($row=$search->fetch()):
            //         echo"
            //         </br>
            //             <li>
            //                 <a href='pro_detail.php?pro_id=".$row['pro_id']."'>
            //                     <h4>".$row['pro_name']."</h4>
            //                     <img src ='../uploads/products/".$row['pro_img']."' />
            //                     <center>
            //                     <button id = 'pro_btnView'>
            //                     <a href = 'pro_detail.php?pro_id=".$row['pro_id']."'>View</a>
            //                 </button>
            //                  </center>
            //                 </a>
            //             </li>
            //             ";
            //     endwhile;
            // }
            // echo "</ul></div>";
        }
    }

    
?>

