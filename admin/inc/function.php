<?php
    session_start();

    function LogInAdmin()
    {
        include("inc/db.php");
        if(isset($_POST['login_admin']))
        {
            $admin_name = $_POST['admin_name'];
            $admin_password = $_POST['admin_password'];

            $fetchuser = $con->prepare("SELECT * FROM admintbl WHERE admin_name = '$admin_name' AND admin_password = '$admin_password'");
            $fetchuser->setFetchMode(PDO:: FETCH_ASSOC);
            $fetchuser->execute();
            $countUser = $fetchuser->rowCount();

            $row = $fetchuser->fetch();
            if($countUser>0)
            {
                $_SESSION['admin_name'] = $_POST['admin_name'];
                echo "<script>window.open('/Pet/admin/index.php?login_user=".$_SESSION['admin_name']."','_self');</script>";
            }
            else
            {
                echo "<script>alert('Username or Password is incorrect!');</script>";
            }
        }
    }

    function AdminProfile()
    {
        include("inc/db.php");
        if(isset($_SESSION['admin_name']))
        {
            $user_id = $_SESSION['admin_name'];
            $fetch_user_username = $con->prepare("SELECT * FROM admintbl WHERE admin_name = '$user_id'");
            $fetch_user_username->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_user_username->execute();
    
            $row = $fetch_user_username->fetch();
            $id = $row['id'];
    
            echo 
            "<form method = 'POST' enctype='multipart/form-data'>
                <table>
                    <tr>
                        <td>Username: </td>
                        <td><input type = 'text' name =  'admin_name' value = '".$row['admin_name']."' /></td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td><input type = 'password' name = 'admin_password' value = '".$row['admin_password']."' /></td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td><input type = 'email' name = 'admin_email' value = '".$row['admin_email']."' /></td>
                    </tr>
                </table>
                <button name = 'update_user'>Update Profile</button>
            </form>";
    
            if(isset($_POST['update_user']))
            {
                $admin_name = $_POST['admin_name'];
                $admin_password =  $_POST['admin_password'];
                $admin_email = $_POST['admin_email'];
            
                $update_user = $con->prepare("UPDATE admintbl 
                SET 
                    admin_name='$admin_name',
                    admin_password = '$admin_password',
                    admin_email = '$admin_email'
                WHERE 
                    id = '$id'");
    
                if($update_user->execute())
                {
                    echo "<script>alert('Your Information Successfully Updated!');</script>";
                    echo "<script>window.open('/Pet/admin/index.php?login_user=".$_SESSION['admin_name']."', '_self');</script>";
                }
            }
        }
    }   

    function add_partners()
    {
        include("inc/db.php");
        if(isset($_POST['add_org']))
        {
            $org_name = $_POST['org_name'];
            $org_location = $_POST['org_location'];
            $org_contact_number = $_POST['org_contact_number'];
            $org_email_address = $_POST['org_email_address'];
            
            $org_photo = $_FILES['org_photo']['name'];
            $org_photo_tmp = $_FILES['org_photo']['tmp_name'];

            move_uploaded_file($org_photo_tmp, "../uploads/orgs/$org_photo");

            $add_org = $con->prepare("INSERT INTO organizations(
                org_name,
                org_location,
                org_contact_number,
                org_email_address,
                org_photo
            ) 
            VALUES(
                '$org_name',
                '$org_location',
                '$org_contact_number',
                '$org_email_address',
                '$org_photo'
            )");
            if($add_org->execute())
            {
                echo "<script>alert('Added Successfully!');</script>";
                echo "<script>window.open('index.php?manage_partner', '_self');</script>";
            }
        }
    }

    function viewall_partners()
    {
        echo
            "<form method = 'POST' action = 'add_partners.php' enctype = 'multipart/form-data'>
                <button>Add Partners</button>
            </form>";
        include("inc/db.php");
        $viewall_partners = $con->prepare("SELECT * FROM organizations");
        $viewall_partners->setFetchMode(PDO:: FETCH_ASSOC);
        $viewall_partners->execute();

        while($row = $viewall_partners->fetch()):
            
            echo 
            "<form method = 'POST' action = 'update_organizations.php' enctype = 'multipart/form-data'>
                <tr>
                    <td>".$row['org_name']."</td>
                    <td>".$row['org_location']."</td>
                    <td>".$row['org_contact_number']."</td>
                    <td>".$row['org_email_address']."</td>
                    <td><button name = 'edit_org' value = ".$row['id'].">Edit</button></td>
                    <td><button name = 'delete_org' value = ".$row['id'].">Delete</button></td>
                </tr>
            </form>";
        endwhile;
    }

    function add_cat() 
    {
        include("inc/db.php");
        if(isset($_POST['add_cat']))
        {
            $cat_name = $_POST['cat_name'];
            $add_cat = $con->prepare("insert into pet_prod(cat_name) values('$cat_name')");
            
            if($add_cat->execute())
            {
            echo "<script>alert('Category Added Successfully!');</script>"; 
            echo "<script>window.open('index.php?viewall_cat','_self');</script>";
            }
            else
            {
                echo "<script>alert('Category Not Added Successfully!');</script>";
            }
        }
    }
    
    function add_sub_cat()
    {
        include("inc/db.php");
        if(isset($_POST['add_sub_cat']))
        {
            $cat_id = $_POST['main_cat'];
            $sub_cat_name = $_POST['sub_cat_name'];
            $add_sub_cat = $con->prepare("insert into sub_cat
            (
                sub_cat_name, 
                cat_id
            ) 
            values
            (
                '$sub_cat_name', 
                '$cat_id'
            )");
            
            if($add_sub_cat->execute())
            {
               echo "<script>alert('Sub Category Added Successfully!');</script>"; 
            }
            else
            {
                echo "<script>alert('Sub Category Not Added Successfully!');</script>";
            }
        }
    }

    function add_product() 
    {
        echo
        "<div id ='bodyright'>
        <div class = 'addProduct'>
        <h3>Add Products</h3>
        <form method = 'POST' enctype = 'multipart/form-data'>
            <div class='formleft'>
    
            </div>
            <div class='formright'>
    
            </div>
            <table>
                <tr>
                    <td>Enter Product Name: </td>
                    <td><input type='text' name = 'pro_name' required/></td>
                </tr>
                <tr>
                    <td>Select Category Name: </td>
                    <td>
                        <select name = 'cat_name'>";
             
                                echo viewall_cat(); 
                            
                       echo" </select>
                    </td>
                </tr>
                <tr>
                    <td>Other Category: </td>
                    <td><input type='text' name = 'pro_brand' placeholder = 'Other category you prefer..'/></td>
                    
                </tr>
                <tr>
                    <td>Enter Product Brand: </td>
                    <td><input type='text' name = 'pro_brand' required /></td>
                </tr>
                <tr>
                    <td>Select 1st Product Image: </td>
                    <td><input type='file' name = 'pro_img' required/></td>
                </tr>
                <tr>
                    <td>Select 2nd Product Image: </td>
                    <td><input type='file' name = 'pro_img2' required/></td>
                </tr>
                <tr>
                    <td>Select 3rd Product Image: </td>
                    <td><input type='file' name = 'pro_img3' required/></td>
                </tr>
                <tr>
                    <td>Select 4th Product Image: </td>
                    <td><input type='file' name = 'pro_img4' required/></td>
                </tr>
                <tr>
                    <td>Enter Price: </td>
                    <td><input type= 'text' name = 'pro_price' required/></td>
                </tr>
                <tr>
                    <td>Enter Quantity: </td>
                    <td><input type='text' name = 'pro_quantity' required/></td>
                </tr>
                <tr>
                    <td>Enter KeyWord: </td>
                    <td><input type= 'text' name = 'pro_keyword' required/></td>
                </tr>
            </table>
            <button name = 'add_prod'>Add Product</button>
        </form>
        </div>
        
    </div>";

       include("inc/db.php");
       if(isset($_POST['add_prod']))
       {
           $pro_name = $_POST['pro_name'];
           $cat_id = $_POST['cat_name'];
           $pro_brand = $_POST['pro_brand'];
           $pro_keyword = $_POST['pro_keyword'];

           $pro_img = $_FILES['pro_img']['name'];
           $pro_img_tmp = $_FILES['pro_img']['tmp_name'];
           $pro_img2 = $_FILES['pro_img2']['name'];
           $pro_img2_tmp = $_FILES['pro_img2']['tmp_name'];
           
           $pro_img3 = $_FILES['pro_img3']['name'];
           $pro_img3_tmp = $_FILES['pro_img3']['tmp_name'];
           
           $pro_img4 = $_FILES['pro_img4']['name'];
           $pro_img4_tmp = $_FILES['pro_img4']['tmp_name'];
        
           move_uploaded_file($pro_img_tmp,"../uploads/products/$pro_img");
           move_uploaded_file($pro_img2_tmp,"../uploads/products/$pro_img2");
           move_uploaded_file($pro_img3_tmp,"../uploads/products/$pro_img3");
           move_uploaded_file($pro_img4_tmp,"../uploads/products/$pro_img4");
           
           $pro_price = $_POST['pro_price'];
           $pro_quantity = $_POST['pro_quantity'];
           $add_pro = $con->prepare("insert into product_tbl
           (
               pro_name, 
               cat_id, 
               pro_brand, 
               pro_img, 
               pro_img2, 
               pro_img3, 
               pro_img4, 
               pro_price, 
               pro_quantity,
               pro_keyword
            ) values
            (
                '$pro_name',
                '$cat_id',
                '$pro_brand',
                '$pro_img',
                '$pro_img2',
                '$pro_img3',
                '$pro_img4',
                '$pro_price',
                '$pro_quantity',
                '$pro_keyword'
            )");
            
           if($add_pro->execute())
           {
                echo "<script>alert('Product Added Successfully!');</script>"; 
           }
           else
           {
                echo "<script>alert('Product Not Added Successfully!');</script>";
           }
        }    
    }

    function viewall_cat()
    {   
        include("inc/db.php");
        $fetch_cat=$con->prepare("SELECT * from pet_prod");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();
                            
        while($row=$fetch_cat->fetch()):
            echo "<option value = '".$row['prod_id']."'>".$row['cat_name']."</option>";
        endwhile;
    }

    function viewall_category()
    {
        include("inc/db.php");
        $fetch_cat=$con->prepare("SELECT * from pet_prod ORDER BY cat_name");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();
        $i=1;

        while($row=$fetch_cat->fetch()):
            echo "<tr>
                    <td>".$i++."</td>
                    <td>".$row['cat_name']."</td>
                    <td style = 'width:5%'><a href='index.php?edit_cat=".$row['prod_id']."'><img src = '../uploads/edit 1.svg' class = 'catIcons'></a></td>
                    <td style = 'width:5%'><a href='delete_cat.php?delete_cat=".$row['prod_id']."'><img src = '../uploads/delete 1.svg' class = 'catIcons'></a></td>
                 </tr>";
        endwhile;
    }

    function count_orders()
    {
        include("inc/db.php");
        $count_orders = $con->prepare("SELECT * FROM orders_tbl");
        $count_orders->setFetchMode(PDO:: FETCH_ASSOC);
        $count_orders->execute();

        $count = $count_orders->rowCount();
        echo $count;
    }

    function count_deliveries()
    {
        include("inc/db.php");
        $count_orders = $con->prepare("SELECT * FROM delivery_tbl");
        $count_orders->setFetchMode(PDO:: FETCH_ASSOC);
        $count_orders->execute();

        $count = $count_orders->rowCount();
        echo $count;
    }

    function viewall_orders()
    {
        include("inc/db.php");

        $q = $con->query("
            SELECT od.order_id, od.delivery_status, od.total, GROUP_CONCAT(concat(od.pro_name, '(x', od.qty, ')') SEPARATOR ', ') items FROM
            (select o.order_id, p.pro_name, count(p.pro_name) qty, p.pro_price * qty total, o.delivery_status 
            from orders_tbl o join product_tbl p on o.pro_id = p.pro_id
            group by o.order_id, p.pro_name, o.delivery_status) od
            group by od.order_id, od.delivery_status
            ");
            $orders = $q->fetchAll(PDO::FETCH_ASSOC);
            foreach ($orders as $order) 
            {
                $order_id = $order['order_id'];
                echo
                "<form method = 'POST' enctype = 'multipart/form-data'>
                    <tr>
                        <input type = 'hidden' name = 'order_id' value = '".$order['order_id']."' />
                        <td>".$order_id."</td>";
                        $view_details = $con->prepare("SELECT * FROM orders_tbl WHERE order_id = '$order_id'");
                        $view_details->setFetchMode(PDO:: FETCH_ASSOC);
                        $view_details->execute();
            
                        $row = $view_details->fetch();
                        $user_id = $row['user_id'];
            
                        $fetch_username=$con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
                        $fetch_username->setFetchMode(PDO:: FETCH_ASSOC);
                        $fetch_username->execute();
            
                        $row_username = $fetch_username->fetch();
                        echo "
                        <input type = 'hidden' name = 'user_username' value = '".$row_username['user_username']."' />
                        <td>".$row_username['user_username']."</td>";
                    echo" 
                    <input type = 'hidden' name = 'items' value = '".$order['items']."' />
                    <td>".$order['items']."</td>
                    <td><input type = 'date' name = 'delivery_date' required/></td>
                    <td><button name = 'confirm_order' value = ".$order['order_id'].">Confirm</button>
                     <a href='cancel_order.php?order_id=".$order['order_id']."'>Cancel</a></td>
                    </tr>
                </form>";
            }
            if(isset($_POST['confirm_order']))
            {
                $order_id = $_POST['order_id'];
                $items = $_POST['items'];
                $user_username = $_POST['user_username'];
                $delivery_date = $_POST['delivery_date'];
                $delivery_status = "FOR DELIVERY!";

                $fetch_user=$con->prepare("SELECT * FROM users_table WHERE user_username = '$user_username'");
                $fetch_user->setFetchMode(PDO:: FETCH_ASSOC);
                $fetch_user->execute();
            
                $row_username = $fetch_user->fetch();

                $receiver = $row_username['user_email'];
                $subject = "Order Confirmation Mail";
                $body = "Your Order has been confirmed and it will be delivered on $delivery_date ,please keep your lines open!.";
                $sender = "ianjohn0101@gmail.com";

                if(mail($receiver, $subject, $body, $sender))
                {
                    $add_delivery = $con->prepare("INSERT INTO delivery_tbl
                    (
                        order_id, 
                        items, 
                        user_username, 
                        delivery_date, 
                        delivery_status
                    ) 
                    VALUES
                    (
                        $order_id,
                        '$items',
                        '$user_username',
                        '$delivery_date',
                        '$delivery_status'
                    )");
                    if($add_delivery->execute())
                    {
                        $update_status = $con->prepare("DELETE FROM orders_tbl WHERE order_id = '$order_id'");
                        $update_status->setFetchMode(PDO:: FETCH_ASSOC);
                        $update_status->execute();

                        if($update_status->execute())
                        {
                            echo "<script>alert('Item for delivery');</script>";
                            echo "<script>window.open('index.php?viewall_orders.php','_self');</script>";
                        }
                    }
                }
            }

        // $fetch_order = $con->prepare("SELECT * FROM orders_tbl ORDER BY transac_id");
        // $fetch_order->setFetchMode(PDO:: FETCH_ASSOC);
        // $fetch_order->execute();

        // $get_transac_id = [];

        // while($row = $fetch_order->fetch())
        // {
        //     $transac_id = $row["transac_id"]; 
        //     $get_transac_id[$transac_id][] = $row;  
        // }

        // foreach($get_transac_id as $id => $transac)
        // {
        //     $transaction_id = $id;
        //     $view_details = $con->prepare("SELECT * FROM orders_tbl WHERE transac_id = '$transaction_id'");
        //     $view_details->setFetchMode(PDO:: FETCH_ASSOC);
        //     $view_details->execute();

        //     $row = $view_details->fetch();
        //     $user_id = $row['user_id'];

        //     $fetch_username=$con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
        //     $fetch_username->setFetchMode(PDO:: FETCH_ASSOC);
        //     $fetch_username->execute();

        //     $row_username = $fetch_username->fetch();
        //     echo 
        //     "<tr>
        //     <td>".$id."</td>
        //     <td>".$row_username['user_username']."</td>
        //     <td></td>
        //     <td></td>
        //     <td><input type = 'date' name = 'delivery_date' /></td>
        //     <td><button name = 'confirm_order' >Confirm</button>
        //     </tr>";
        
        //     foreach($transac as $row)
        //     {
        //         $pro_id = $row['pro_id'];
        //         $user_id = $row['user_id'];

        //         $fetch_pro_name=$con->prepare("SELECT * FROM product_tbl WHERE pro_id = '$pro_id'");
        //         $fetch_pro_name->setFetchMode(PDO:: FETCH_ASSOC);
        //         $fetch_pro_name->execute();

        //         $row_pro_name = $fetch_pro_name->fetch();

               
        //         echo
        //         "<tr>
        //             <td></td>
        //             <td></td>
        //             <td>".$row_pro_name['pro_name']."</td>
        //             <td>".$row['qty']."</td>
        //         </tr>";
        //     }
        // }
        // $fetch_order = $con->prepare("SELECT o.transac_id, o.order_id, o.user_id, o.qty, o.pro_id, o.delivery_status FROM orders_tbl o JOIN product_tbl p on o.order_id = p.pro_id GROUP BY o.transac_id, p.pro_id");
        // $fetch_order->setFetchMode(PDO:: FETCH_ASSOC);
        // $fetch_order->execute();

        // // SELECT p.pro_id, p.pro_name, SUM(o.qty), o.delivery_status, o.user_id from orders_tbl o join product_tbl p on o.pro_id = p.pro_id group by p.pro_id, p.pro_name, o.delivery_status

        // while($row=$fetch_order->fetch()):
        //     $user_id = $row['user_id'];
        //     $pro_id = $row['pro_id'];

        //     $prod_name = $con->prepare("SELECT * FROM orders_tbl WHERE pro_id = '$pro_id'");
        //     $prod_name->setFetchMode(PDO:: FETCH_ASSOC);
        //     $prod_name->execute();
        //     $row_prod = $prod_name->fetch();

        //     $order_id = $row_prod['order_id'];

        //     $fetch_username=$con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
        //     $fetch_username->setFetchMode(PDO:: FETCH_ASSOC);
        //     $fetch_username->execute();

        //     $row_username = $fetch_username->fetch();

        //     $fetch_pro_name=$con->prepare("SELECT * FROM product_tbl WHERE pro_id = '$pro_id'");
        //     $fetch_pro_name->setFetchMode(PDO:: FETCH_ASSOC);
        //     $fetch_pro_name->execute();

        //     $row_pro_name = $fetch_pro_name->fetch();
        //         echo 
        //         "<form method = 'POST' enctype = 'multipart/form-data'>
        //            <tr>
        //                 <td>".$row['o.transac_id']."</td>
        //                 <input type = 'hidden' name = 'user_username' value = '".$row_username['user_username']."' />
        //                 <td>".$row_username['user_username']."</td>
                  
        //                 <input type = 'hidden' name = 'pro_name' value = '".$row_pro_name['pro_name']."' />
        //                 <td>".$row_pro_name['pro_name']."</td>
                      
        //                 <input type = 'hidden' name = 'qty' value = ".$row['qty']." />
        //                 <td>".$row['qty']."</td>
                  
        //                 <td><input type = 'date' name = 'delivery_date' /></td>
                  
        //                 <input type = 'hidden' name = 'confirm_order'/>
        //                 <td><button name = 'confirm_order' value = ".$row_prod['order_id'].">Confirm</button>
        //                 <a href='cancel_order.php?order_id=".$row_prod['order_id']."'>Cancel</a></td>
        //             </tr>
        //             <tr>
        //                 <td></td>
        //                 <td></td>
        //                 <td></td>     
        //                 <td><input type = 'hidden' name = 'total_amount' value = ".$row_pro_name['pro_price']*$row['qty']." /></td>
        //                 <td>Total: ".$row_pro_name['pro_price']*$row['qty']."</td>
        //             </tr>
        //         </form>";
        // endwhile;
        // if(isset($_POST['confirm_order']))
        // {
        //     $order_id = $_POST['confirm_order'];
        //     $user_username = $_POST['user_username'];
        //     $pro_name = $_POST['pro_name'];
        //     $qty = $_POST['qty'];
        //     $delivery_date = date('Y-m-d', strtotime($_POST['delivery_date']));
        //     $total_amount = $_POST['total_amount'];

        //     $view_status = $con->prepare("SELECT * FROM orders_tbl WHERE order_id = '$order_id'");
        //     $view_status->setFetchMode(PDO:: FETCH_ASSOC);
        //     $view_status->execute();

        //     $sql = $con->prepare("SELECT * FROM users_table WHERE user_username = '$user_username'");
        //     $sql->setFetchMode(PDO:: FETCH_ASSOC);
        //     $sql->execute();

        //     $row_user = $sql->fetch();
        //     var_dump($user_id = $row_user['user_id']);

        //     $receiver = $row_user['user_email'];
        //     $subject = "Order Confirmation Mail";
        //     $body = "Your Order has been confirmed and it will be delivered on $delivery_date ,please keep your lines open!.";
        //     $sender = "ianjohn0101@gmail.com";

        //     if(mail($receiver, $subject, $body, $sender))
        //     {
        //         $to_deliver = $con->prepare("INSERT INTO delivery_tbl SET 
        //                         pro_name = '$pro_name',
        //                         user_id = $user_id,
        //                         qty = $qty,
        //                         delivery_date = '$delivery_date',
        //                         total_amount = $total_amount,
        //                         delivery_status = 'FOR DELIVERY'
        //                         ");
        //         if($to_deliver->execute())
        //         {
        //             $update_status = $con->prepare("DELETE FROM orders_tbl WHERE order_id = '$order_id'");
        //             $update_status->setFetchMode(PDO:: FETCH_ASSOC);
        //             $update_status->execute();

        //             if($update_status->execute())
        //             {
        //                 echo "<script>alert('Item for delivery');</script>";
        //                 echo "<script>window.open('index.php?viewall_orders.php','_self');</script>";
        //             }
        //         }
        //     }
        // }
    }

    function viewalldelivered_items()
    {
        include("inc/db.php");
        $sql = $con->prepare("SELECT * FROM delivered_items");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();

        while($row = $sql->fetch()):
            $user_id = $row['user_id'];
            $view_user = $con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
            $view_user->setFetchMode(PDO:: FETCH_ASSOC);
            $view_user->execute();

            $row_user = $view_user->fetch();

            echo
            "<tr>
                <td>".$row['pro_name']."</td>
                <td>".$row_user['user_username']."</td>
                <td>".$row['date_delivered']."</td>
            </tr>";
        endwhile;
    }

    function viewall_deliveries()
    {
        include("inc/db.php");
        $sql = $con->prepare("SELECT * FROM delivery_tbl");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);
        $sql->execute();

        while($row = $sql->fetch()):

            echo 
            "<tr>
                <td>".$row['order_id']."</td>
                <td>".$row['items']."</td>
                <td>".$row['user_username']."</td>
                <td>".$row['delivery_date']."</td>
                <td><a href = 'confirm_delivery.php?confirm_delivery=".$row['delivery_id']."'>Confirm</td>
            </tr>";
            
        endwhile;
    }

    function confirm_delivery()
    {
        include("inc/db.php");
        if(isset($_GET['confirm_delivery']))
        {
            $delivery_id = $_GET['confirm_delivery'];

            $query = $con->prepare("SELECT * FROM delivery_tbl WHERE delivery_id = '$delivery_id'");
            $query->setFetchMode(PDO:: FETCH_ASSOC);
            $query->execute();

            $row = $query->fetch();
            $order_id = $row['order_id'];
            $items = $row['items'];
            $user_username = $row['user_username'];

            $fetch_user=$con->prepare("SELECT * FROM users_table WHERE user_username = '$user_username'");
            $fetch_user->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_user->execute();
        
            $row_username = $fetch_user->fetch();

            $datenow = getdate();

            $today = $datenow['year'] . '-' . $datenow['mon'] . '-' . $datenow['mday'];


            $reciever = $row_username['user_email'];
            $subject = "Coupon Code";
            $body = "Your Order has been delivered. Thank you for choosing our store!.";
            $sender = "ianjohn0101@gmail.com";

            if(mail($reciever, $subject, $body, $sender))
            {
                // $sql = $con->prepare("UPDATE delivery_tbl SET delivery_status = 'CONFIRMED', date_delivered = '$today' WHERE delivery_id = '$delivery_id'");
                // $sql->setFetchMode(PDO:: FETCH_ASSOC);
                $sql = $con->prepare("INSERT INTO delivered_items(order_id, items, user_username, date_delivered) VALUES('$order_id', '$items', '$user_username', '$today')");
                if($sql->execute())
                {
                  
                        $update_status = $con->prepare("DELETE FROM delivery_tbl WHERE delivery_id = '$delivery_id'");
                        $update_status->setFetchMode(PDO:: FETCH_ASSOC);
                        $update_status->execute();

                        if($update_status->execute())
                        {
                            echo "<script>alert('Item Delivered');</script>";
                            echo "<script>window.open('index.php?viewall_products.php','_self');</script>";
                        }
                   
                }
            }
        }
    }

    function viewall_sub_category()
    {
        include("inc/db.php");
        $fetch_cat=$con->prepare("SELECT * from sub_cat ORDER BY sub_cat_name");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();
        $i=1;

        while($row=$fetch_cat->fetch()):
            echo "<tr>
                    <td>".$i++."</td>
                    <td>".$row['sub_cat_name']."</td>
                    <td style = 'width:10%'><a href='index.php?edit_sub_cat=".$row['sub_cat_id']."'>Edit</a></td>
                    <td style = 'width:10%'><a href='delete_cat.php?delete_sub_cat=".$row['sub_cat_id']."'>Delete</a></td>
                 </tr>";
        endwhile;
    }
    
    function viewall_sub_cat()
    {
        include("inc/db.php");
        $fetch_sub_cat=$con->prepare("SELECT * from sub_cat");
        $fetch_sub_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_sub_cat->execute();
                            
        while($row=$fetch_sub_cat->fetch()):
            echo "<option value = '".$row['sub_cat_id']."'>".$row['sub_cat_name']."</option>";
        endwhile;
    }

    function view_all_products()
    {
        include("inc/db.php");
        $fetch_pro = $con->prepare("SELECT * from product_tbl");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        $i=1;

        while($row=$fetch_pro->fetch()):
            echo "<tr>
                <td>".$i++."</td>
                <td style = 'min-width:200px'>".$row['pro_name']."</td>
                <td>".$row['pro_brand']."</td>
                <td style = 'min-width:200px'>
                    <img src = '../uploads/products/".$row['pro_img']."'/>
                    <img src = '../uploads/products/".$row['pro_img2']."'/>
                    <img src = '../uploads/products/".$row['pro_img3']."'/>
                    <img src = '../uploads/products/".$row['pro_img4']."'/>
                </td>
                <td>".$row['pro_price']."</td>
                <td>".$row['pro_quantity']."</td>
                <td>".$row['pro_keyword']."</td>
                <td><a href='index.php?edit_prod=".$row['pro_id']."'>Edit</a></td>
                <td><a href='delete_cat.php?delete_prod=".$row['pro_id']."'>Delete</a></td>
         </tr>";
        endwhile;
    }

    function viewall_donations()
    {
        include("inc/db.php");

        $get_donations = $con->prepare("SELECT * FROM donations");
        $get_donations->setFetchMode(PDO:: FETCH_ASSOC);
        $get_donations->execute();

        while($row = $get_donations->fetch()):
            $org_id = $row['org_id'];

            $sql = $con->prepare("SELECT * FROM organizations WHERE id = '$org_id'");
            $sql->setFetchMode(PDO:: FETCH_ASSOC);
            $sql->execute();

            $row_org = $sql->fetch();
            $org_name = $row_org['org_name'];
            echo 
            "<form method = 'POST' enctype = 'multipart/form-data'>
                <tr>
                    <td><input type = 'hidden' name = 'transaction_number' value =".$row['transaction_number']."/></td>
                    <td>".$row['transaction_number']."</td>
                    
                    <td><input type = 'hidden' name = 'first_name' value = ".$row['first_name']." /></td>
                    <td><input type = 'hidden' name = 'last_name' value = ".$row['last_name']." /></td>
                    <td>".$row['last_name'].", ".$row['first_name']."</td>

                    <td><input type = 'hidden' name = 'org_name' value =".$org_name." /></td>
                    <td>".$org_name."</td>

                    <td><input type = 'hidden' name = 'contact_number' value =".$row['contact_number']." /></td>
                    <td>".$row['contact_number']."</td>

                    <td><input type = 'hidden' name = 'email_address' value =".$row['email_address']." /></td>
                    <td>".$row['email_address']."</td>

                    <td><input type = 'hidden' name = 'amount' value =".$row['amount']." /></td>
                    <td>".$row['amount']."</td>

                    <td><input type = 'hidden' name = 'proof_photo' value =".$row['proof_photo']." /></td>
                    <td>".$row['proof_photo']."</td>

                    <td><button name = 'confirm_donation' value = ".$row['id'].">Confirm</button></td>
                </tr>
            </form>";
        endwhile;
        if(isset($_POST['confirm_donation']))
        {
            $id = $_POST['confirm_donation'];

            $view_donation = $con->prepare("SELECT * FROM donations WHERE id = $id");
            $view_donation->setFetchMode(PDO:: FETCH_ASSOC);
            $view_donation->execute();

            $row = $view_donation->fetch();
            $receiver = $row['email_address'];
            $subject = "Coupon Code";
            $coupon_code = generateRandomString();
            $body = "Thanks for donating, as a gratitude of kindess we will give you a coupon code that will use as a discount to avail discount to the selected services. Your Coupon Code: $coupon_code";
            $sender = "ianjohn0101@gmail.com";

            if($row['donation_status'] == 'CONFIRMED')
            {
                echo "<script>alert('Donation Already Confirmed!');</script>";
                echo "<script>window.open('index.php?manage_donation','_self');</script>";
            }
            else
            {
                if(mail($receiver, $subject, $body, $sender))
                {
                    $transaction_number = $_POST['transaction_number'];
                    $first_name = $_POST['first_name'];
                    $last_name = $_POST['last_name'];
                    $amount = $_POST['amount'];
                    $org_name = $_POST['org_name'];
                    $contact_number = $_POST['contact_number'];
        
                    $datenow = getdate();
                    $today = $datenow['year'] . '-' . $datenow['mon'] . '-' . $datenow['mday'];
        
                    $add_ledger = $con->prepare("INSERT INTO ledger_tbl
                    (
                        transaction_number,
                        org_name,
                        first_name,
                        last_name,
                        contact_number,
                        date_confirmed
                    ) 
                    VALUES(
                        '$transaction_number',
                        '$org_name',
                        '$first_name',
                        '$last_name',
                        '$contact_number',
                        '$today'
                    )");
                    if($add_ledger->execute())
                    {
                        $update_status = $con->prepare("UPDATE donations SET donation_status = 'CONFIRMED', coupon_code = '$coupon_code' WHERE id = $id");
                        $update_status->setFetchMode(PDO:: FETCH_ASSOC);
                        $update_status->execute();
                        if($update_status->execute())
                        {
                            echo "<script>alert('Donation Confirmed!');</script>";
                            echo "<script>window.open('index.php?manage_donation','_self');</script>";
                        }
                    }
                }
            }

            // $view_email = $con->prepare("SELECT * FROM donations WHERE id = '$id'");
            // $view_email->setFetchMode(PDO:: FETCH_ASSOC);
            // $view_email->execute();

            //ledger db
            //transac number 
            //date confirmed
            //first name, last name
            //amount
            //org name

            // $row = $view_email->fetch();
            // $coupon_code = generateRandomString();
            
            // $receiver = $row['email_address'];
            // $subject = "Coupon Code";
            // $body = "Thanks for donating, as a gratitude of kindess we will give you a coupon code that will use as a discount to avail discount to the selected services. Your Coupon Code: $coupon_code";
            // $sender = "ianjohn0101@gmail.com";

            // if(mail($reciever, $subject, $body, $sender))
            // {
            //     $update_tbl = $con->prepare("UPDATE donations SET coupon_code = '$coupon_code', SET donation_status = 'Confirmed' WHERE id = '$id'");
            //     $update_tbl->setFetchMode(PDO:: FETCH_ASSOC);
            //     $update_tbl->execute();

            //     if($update_tbl->fetch())
            //     {
            //         echo "<script>alert('Donation Confirmed!');</script>";
            //         echo "<script>window.open('index.php?manage_donation','_self');</script>";
            //     }
            // }
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

    function showledger()
    {
        echo
        "<form method = 'GET' action = 'search_transaction_number.php' enctype = 'multipart/form-data'>
           Search Transaction Number: <input type = 'text' name = 'transaction_number' placeholder = 'Search Transaction Number..' />
           <button id = 'search_btn' name = 'search'>Search</button><br>
        </form>";

        include("inc/db.php");
        $show_ledger = $con->prepare("SELECT * FROM ledger_tbl");
        $show_ledger->setFetchMode(PDO:: FETCH_ASSOC);
        $show_ledger->execute();

        while($row = $show_ledger->fetch()):
          
            echo
            "<form method = 'POST' action = 'sort_org.php' enctype = 'multipart/form-data'>
            <tr>
                <td>".$row['transaction_number']."</td>
                <td>".$row['org_name']."</td>
                <td>".$row['last_name'].", ".$row['first_name']."</td>
                <td>".$row['contact_number']."</td>
                <td>".$row['date_confirmed']."</td>
            </tr>
            <button name = 'sort_asc'>Sort Asc by Org</button>
            <button name = 'sort_desc'>Desc Asc by Org</button>
        </form>";
        endwhile;
    }
    

    function search_transaction_number() 
    {
        include("inc/db.php");
        if(isset($_GET['search']) && isset($_GET['transaction_number']))
        {
            $transaction_number = $_GET['transaction_number'];
            $search_transaction_number = $con->prepare("SELECT * FROM ledger_tbl WHERE transaction_number LIKE '%$transaction_number%'");
            $search_transaction_number->setFetchMode(PDO:: FETCH_ASSOC);
            $search_transaction_number->execute();

            if($search_transaction_number->rowCount() > 0)
            {
               while($row = $search_transaction_number->fetch())
               {
                    echo 
                    "<tr>
                        <td>".$row['transaction_number']."</td>
                        <td>".$row['org_name']."</td>
                        <td>".$row['last_name'].", ".$row['first_name']."</td>
                        <td>".$row['contact_number']."</td>
                        <td>".$row['date_confirmed']."</td>
                    </tr>";
               }
            }
            else
            {
                echo
                "<h2>Transaction Number not Found!</h2>";
            }
        }
    }

    function viewall_coupons()
    {
        include("inc/db.php");
        $view_coupons = $con->prepare("SELECT * FROM donations");
        $view_coupons->setFetchMode(PDO:: FETCH_ASSOC);
        $view_coupons->execute();

        while($row = $view_coupons->fetch()):
            echo 
            "<tr>
                <td>".$row['last_name'].", ".$row['first_name']."</td>
                <td>".$row['email_address']."</td>
                <td>".$row['coupon_code']."</td>
            </tr>"; 
        endwhile;
    }

    function edit_cat() 
    {
        include("inc/db.php");
        if(isset($_GET['edit_cat']))
        {
            $cat_id = $_GET['edit_cat'];
            $fetch_cat_name = $con->prepare("SELECT * from pet_prod WHERE prod_id='$cat_id'");
            $fetch_cat_name->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_cat_name->execute();
            $row = $fetch_cat_name->fetch();

            echo "<h3>Edit Category</h3>
            <form method = 'POST'>
                <table>
                    <tr>
                        <td style='width:15%'>Category Name: </td>
                        <td style='width:60%'><input type='text' name = 'cat_name' value = '".$row['cat_name']."'/></td>
                        <td style='width:25%'><button name = 'update_cat'>Update</button></td>
                    </tr>
                </table>
            </form>";

            if(isset($_POST['update_cat']))
            {
                $cat_name = $_POST['cat_name'];
                $update_cat = $con->prepare("UPDATE pet_prod SET cat_name='$cat_name' WHERE prod_id = '$cat_id'");
                
                if($update_cat->execute())
                {
                    echo "<script>alert('Category Updated Successfully!');</script>";
                    echo "<script>window.open('index.php?viewall_cat','_self');</script>";
                }
            }
        }
    }

    function viewall_users()
    {
        include("inc/db.php");
        $fetch_pro = $con->prepare("SELECT * from users_table");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        $i=1;

        while($row=$fetch_pro->fetch()):
            echo "<tr>
                <td>".$i++."</td>
                <td style = 'min-width:200px'>".$row['user_username']."</td>
                <td>".$row['user_email']."</td>
                <td>".$row['user_contactnumber']."</td>
                <td>".$row['user_address']."</td>
                <td style = 'min-width:200px'>
                    <img src = '../uploads/user_profile/".$row['user_profilephoto']."'/>
                </td>
                <td><a href='#'>Edit</a></td>
                <td><a href='#'>Delete</a></td>
         </tr>";
        endwhile;
    }

    function edit_prod()
    {
        include("inc/db.php");
        if(isset($_GET['edit_prod']))
        {
            $pro_id = $_GET['edit_prod'];
            $fetch_pro_name = $con->prepare("SELECT * from product_tbl WHERE pro_id='$pro_id'");
            $fetch_pro_name->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_pro_name->execute();
            $row = $fetch_pro_name->fetch();
            $cat_id = $row['cat_id'];
            $sub_cat_id = $row['sub_cat_id'];

            $fetch_cat = $con->prepare("SELECT * from pet_prod WHERE prod_id='$cat_id'");
            $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_cat->execute();
            $row_cat = $fetch_cat->fetch();
            $cat_name = $row_cat['cat_name'];

            $fetch_sub_cat = $con->prepare("SELECT * from sub_cat WHERE sub_cat_id='$sub_cat_id'");
            $fetch_sub_cat->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_sub_cat->execute();
            $row_sub_cat = $fetch_cat->fetch();
            $sub_cat_name = $row_sub_cat['sub_cat_name'];

            echo "<h3>Edit Product</h3>
            <form method = 'POST'>
                <table>
                    <tr>
                        <td>Update Category Name: </td>
                        <td>
                            <select name = 'cat_name'>
                                <option value = '".$row['cat_id']."'>".$cat_name."</option>
                                ";echo viewall_cat(); echo"
                            </select>
                        </td>
                    </tr>
                   <tr>
                        <td>Update Sub-Category Name: </td>
                        <td>
                            <select name = 'sub_cat_name'>
                                <option value = '".$row['sub_cat_id']."'>".$sub_cat_name."</option>
                                ";echo viewall_sub_cat(); echo"
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Product Name: </td>
                        <td><input type='text' name = 'pro_name' value = '".$row['pro_name']."'/></td>
                    </tr>
                    <tr>
                        <td>Product Brand: </td>
                        <td><input type='text' name = 'pro_brand' value = '".$row['pro_brand']."'/></td>
                    </tr>
                    <tr>
                        <td>Product Price: </td>
                        <td><input type='text' name = 'pro_price' value = '".$row['pro_price']."'/></td>
                    </tr>
                    <tr>
                        <td>Product Quantity: </td>
                        <td><input type='text' name = 'pro_quantity' value = '".$row['pro_quantity']."'/></td>
                    </tr>
                    <tr>
                        <td>Product Keyword: </td>
                        <td><input type='text' name = 'pro_keyword' value = '".$row['pro_keyword']."'/></td>
                    </tr>
                    <tr>
                        <td>Update 1st Product Image: </td>
                        <td>
                            <input type='file' name = 'pro_img'/>
                            <img src = '../uploads/products/".$row['pro_img']."'  />
                        </td>
                    </tr>
                    <tr>
                        <td>Update 2nd Product Image: </td>
                        <td>
                            <input type='file' name = 'pro_img2'/>
                            <img src = '../uploads/products/".$row['pro_img2']."' />
                        </td>
                    </tr>
                    <tr>
                        <td>Update 3rd Product Image: </td>
                        <td>
                            <input type='file' name = 'pro_img3'/>
                            <img src = '../uploads/products/".$row['pro_img3']."' />
                        </td>
                    </tr>
                    <tr>
                        <td>Update 4th Product Image: </td>
                        <td>
                            <input type='file' name = 'pro_img4'/>
                            <img src = '../uploads/products/".$row['pro_img4']."' />
                        </td>
                    </tr>
                    
                   
                </table>
                <button name = 'update_prod'>Update Product</button>
            </form>";

            if(isset($_POST['update_prod']))
            {
                $pro_name = $_POST['pro_name'];
                $pro_brand = $_POST['pro_brand'];
                $pro_quantity = $_POST['pro_quantity'];
                $pro_price = $_POST['pro_price'];
                $pro_img = $_POST['pro_img'];
                $pro_img2 = $_POST['pro_img2'];
                $pro_img3 = $_POST['pro_img3'];
                $pro_img4 = $_POST['pro_img4'];
                $pro_keyword = $_POST['pro_keyword'];
                $update_prod = $con->prepare("UPDATE product_tbl 
                SET 
                pro_name='$pro_name',
                pro_brand = '$pro_brand',
                pro_quantity = '$pro_quantity',
                pro_price = '$pro_price',
                pro_img = '$pro_img',
                pro_img2 = '$pro_img2',
                pro_img3 = '$pro_img3',
                pro_img4 = '$pro_img4',
                pro_keyword = '$pro_keyword'
                WHERE 
                pro_id = '$pro_id'");
                
                if($update_prod->execute())
                {
                    echo "<script>alert('Product Updated Successfully!');</script>";
                    echo "<script>window.open('index.php?viewall_products','_self');</script>";
                }
            }
        }
    }

    function delete_cat()
    {
        include("inc/db.php");

        $delete_cat_id = $_GET['delete_cat'];
        $delete_cat  = $con->prepare("delete from pet_prod where prod_id = '$delete_cat_id'");
        if($delete_cat->execute())
        {
            echo "<script>alert('Category Deleted Successfully!');</script>";
            echo "<script>window.open('index.php?viewall_cat','_self');</script>";
        }
    }

    function delete_sub_cat()
    {
        include("inc/db.php");

        $delete_sub_cat_id = $_GET['delete_sub_cat'];
        $delete_sub_cat  = $con->prepare("delete from sub_cat where sub_cat_id = '$delete_sub_cat_id'");
        if($delete_sub_cat->execute())
        {
            echo "<script>alert('Sub Category Deleted Successfully!');</script>";
            echo "<script>window.open('index.php?viewall_sub_cat','_self');</script>";
        }
    }

    function delete_prod()
    {
        include("inc/db.php");

        $delete_product_id = $_GET['delete_prod'];
        $delete_prod  = $con->prepare("delete from product_tbl where pro_id = '$delete_product_id'");
        if($delete_prod->execute())
        {
            echo "<script>alert('Product Deleted Successfully!');</script>";
            echo "<script>window.open('index.php?viewall_products','_self');</script>";
        }
    }


?>
    

    
