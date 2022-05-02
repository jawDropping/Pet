<?php
    session_start();

    function LogIn()
    {
        include("inc/db.php");
        if(isset($_POST['login_user']))
        {
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];

            $check_email = $con->prepare("SELECT * FROM users_table WHERE user_email = '$user_email'");
            $check_email->setFetchMode(PDO::FETCH_ASSOC);
            $check_email->execute();

            $verified = $check_email->fetch();
            $isVerified = $verified['verified'];

            if($isVerified == 1)
            {
                $fetchuser = $con->prepare("SELECT * FROM users_table WHERE user_email = '$user_email' AND user_password = '$user_password'");
                $fetchuser->setFetchMode(PDO:: FETCH_ASSOC);
                $fetchuser->execute();

                $row = $fetchuser->fetch();
                $countUser = $fetchuser->rowCount();
                if($countUser>0)
                {
                    $_SESSION['user_id'] = $row['user_id'];
                    echo "<script>window.open('index.php?login_user=".$_SESSION['user_id']."','_self');</script>";
                }
                else
                {
                    echo "<script>alert('Email or Password is incorrect!');</script>";
                }
            }   
            else
            {
                echo "<script>alert('Please verify your email!');</script>";
            }
        }
    }

    function forgotpassword()
    {
        include("inc/db.php");
        if(isset($_POST['update_password']))
        {
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];
            $confirm_password = $_POST['confirm_password'];

            $check_email = $con->prepare("SELECT * FROM users_table WHERE user_email = '$user_email'");
            $check_email->setFetchMode(PDO:: FETCH_ASSOC);
            $check_email->execute();

            $row = $check_email->rowCount();
            if($row>0)
            {
                if($user_password == $confirm_password)
                {
                    if(strlen($user_password) >= 8)
                    {
                        if(preg_match('/[A-Z]/', $user_password) > 0 &&
                        preg_match('/[a-z]/', $user_password) > 0)
                        {
                            $update_password = $con->prepare("UPDATE users_table SET user_password = '$user_password' WHERE user_email = '$user_email'");
                            $update_password->setFetchMode(PDO:: FETCH_ASSOC);
                            $update_password->execute();

                            if($update_password->execute())
                            {
                                echo "<script>alert('Succesfully Changed!');</script>";
                                echo "<script>window.open('login.php', '_self');</script>";
                            }
                        }
                        else
                        {
                            echo "<script>alert('Password must at least have 1 number, 1 special character and 1 uppercase letter!');</script>";
                        }
                    }
                    else
                    {
                        echo "<script>alert('Password length must at least have 8 characters!');</script>";
                    }
                }
                else
                {
                    echo "<script>alert('Password doesn't match!');</script>";
                }
            }
            else
            {
                echo "<script>alert('Email doesn't exists!');</script>";
            }
        }
    }

    function verify()
    {
        include("inc/db.php");
        if(isset($_POST['verify_key']))
        {
            $user_email = $_POST['user_email'];
            $v_key = $_POST['v_key'];

            $check_email = $con->prepare("SELECT * FROM users_table WHERE user_email = '$user_email' AND v_key = '$v_key'");
            $check_email->setFetchMode(PDO:: FETCH_ASSOC);
            $check_email->execute();

            $row = $check_email->rowCount();
            if($row>0)
            {
                $update_verification = $con->prepare("UPDATE users_table SET verified = 1 WHERE user_email = '$user_email'");
                if($update_verification->execute())
                {
                    echo "<script>alert('You can now log in!');</script>";
                    echo "<script>window.open('login.php' ,'_self');</script>";
                }
            }
            else
            {
                echo "Email or Verification Code is incorrect!";
            }
        }
    }

    
    function myProfile()
    {
        include("inc/db.php");
        if(isset($_SESSION['user_id']))
        {
            $user_id = $_SESSION['user_id'];
            $fetch_user_username = $con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
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
                    echo "<script>window.open('index.php?login_user=".$_SESSION['user_id']."', '_self');</script>";
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
            $q = $con->query("
            SELECT od.order_id, od.delivery_status, sum(od.qty * od.price), GROUP_CONCAT(concat(od.pro_name, '(x', od.qty, ')') SEPARATOR ', ') items FROM
            (select o.order_id, p.pro_name, count(p.pro_name) qty, p.pro_price price, o.delivery_status 
            from orders_tbl o join product_tbl p on o.pro_id = p.pro_id
            WHERE o.user_id = $user_id
            group by o.order_id, p.pro_name, o.delivery_status) od
            group by od.order_id, od.delivery_status
            ");
            $orders = $q->fetchAll(PDO::FETCH_ASSOC);
            foreach ($orders as $order) {
                $net_total += $order['sum(od.qty * od.price)'];
                echo
                "<div class = 'dataHolder'>
                    <p class = 'dataCont'>".$order['items']."</p>
                    </div>
                    <div class = 'dataHolders'>
                    <p class = 'dataCont' >₱".$order['sum(od.qty * od.price)']."</p>
                    </div>
                    <div class = 'dataHolder'>
                    <p class = 'dataCont'>".$order['delivery_status']."</p>
                    </div>
                    <div class = 'dataHolder'>
                    <p class = 'dataCont'><a class = 'dataLenk' href = 'cancel_order.php?cancel_order=".$order['order_id']."'>Cancel</a></p>
                    </div>
                ";
                // $net_total = $net_total + $sub_total;
             
            }
            echo 
            "<div></div><div></div><div></div>
            <div class = 'dataHolderTot'>
                <p class = 'dataCont'>TOTAL AMOUNT: ₱".$net_total."</p>
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
            $user_username = $row_get_user_id['user_username'];
            $display_order = $con->prepare("SELECT * FROM delivered_items WHERE user_username = '$user_username' ORDER BY order_id");
            $display_order->setFetchMode(PDO:: FETCH_ASSOC);
            $display_order->execute();
            
            while($row = $display_order->fetch()):
                echo 
                // "<tr>
                //     <td>".$row['order_id']."</td>
                //     <td>".$row['items']."</td>
                //     <td>".$row['date_delivered']."</td>
                // </tr>";
                "<div class = 'dataHolder'>
                    <p class = 'dataCont'>".$row['order_id']."</p>
                    </div>
                    <div class = 'dataHolders'>
                    <p class = 'dataCont' >".$row['items']."</p>
                    </div>
                    <div class = 'dataHolder'>
                    <p class = 'dataCont'>".$row['date_delivered']."</p>
                    </div>
                    
                ";
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
        $sql = $con->prepare("SELECT * FROM organizations");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();

        while($row = $sql->fetch()):
            echo
            "<div class = 'idNiSha'>
            <form method = 'post' enctype='multipart/form-data'>
            <a class = 'aTag' href='org_detail.php?id=".$row['id']."'>
                
                <img class = 'fikture' src ='../uploads/orgs/".$row['org_photo']."' />
                <div class = 'prodDet'>
                <h4>".$row['org_name']."</h4>
                    <br>
                        <a class = 'btnLinkView' href = 'org_detail.php?id=".$row['id']."'>Show Info</a>
                    
                    <input type = 'hidden' value = '".$row['id']."' name = 'pro_id' />
                </div>
            </a>
            </form>
        </div>";
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
                "<div class = 'mainCont'>
                  <div id = 'serviceDet'>
                  <center>
                  <img class = 'images' src ='../uploads/orgs/".$row_org['org_photo']."'/> 
                  </center>
                  <div id = 'innerService'>
                  <div id = 'content'>
                    <p class = 'Heads' >".$row_org['org_name']."</p>
                    <div id = 'oks'>
                        <p class = 'fsTxt'>
                        IRO cares for over 100 companion animals who are awaiting adoption into forever homes.<br>  IRO also cares for a number of animals who are receiving treatment for medical injuries or illnesses or are being rehabilitated for behavioural issues relating to their backgrounds.

IRO is run entirely by a team of volunteers and as a community-focused organization; IRO not only relies on the support of the public (both local and international) for funding but also to assist with the organization’s operations.

IRO is affiliated with Friends for the Protection of Animals (USA), a US-501 c (3) non-profit animal rescue organization.</p>
                        <div class = 'mainInfos'>
                        <div class = 'rightInfo'>
                       
                        <img class = 'donsite' src = '../uploads/donateBy.png' >
                        </div>
                        <div class = 'infoss'>
                    
                        <p class = 'lebels'>
                            Location:
                            </p>
                            <p class = 'dates'> ".$row_org['org_location']."
                        </p>
                        <p class = 'lebels'>
                        GCash Number:</p><p class = 'dates'> ".$row_org['org_contact_number']."
                       
                        </p>
                        <p class = 'lebels'>
                       Email Address: </p>
                       <p class = 'dates'>".$row_org['org_email_address']."
                        </p>
                        <div></div>
                        <a class = 'btnDon' href = 'donate.php?donate=".$row_org['id']."'> Apply for Coupon</a>
                        </div>
                        </div>
                    </div>
                   
                    
                </div>
                </div>
                </div>
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
        

        $fetch_pro = $con->prepare("select * from product_tbl where cat_id='$cat_id' LIMIT 0,3");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        while($row_pro = $fetch_pro->fetch()):
            echo"
            
                <div class = 'idNiSha'>
                    <form method = 'post' enctype='multipart/form-data'>
                    <a class = 'aTag' href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                        <img class = 'fikture' src ='../uploads/products/".$row_pro['pro_img']."' />
                        
                        <div class = 'prodDet'>
                        <p class = 'head4' >".$row_pro['pro_name']."</p>
                        <p class = 'prays'>₱".$row_pro['pro_price']."<p>
                            <a  class = 'btnLinkView' href = 'pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a>";
                        if($row_pro['pro_quantity'] != 0)
                        {

                            echo"<input type = 'hidden' value = '".$row_pro['pro_id']."' name = 'pro_id' />
                            <button class = 'btnLinkCart'  name = 'cart_btn'> Add to Cart</button>";
                        }
                        else
                        {
                            echo "<a>Out of Stock</a>";
                        }
                       echo" </div>
                    </a>
                    </form>
                </div>";
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
        

        $fetch_pro = $con->prepare("select * from product_tbl where cat_id='$cat_id'");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        while($row_pro = $fetch_pro->fetch()):
            echo"
            
                <div class = 'idNiSha'>
                    <form method = 'post' enctype='multipart/form-data'>
                    <a class = 'aTag' href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                        <img class = 'fikture' src ='../uploads/products/".$row_pro['pro_img']."' />
                        
                        <div class = 'prodDet'>
                        <p class = 'head4' >".$row_pro['pro_name']."</p>
                        <p class = 'prays'>₱".$row_pro['pro_price']."<p>
                            <a  class = 'btnLinkView' href = 'pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a>
                            <input type = 'hidden' value = '".$row_pro['pro_id']."' name = 'pro_id' />
                            <button class = 'btnLinkCart'  name = 'cart_btn'> Add to Cart</button>
                        </div>
                    </a>
                    </form>
                </div>
            
                ";
        endwhile;
        if(isset($_POST['cart_btn']))
        {
            array_push( $_SESSION['cart'], $_POST['pro_id']);
            echo "<script>window.open('/Pet/user/showdogfood.php?' ,'_self');</script>";  
        }
    }

   

    function featured_fish_food_products()
    {
        include("inc/db.php");

        $fetch_cat = $con->prepare("SELECT * FROM pet_prod WHERE prod_id='4'");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();

        $row_cat=$fetch_cat->fetch();
        $cat_id = $row_cat['prod_id'];

        $fetch_pro = $con->prepare("select * from product_tbl where cat_id='$cat_id' LIMIT 0,3");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        while($row_pro = $fetch_pro->fetch()):
            echo"
            
                <div class = 'idNiSha'>
                    <form method = 'post' enctype='multipart/form-data'>
                    <a class = 'aTag' href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                        <img class = 'fikture' src ='../uploads/products/".$row_pro['pro_img']."' />
                        
                        <div class = 'prodDet'>
                        <p class = 'head4' >".$row_pro['pro_name']."</p>
                        <p class = 'prays'>₱".$row_pro['pro_price']."<p>
                            <a  class = 'btnLinkView' href = 'pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a>";
                        if($row_pro['pro_quantity'] != 0)
                        {

                            echo"<input type = 'hidden' value = '".$row_pro['pro_id']."' name = 'pro_id' />
                            <button class = 'btnLinkCart'  name = 'cart_btn'> Add to Cart</button>";
                        }
                        else
                        {
                            echo "<a>Out of Stock</a>";
                        }
                       echo" </div>
                    </a>
                    </form>
                </div>";
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

        $fetch_pro = $con->prepare("select * from product_tbl where cat_id='$cat_id'");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        while($row_pro = $fetch_pro->fetch()):
            echo"
            <div class = 'idNiSha'>
            <form method = 'post' enctype='multipart/form-data'>
            <a class = 'aTag' href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                <img class = 'fikture' src ='../uploads/products/".$row_pro['pro_img']."' />
                
                <div class = 'prodDet'>
                <p class = 'head4' >".$row_pro['pro_name']."</p>
                <p class = 'prays'>₱".$row_pro['pro_price']."<p>
                    <a  class = 'btnLinkView' href = 'pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a>
                    <input type = 'hidden' value = '".$row_pro['pro_id']."' name = 'pro_id' />
                    <button class = 'btnLinkCart'  name = 'cart_btn'> Add to Cart</button>
                </div>
            </a>
            </form>
        </div>
                ";
        endwhile;
        if(isset($_POST['cart_btn']))
        {
            array_push( $_SESSION['cart'], $_POST['pro_id']);
            echo "<script>window.open('/Pet/user/showfishfood.php?' ,'_self');</script>";  
        }
    }
    //wala pa
    function bird_food_products()
    {
        include("inc/db.php");

        $fetch_cat = $con->prepare("SELECT * FROM pet_prod WHERE prod_id='3'");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();

        $row_cat=$fetch_cat->fetch();
        $cat_id = $row_cat['prod_id'];

        $fetch_pro = $con->prepare("select * from product_tbl where cat_id='$cat_id'");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        while($row_pro = $fetch_pro->fetch()):
            echo"
            <div class = 'idNiSha'>
            <form method = 'post' enctype='multipart/form-data'>
            <a class = 'aTag' href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                <img class = 'fikture' src ='../uploads/products/".$row_pro['pro_img']."' />
                
                <div class = 'prodDet'>
                <p class = 'head4' >".$row_pro['pro_name']."</p>
                <p class = 'prays'>₱".$row_pro['pro_price']."<p>
                    <a  class = 'btnLinkView' href = 'pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a>
                    <input type = 'hidden' value = '".$row_pro['pro_id']."' name = 'pro_id' />
                    <button class = 'btnLinkCart'  name = 'cart_btn'> Add to Cart</button>
                </div>
            </a>
            </form>
        </div>
                ";
        endwhile;
        if(isset($_POST['cart_btn']))
        {
            array_push( $_SESSION['cart'], $_POST['pro_id']);
            echo "<script>window.open('/Pet/user/showbirdfood.php?' ,'_self');</script>";  
        }
    }
    
    function featured_bird_food_products()
    {
        include("inc/db.php");

        $fetch_cat = $con->prepare("SELECT * FROM pet_prod WHERE prod_id='3'");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();

        $row_cat=$fetch_cat->fetch();
        $cat_id = $row_cat['prod_id'];

        $fetch_pro = $con->prepare("select * from product_tbl where cat_id='$cat_id' LIMIT 0,3");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        while($row_pro = $fetch_pro->fetch()):
            echo"
            <div class = 'idNiSha'>
            <form method = 'post' enctype='multipart/form-data'>
            <a class = 'aTag' href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                <img class = 'fikture' src ='../uploads/products/".$row_pro['pro_img']."' />
                
                <div class = 'prodDet'>
                <p class = 'head4' >".$row_pro['pro_name']."</p>
                <p class = 'prays'>₱".$row_pro['pro_price']."<p>
                    <a  class = 'btnLinkView' href = 'pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a>
                    <input type = 'hidden' value = '".$row_pro['pro_id']."' name = 'pro_id' />
                    <button class = 'btnLinkCart'  name = 'cart_btn'> Add to Cart</button>
                </div>
            </a>
            </form>
        </div>
                ";
        endwhile;
    }

   
    function featured_cat_food_products()
    {
        include("inc/db.php");

        $fetch_cat = $con->prepare("SELECT * FROM pet_prod WHERE prod_id='2'");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();

        $row_cat=$fetch_cat->fetch();
        $cat_id = $row_cat['prod_id'];

        $fetch_pro = $con->prepare("select * from product_tbl where cat_id='$cat_id' LIMIT 0,3");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        while($row_pro = $fetch_pro->fetch()):
            echo"
            <div class = 'idNiSha'>
            <form method = 'post' enctype='multipart/form-data'>
            <a class = 'aTag' href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                <img class = 'fikture' src ='../uploads/products/".$row_pro['pro_img']."' />
                
                <div class = 'prodDet'>
                <p class = 'head4' >".$row_pro['pro_name']."</p>
                <p class = 'prays'>₱".$row_pro['pro_price']."<p>
                    <a  class = 'btnLinkView' href = 'pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a>
                    <input type = 'hidden' value = '".$row_pro['pro_id']."' name = 'pro_id' />
                    <button class = 'btnLinkCart'  name = 'cart_btn'> Add to Cart</button>
                </div>
            </a>
            </form>
        </div>
                ";
        endwhile;
        // if(isset($_POST['cart_btn']))
        // {
        //     array_push( $_SESSION['cart'], $_POST['pro_id']);
        //     echo "<script>window.open('/Pet/user/showcatfood.php?' ,'_self');</script>";  
        // }
    }

    function cat_food_products()
    {
        include("inc/db.php");

        $fetch_cat = $con->prepare("SELECT * FROM pet_prod WHERE prod_id='2'");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();

        $row_cat=$fetch_cat->fetch();
        $cat_id = $row_cat['prod_id'];

        $fetch_pro = $con->prepare("select * from product_tbl where cat_id='$cat_id'");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        while($row_pro = $fetch_pro->fetch()):
            echo"
            <div class = 'idNiSha'>
            <form method = 'post' enctype='multipart/form-data'>
            <a class = 'aTag' href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                <img class = 'fikture' src ='../uploads/products/".$row_pro['pro_img']."' />
                
                <div class = 'prodDet'>
                <p class = 'head4' >".$row_pro['pro_name']."</p>
                <p class = 'prays'>₱".$row_pro['pro_price']."<p>
                    <a  class = 'btnLinkView' href = 'pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a>
                    <input type = 'hidden' value = '".$row_pro['pro_id']."' name = 'pro_id' />
                    <button class = 'btnLinkCart'  name = 'cart_btn'> Add to Cart</button>
                </div>
            </a>
            </form>
        </div>
                ";
        endwhile;
        if(isset($_POST['cart_btn']))
        {
            array_push( $_SESSION['cart'], $_POST['pro_id']);
            echo "<script>window.open('/Pet/user/showcatfood.php?' ,'_self');</script>";  
        }
    }

    //wala pa
    function other_food_products()
    {
        include("inc/db.php");

        $fetch_cat = $con->prepare("SELECT * FROM pet_prod WHERE prod_id='5'");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();

        $row_cat=$fetch_cat->fetch();
        $cat_id = $row_cat['prod_id'];
        

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
        if(isset($_POST['cart_btn']))
        {
            array_push( $_SESSION['cart'], $_POST['pro_id']);
            echo "<script>window.open('/Pet/user/showotherfoods.php?' ,'_self');</script>";  
        }
    }

    function featured_other_food_products()
    {
        include("inc/db.php");

        $fetch_cat = $con->prepare("SELECT * FROM pet_prod WHERE prod_id='5'");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();

        $row_cat=$fetch_cat->fetch();
        $cat_id = $row_cat['prod_id'];
        

        $fetch_pro = $con->prepare("select * from product_tbl where cat_id='$cat_id' LIMIT 0,3");
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
                    </ul>
                  </div>
                  <div id = 'pro_brand'>
                    <h3>".$row_pro['pro_name']."</h3>
                    <ul>
                        <li>
                            Description:
                            <br>
                            <br>".$row_pro['pro_keyword']."
                        </li>
                        <li>
                            <br>Product Price: ₱".$row_pro['pro_price'].".00
                        </li>
                        <li>
                            <br>Product Stock: ".$row_pro['pro_quantity']."
                        </li>
                        <li>";
                            if($row_pro['pro_quantity'] > 0)
                            {
                                echo "<br>Availability: In Stock";
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
        echo "<h3>Services Available </h3>";
        while($row = $sql->fetch()):
            
            echo
            "<div class = 'idNiSha'>
            <form method = 'post' enctype='multipart/form-data'>
            <a class = 'aTag' href='show_service_info.php?id=".$row['id']."'>
               
                <img class = 'fikture'  src ='../uploads/user_profile/".$row['service_photo']."' />
                <div class = 'prodDet'>
                <h4>".$row['services_name']."</h4>
                    <button id = 'pro_btnView'>
                        <a href = 'show_service_info.php?id=".$row['id']."'>Show Info</a>
                    </button>
                    <input type = 'hidden' value = '".$row['id']."' name = 'pro_id' />
                </div>
            </a>
            </form>
          
        </div>";
        endwhile;
    }

    function grooming_service()
    {
        include("inc/db.php");
        $sql = $con->prepare("SELECT * FROM service_cat WHERE cat_id = '1'");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();

        $row = $sql->fetch();
        $service_id = $row['cat_id'];

        $sql2 = $con->prepare("SELECT * FROM services WHERE service_id = '$service_id'");
        $sql2->setFetchMode(PDO:: FETCH_ASSOC);
        $sql2->execute();

        echo "<h3>Grooming Services</h3>";
        while($row = $sql2->fetch()):
            
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

    function pet_hotels_facilities()
    {
        include("inc/db.php");
        $sql = $con->prepare("SELECT * FROM service_cat WHERE cat_id = '2'");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();

        $row = $sql->fetch();
        $service_id = $row['cat_id'];

        $sql2 = $con->prepare("SELECT * FROM services WHERE service_id = '$service_id'");
        $sql2->setFetchMode(PDO:: FETCH_ASSOC);
        $sql2->execute();

        echo "<h3>Pet Hotels</h3>";
        while($row = $sql2->fetch()):
            
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

    function pet_training_facilities()
    {
        include("inc/db.php");
        $sql = $con->prepare("SELECT * FROM service_cat WHERE cat_id = '3'");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();

        $row = $sql->fetch();
        $service_id = $row['cat_id'];

        $sql2 = $con->prepare("SELECT * FROM services WHERE service_id = '$service_id'");
        $sql2->setFetchMode(PDO:: FETCH_ASSOC);
        $sql2->execute();

        echo "<h3>Pet Training Services</h3>";
        while($row = $sql2->fetch()):
            
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

    function vet_clinics()
    {
        include("inc/db.php");
        $sql = $con->prepare("SELECT * FROM service_cat WHERE cat_id = '4'");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();

        $row = $sql->fetch();
        $service_id = $row['cat_id'];

        $sql2 = $con->prepare("SELECT * FROM services WHERE service_id = '$service_id'");
        $sql2->setFetchMode(PDO:: FETCH_ASSOC);
        $sql2->execute();

        echo "<h3>Pet Vet Clinics</h3>";
        while($row = $sql2->fetch()):
            
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

    function other_services()
    {
        include("inc/db.php");
        $sql = $con->prepare("SELECT * FROM service_cat WHERE cat_id = '4'");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();

        $row = $sql->fetch();
        $service_id = $row['cat_id'];

        $sql2 = $con->prepare("SELECT * FROM services WHERE service_id = '$service_id'");
        $sql2->setFetchMode(PDO:: FETCH_ASSOC);
        $sql2->execute();

        echo "<h3>Other Services</h3>";
        while($row = $sql2->fetch()):
            
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
                "
                <div class = 'pckman'>
                    <div id = 'pic'>
                    <img id = 'okpic' src ='../uploads/user_profile/".$row_services['service_photo']."'/>
                    </div>
                    <div class = 'secondBody'>
                        <p class = 'hed'>".$row_services['services_name']."</p>
                        <div class = 'mainHoldest'>
                            <div class = 'holdest'>
                                <p class = 'lebs'> Service Category: </p>
                                <p class = 'conts' >".$cat_name."</p>
                            </div>
                            <div class = 'holdest'>
                                <p class = 'lebs'> Contact Number: </p>
                                <p class = 'conts'>".$row_services['services_contact_number']." </p>
                            </div>
                            <div class = 'holdest'>
                                <p class = 'lebs'>Email Address:</p>
                                <p class = 'conts'> ".$row_services['services_email']."</p>
                            </div>
                            <div class = 'holderister'>
                                <div class = 'holdest2'>
                                    <p class = 'lebs' >Time Open:</p>
                                    <p class = 'conts'>".$open_time." </p>
                                </div>
                                <div class = 'holdest3'>
                                    <p class = 'lebs'> Time Close:</p>
                                    <p class = 'conts' > ".$close_time." </p>
                                </div>
                            </div>
                            <div class = 'holdest'>
                                <p class = 'lebs'>Service Cost: </p>
                                <p class = 'conts'>".$row_services['service_cost']."</p>
                            </div>
                            <div></div>
                            <div class = 'btnss' >
                                <a class = 'bbm' href = 'avail_service_nocoupon.php?avail_service=".$row_services['id']."'>Reserve(without coupon)</a>
                                <a  class = 'bbm' href = 'avail_service.php?avail_service=".$row_services['id']."' >Reserve (with coupon)</a>
                                <a  class = 'bbm' href = 'review_service.php?review_service=".$row_services['id']."' >Give Feedback</a>
                            </div>
                        </div>  
                    </div>
                </div>
                   ";   
                
       
           
        }

    }
    function showFeeds(){
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

            echo "<p class = 'loc2'>REVIEWS</p>";
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
                    "
                    <div class = 'comss'>
                        <p class = 'revNem'>".$row_user['user_username']."</p>
                        <p class = 'rev'> ".$row_feedbacks['comment']."</p>
                        </div>
                    "; 
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

    function avail_service()
    {
        if(isset($_GET['avail_service']))
        {
            include("inc/db.php");
            $service_id = $_GET['avail_service'];
            $query = $con->prepare("SELECT * FROM services WHERE id = '".$service_id."'");
            $query->setFetchMode(PDO:: FETCH_ASSOC);
            $query->execute();

            $row = $query->fetch(); 
            $service_cost = $row['service_cost'];
            $pet_center_id = $row['pet_center_id'];
            $service_time_open = strtotime($row['time_open']);
            $service_time_close = strtotime($row['time_close']);

     

            $sql2 = $con->prepare("SELECT active_coupon FROM pet_center_tbl WHERE pet_center_id = $pet_center_id");
            $sql2->setFetchMode(PDO:: FETCH_ASSOC);
            $sql2->execute();

            $row3 = $sql2->fetch();
            
            $users_id = $_SESSION['user_id'];
            $sql = $con->prepare("SELECT * FROM users_table WHERE user_id = '$users_id'");
            $sql->setFetchMode(PDO:: FETCH_ASSOC);
            $sql->execute();

            $row2 = $sql->fetch();

            $user_id = $row2['user_id'];

  if($row3['active_coupon'] == 'yes')
                    {
            echo 
            "<form method = 'POST'>
                <label class = 'hh'>Please verify your coupon to get the exact amount!</label>
                <div class = 'maines'>
                
                    <p class = 'lebs'>Book Appointment: </p>
                    <input class = 'inet' type = 'date' name = 'reserve_date'  required/>
                
                    <p class = 'lebs'>Time: </p></td>
                    <input class = 'inet' type = 'time' name = 'reserve_time'  required/></td>
                    <p class = 'lebs'>Coupon Code: </p>
                    <input class = 'inet' type = 'text' name = 'coupon_code'/>
                    <p class = 'lebs'>Service Cost: </p>
                    <input class = 'inet' type = 'text' name = 'service_cost' value = ".$service_cost."   />
                   "; 
                echo "
       
                    <input type = 'hidden' name = 'reserve' value = ".$row['service_id']."/><div></div>
                    <div>
                    <button class = 'btnn' name = 'reserve_service' value = ".$row['service_id']."'>RESERVE</button>
                    <a class = 'btnnllnk' href = 'services.php'>GO BACK</a>
                    </div>
                    
                </div>
            </form>";
                    }else
            {
                echo "This service provides no coupon, Click here to avail the service without any coupon used!<a href = 'avail_service_nocoupon.php?avail_service=".$row['id']."'>Avail Service(without coupon)</a>";
            }


    
            if(!isset($_SESSION['user_id']))
            {
                echo "<script>window.open('login.php', '_self');</script>";
            }
            else
            {
                if(isset($_POST['reserve_service']))
                {
                    $service_cost = $_POST['service_cost'];
                    $reserve_date = $_POST['reserve_date'];
                    $coupon_code = $_POST['coupon_code'];
                    $reserve_time = $_POST['reserve_time'];
                    $transaction_code = generateRandomString();
    
                    $datenow = getdate();
    
                    $today = $datenow['year'] . '-' . $datenow['mon'] . '-' . $datenow['mday'];
    
                    $dateTimestamp = strtotime($reserve_date);
                    $dateTimestamp2 = strtotime($today);
                    $dateTimestamp3 = strtotime($reserve_time);
    
    
                    $view_time = $con->prepare("SELECT * FROM reserve_services");
                    $view_time->setFetchMode(PDO:: FETCH_ASSOC);
                    $view_time->execute();
    
                    // $row_time = $view_time->rowCount();
                    $row_date_and_time = $view_time->fetch();
                    $reserved_date = $row_date_and_time['reserve_date'];
                    $reserved_time = $row_date_and_time['reserve_time'];
                    
                    if($dateTimestamp > $dateTimestamp2)
                    {
                        if($dateTimestamp3 >= $service_time_open && $dateTimestamp3 < $service_time_close)
                        {
                            if($dateTimestamp != $reserved_date && $dateTimestamp3 != $reserved_time)
                            {
                                $sql = $con->query("SELECT * FROM reserve_services WHERE coupon_code = '$coupon_code'");
                                $sql->setFetchMode(PDO:: FETCH_ASSOC);
                                $sql->execute();
        
                                $sql2 = $con->query("SELECT * FROM reserve_services");
                                $sql2->setFetchMode(PDO:: FETCH_ASSOC);
                                $sql2->execute();
        
                                $row = $sql->rowCount();
                                $row_user = $sql2->fetch();
                                $user_id = $row_user['user_id'];
        
                                $fetch_user_username = $con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
                                $fetch_user_username->setFetchMode(PDO:: FETCH_ASSOC);
                                $fetch_user_username->execute();
                        
                                $row4 = $fetch_user_username->fetch();
                                if($row>0)
                                {
                                    echo "<script>alert('Code Exist!');</script>";
                                }
                                else
                                {
                                    $view_coupon = $con->prepare("SELECT * FROM donations WHERE coupon_code = '$coupon_code'");
                                    $view_coupon->setFetchMode(PDO:: FETCH_ASSOC);
                                    $view_coupon->execute();
        
                                    $row2 = $view_coupon->rowCount();
                                    if($row2>0)
                                    {
                                        $discount = "0.02";
        
                                        $total = $service_cost * $discount;
                                        $convertfloat = floatval($total);
        
                                        $service_total_cost = $service_cost - $convertfloat;
        
                                        $receiver = $row4['user_email'];
                                        $subject = "Transaction Code";
                                        $body = "Present this code to the available service according to your choice. Your Transaction Code: $transaction_code";
                                        $sender = "ianjohn0101@gmail.com";
        
                                        if(mail($receiver, $subject, $body, $sender))
                                        {
                                            $reserve_service = $con->prepare("INSERT INTO reserve_services (
                                                pet_center_id,
                                                service_id,
                                                user_id,
                                                service_cost,
                                                reserve_date,
                                                reserve_time,
                                                coupon_code,
                                                transaction_code,
                                                service_status
                                            ) 
                                            VALUES (
                                                '$pet_center_id',
                                                '$service_id',
                                                '$user_id',
                                                '$service_total_cost',
                                                '$reserve_date',
                                                '$reserve_time',
                                                '$coupon_code',
                                                '$transaction_code',
                                                'For Confirmation'
                                            )");
                                
                                            if($reserve_service->execute())
                                            {
                                                echo "SUCCESSFUL"; 
                                            }
                                            else
                                            {
                                                echo "UNSUCCESSFUL";
                                            }
                                        }
                                    }
                                    else
                                    {
                                        $receiver = $row4['user_email'];
                                        $subject = "Transaction Code";
                                        $body = "Present this code to the available service according to your choice. Your Transaction Code: $transaction_code";
                                        $sender = "ianjohn0101@gmail.com";
        
                                        if(mail($receiver, $subject, $body, $sender))
                                        {
                                            $reserve_service = $con->prepare("INSERT INTO reserve_services (
                                                pet_center_id,
                                                service_id,
                                                user_id,
                                                service_cost,
                                                reserve_date,
                                                reserve_time,
                                                coupon_code,
                                                transaction_code,
                                                service_status
                                            ) 
                                            VALUES (
                                                '$pet_center_id',
                                                '$service_id',
                                                '$user_id',
                                                '$service_cost',
                                                '$reserve_date',
                                                '$reserve_time',
                                                '$coupon_code',
                                                '$transaction_code',
                                                'For Confirmation'
                                            )");
                                
                                            if($reserve_service->execute())
                                            {
                                                echo "<script>alert('PLEASE WAIT FOR THE PETCENTER TO CONFIRM!');</script>"; 
                                            }
                                            else
                                            {
                                                echo "<script>alert('UNSUCCESSFUL');</script>";
                                            }
                                        }
                                    }
                                }
                            }
                            else
                            {
                                echo "<script>alert('Time reserved already, chose another date or time.');</script>";
                            }
                        }
                        else
                        {
                            echo "<script>alert('Time you chose is invalid, please check the time open and time close of the service.');</script>";
                        }        
                    }
                    else
                    {
                        echo "<script>alert('INVALID DATE!');</script>";
                    }
                }
            }
        }
    }

    function avail_service_nocoupon()
    {
        if(!isset($_SESSION['user_id']))
        {
            echo "<script>window.open('login.php', '_self');</script>";
        }
        else
        {
            if(isset($_GET['avail_service']))
            {
                include("inc/db.php");
                $service_id = $_GET['avail_service'];
                $query = $con->prepare("SELECT * FROM services WHERE id = '".$service_id."'");
                $query->setFetchMode(PDO:: FETCH_ASSOC);
                $query->execute();
    
                $row = $query->fetch(); 
                $service_cost = $row['service_cost'];
                $pet_center_id = $row['pet_center_id'];
                $service_time_open = strtotime($row['time_open']);
                $service_time_close = strtotime($row['time_close']);
                
         
    
                $sql2 = $con->prepare("SELECT active_coupon FROM pet_center_tbl WHERE pet_center_id = $pet_center_id");
                $sql2->setFetchMode(PDO:: FETCH_ASSOC);
                $sql2->execute();
    
                $row3 = $sql2->fetch();
                
                $users_id = $_SESSION['user_id'];
                $sql = $con->prepare("SELECT * FROM users_table WHERE user_id = '$users_id'");
                $sql->setFetchMode(PDO:: FETCH_ASSOC);
                $sql->execute();
    
                $row2 = $sql->fetch();
    
                $user_id = $row2['user_id'];
                $empty_coupon = '';
    
                echo 
                "<form method = 'POST'>
                   
                    <div class = 'maines'>
                    
                        <p class = 'lebs'>Book Appointment: </p>
                        <input class = 'inet' type = 'date' name = 'reserve_date'  required/>
                    
                        <p class = 'lebs'>Time: </p></td>
                        <input class = 'inet' type = 'time' name = 'reserve_time'  required/>
                        <p class = 'lebs'>Service Cost: </p>
                        <input class = 'inet' type = 'text' name = 'service_cost' value = ".$service_cost."   />
                  
           
                        <input type = 'hidden' name = 'reserve' value = ".$row['service_id']."/><div></div>
                        <div>
                        <button class = 'btnn' name = 'reserve_service' value = ".$row['service_id']."'>RESERVE</button>
                        <a class = 'btnnllnk' href = 'services.php'>GO BACK</a>
                        </div>
                        
                    </div>
                </form>";
    
        
                if(isset($_POST['reserve_service']))
                {
                    $service_cost = $_POST['service_cost'];
                    $reserve_date = $_POST['reserve_date'];
                    $coupon_code = $_POST['coupon_code'];
                    $reserve_time = $_POST['reserve_time'];
                    $transaction_code = generateRandomString();
    
                    $datenow = getdate();
    
                    $today = $datenow['year'] . '-' . $datenow['mon'] . '-' . $datenow['mday'];
    
                    $dateTimestamp = strtotime($reserve_date);
                    $dateTimestamp2 = strtotime($today);
                    $dateTimestamp3 = strtotime($reserve_time);
    
    
                    $view_time = $con->prepare("SELECT * FROM reserve_services");
                    $view_time->setFetchMode(PDO:: FETCH_ASSOC);
                    $view_time->execute();
    
                    // $row_time = $view_time->rowCount();
                    $row_date_and_time = $view_time->fetch();
                    $reserved_date = $row_date_and_time['reserve_date'];
                    $reserved_time = $row_date_and_time['reserve_time'];
                    
                    if($dateTimestamp > $dateTimestamp2)
                    {
                        if($dateTimestamp3 >= $service_time_open && $dateTimestamp3 < $service_time_close)
                        {
                            if($dateTimestamp != $reserved_date && $dateTimestamp3 != $reserved_time)
                            {
                                
        
                                $sql2 = $con->query("SELECT * FROM reserve_services");
                                $sql2->setFetchMode(PDO:: FETCH_ASSOC);
                                $sql2->execute();
        
                                $row = $sql->rowCount();
                                $row_user = $sql2->fetch();
                                $user_id = $row_user['user_id'];
        
                                $fetch_user_username = $con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
                                $fetch_user_username->setFetchMode(PDO:: FETCH_ASSOC);
                                $fetch_user_username->execute();
                        
                                $row4 = $fetch_user_username->fetch();
                                $receiver = $row4['user_email'];
                                $subject = "Transaction Code";
                                $body = "Present this code to the available service according to your choice. Your Transaction Code: $transaction_code";
                                $sender = "ianjohn0101@gmail.com";
    
                                if(mail($receiver, $subject, $body, $sender))
                                {
                                    $reserve_service = $con->prepare("INSERT INTO reserve_services (
                                        pet_center_id,
                                        service_id,
                                        user_id,
                                        service_cost,
                                        reserve_date,
                                        reserve_time,
                                        coupon_code,
                                        transaction_code,
                                        service_status
                                    ) 
                                    VALUES (
                                        '$pet_center_id',
                                        '$service_id',
                                        '$user_id',
                                        '$service_cost',
                                        '$reserve_date',
                                        '$reserve_time',
                                        '$coupon_code',
                                        '$transaction_code',
                                        'For Confirmation'
                                    )");
                        
                                    if($reserve_service->execute())
                                    {
                                        echo "<script>alert('PLEASE WAIT FOR THE PETCENTER TO CONFIRM!');</script>";  
                                    }
                                    else
                                    {
                                        echo "<script>alert('UNSUCCESSFUL');</script>";
                                    }
                                }
                            }
                            else
                            {
                                echo "<script>alert('Time reserved already, chose another date or time.');</script>";
                            }
                        }
                        else
                        {
                            echo "<script>alert('Time you chose is invalid, please check the time open and time close of the service.');</script>";
                        }        
                    }
                    else
                    {
                        echo "<script>alert('INVALID DATE!');</script>";
                    }
                }
            }
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
                    $sql = $con->prepare("SELECT * FROM product_tbl WHERE pro_name = '$name'");
                    $sql->setFetchMode(PDO:: FETCH_ASSOC);
                    $sql->execute();

                    $row_prods = $sql->fetch();
                    $rowCount = $sql->rowCount();

                    $sql2 = $con->prepare("SELECT * FROM services WHERE services_name = '$name'");
                    $sql2->setFetchMode(PDO:: FETCH_ASSOC);
                    $sql2->execute();

                    $row_service = $sql2->fetch();
                    $rowCount2 = $sql2->rowCount();

                    $sql3 = $con->prepare("SELECT * FROM organizations WHERE org_name = '$name'");
                    $sql3->setFetchMode(PDO:: FETCH_ASSOC);
                    $sql3->execute();

                    $row_org = $sql3->fetch();
                    $rowCount3 = $sql3->rowCount();
                   
                    if($rowCount > 0)
                    {
                        echo
                        "<a href='pro_detail.php?pro_id=".$row_prods['pro_id']."'>
                            <h4>".$row_prods['pro_name']."</h4>
                            <img src ='../uploads/products/".$row_prods['pro_img']."' />
                            <center>
                                <button id = 'pro_btnView'>
                                    <a href = 'pro_detail.php?pro_id=".$row_prods['pro_id']."'>View</a>
                                </button>
                            </center>
                        </a>
                        </li>";
                    }
                    if($rowCount2 > 0)
                    {
                        echo 
                        "<a href='show_service_info.php?id=".$row_service['id']."'>
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
                    if($rowCount3 > 0)
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

