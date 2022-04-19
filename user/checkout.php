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
            include ("inc/function.php");
            include ("inc/header.php"); 
            include ("inc/navbar.php"); 
        ?>
        <div class="mainDiv">

        <?php
    if(!isset($_SESSION['user_username']))
    {
        header("Location: login.php");
    }
    else
    {
        include("inc/db.php");
        $user_username = $_SESSION['user_username'];
        $fetch_user_username = $con->prepare("SELECT * FROM users_table WHERE user_username = '$user_username'");
        $fetch_user_username->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_user_username->execute();

        $display_cart = $con->prepare("SELECT * FROM product_tbl WHERE pro_id IN (".implode(',',$_SESSION['cart']).")");
        $display_cart->setFetchMode(PDO:: FETCH_ASSOC);
        $display_cart->execute();
    
        $row_user = $fetch_user_username->fetch();
        $net_total = 0;
       echo "<div id = 'headist'><img src='../uploads/orderCheckout.png' id = 'ordPic'>Order Details</div>";
        while($row = $display_cart->fetch()):
            $qty = array_count_values($_SESSION['cart'])[$row['pro_id']];
            $pro_price = $row['pro_price'];
            $sub_total = $qty * $pro_price; 
        echo 
        "<form method = 'POST'  enctype = 'multipart/form-data'>
            <div class = checkoutTab>
                ";
                echo"</tr>
                <div class = 'info'>
                    <div class = 'innerInfo'>
                    <p id='confLine'>Please Check Your Personal Information</p>
                    <br>
                    <p><img src= '../uploads/informate.png' id = 'locatePng'>Contact Details</p>
                    <div id ='editinfo' style = 'margin-left:90%;'>
                    <p><img src= '../uploads/pencil.png' id = 'locatePng'><a href = 'myProfile.php' style = 'text-decoration:none;color:#000;font-family: Verdana, Geneva, Tahoma, sans-serif;'>Edit Info</a></p>
                </div>
                <div id = 'locationDiv'>
                <div id = 'groupContainer'>
                <div class = 'group'>
                    <p class = 'tag'>Contact Number: </p>
                    <input type = 'text' class = 'inputed' name = 'user_contactnumber' value = ".$row_user['user_contactnumber']." disabled/>
                </div>
                <div class = 'group'>
                    <p class = 'tag'>Email Address: </p>
                    <td><input type = 'text' class = 'inputed' name = 'user_email' value = ".$row_user['user_email']." disabled/></td>
                   </div>
                </div>
                </div>
                <tr>
                <div id = 'locationDiv'>
                    <p><img src = '../uploads/icon.png' id = 'locatePng'>Location </p>
                    <div id = 'groupContainer'>
                    <div class = 'group'>
                    <p class = 'tag'>Street </p>
                    <input type = 'text' class = 'inputed' name = 'user_address' value = ".$row_user['user_address']." disabled/>
                    </div>
                    <div class = 'group'>
                    <p class = 'tag'>Brgy </p>
                    <input type = 'text' class = 'inputed' name = 'user_address' value = ".$row_user['barangay']." disabled/>
                    </div>
                    <div class = 'group'>
                    <p class = 'tag'>Municipality </p>
                    <input type = 'text' class = 'inputed' name = 'user_address' value = ".$row_user['municipality']." disabled/>
                    </div>
                    </div>
                    </div>
                </tr>
                </div>
                </div>";
                
                echo " <div id = 'productDet'>
                        <div id = 'innerproductDet'>
                        <p>Product Details</p>
                        <div id = 'groupContainer'>
                        <div class = 'group'>
                   <p class = 'tag'>Product Name</p>";
                echo"
                    
                    <input class = 'useless' type = 'hidden' name = 'pro_id' value = ".$row['pro_id']." />
                    <input class = 'inputed' type = 'text' name = 'pro_id' value = ".$row['pro_name']." disabled/>
                    </div>
                    <div class = 'group'>
                    <p class = 'tag'>Qty: </p>
                    <input class = 'inputed' type = 'text' name = 'qty' value = ".array_count_values($_SESSION['cart'])[$row['pro_id']]." disabled/></td>
                    </div>
                ";
                if($row_user['municipality'] == "mandaue")
                {  
                    $net_total = $net_total + 10 + $sub_total;
                }
                elseif($row_user['municipality'] == "cebu")
                {
                    $net_total = $net_total + 12 + $sub_total;
                }
               
        endwhile;
                if($row_user['municipality'] == "mandaue")
                {  
                    echo 
                    "<div class = 'group'>
                    <p class = 'tag'>Delivery Fee:</p>
                    <input class = 'inputed' type= 'text' value= 'P10.00' disabled>
                    </div>";
                }
                elseif($row_user['municipality'] == "cebu")
                {
                    echo
                    "<div class = 'group'>
                    <p class = 'tag'>Delivery Fee:</p>
                    <input class = 'inputed' type= 'text' value= 'P12.00' disabled>
                    </div>";
                }
                else
                {
                    echo
                    "<div class = 'group'>
                    <p class = 'tag'>Delivery Fee:</p>
                    <input class = 'inputed' type= 'text' value= 'P0.00' disabled>
                    </div>";
                }
                echo "</tr>
                <div class = 'group'>
                <p class = 'tag'>Total Amount:</p>
                <input class = 'inputed' type = 'text' value = ' P".$net_total."' disabled/>
                </div>";
                echo"
            </div>
            </div>
            </div>
            <div class='btnSection'>
                <button class = 'place' name = 'confirm'><a id = 'placelink'href = 'payorder.php'> Confirm Order</a></button>
                <button class = 'cancelBtn'><a href = 'cart.php'> Cancel </a></button>
            </div>
            <br>
        </form>";
    }
    
?>


</div>
   
</body>

<style>
    *{
        padding: 0;
        margin: 0;
    }
    #ordPic{
        height: 30px;
        margin-right: 10px;
    }
    .useless{
        display: none;
    }
    .mainDiv{
        width: 90%;
        margin-left: 5%;
    }
    #headist{
        margin-top: 10px;
     font-size: 22px;
    }
    #confLine{
        font-size: 14px;
        background: #ffb830;
        padding: 5px;
    }
    
    .info{
        margin-top: 10px;
    }
    .info{
        background: white;
        border-radius: 5px;
        width: 100%;
        margin-bottom: 30px;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    }
    .innerInfo{
        padding: 10px;
    }
    
    #productDet{
        background: white;
        width: 100%;
        border-radius: 5px;
        border: 1px solid #0080fe;
    }
    #innerproductDet{
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 30px;
        padding-top: 20px;
    }
    .btnSection{
        margin-right: 15%;
        height: 45px;
        width: 100%;
        display: flex;
        justify-content: right;
        margin-top: 30px;
    }
    .place{
        background: #ffb830;
        outline: none;
        border: none;
        width: 150px;
        padding: 10px;
        border-radius: 10px;
        margin-right: 10px;
        color: white;
        font-weight: bold;
        
        
    }
    #placelink{
        text-decoration: none;
        color: white;
    }
    .cancelBtn{
        background: white;
        outline: none;
        border: 1px solid  #ffb830;
        color:  gray;
        font-weight: bold;
        padding: 10px;
        width: 120px;
        border-radius: 10px;
       
    }
    .cancelBtn a{
        text-decoration: none;
        color:  gray;
        font-weight: bold;
    }
    #locatePng{
        height: 15px;
    }
    #locationDiv{
        
        margin-top: 10px;
    }
    .group{
        
        display: grid;
        grid-template-columns: 10% 50%;
        gap: 20px;
        

    }
    #groupContainer{
        width: 90%;
        margin-left: 20px;
        margin-top: 20px;
    }
    .inputed{
        height: 42px;
        border: none;
        border: 1px solid #ddd;
        margin-bottom: 10px;
        padding: 4px;
    }
    .tag{
        font-size: 12px;
        color: gray;
        text-align: right;
        padding-top: 15px;
    }
    .ttl{
        width: 60%;
    }
</style>
</html>