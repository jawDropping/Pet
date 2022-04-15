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
            echo "<div id='bodyleft'>";
            add_service();
                  echo"</div>";
           
        ?>
    </body>
</html>



<!-- <div id ='signUpForm'>
    <div class='signUpForm'>
        <h3>Add Service</h3>
            <form method = 'POST' enctype = 'multipart/form-data'>
                <table>
                    <tr>
                        <td>Name: </td>
                        <td><input type='text' name = 'services_name' /></td>
                    </tr>
                    <tr>
                        <td>Location: </td>
                        <td><input type='text' name =  'services_loc' /></td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td><input type='text' name =  'services_email' /></td>
                    </tr>
                    <tr>
                        <td>Contact Number: </td>
                        <td><input type='text' name =  'services_contact_number' /></td>
                    </tr>
                    <tr>
                        <td>Service Day From: </td>
                        <td>
                            <select name = "day_open">
                                <?php
                                     include("inc/function.php");
                                    call_user_func('days');
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Service Day To: </td>
                        <td>
                            <select name = "day_close">
                                <?php
                                    call_user_func('days');
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Time Open: </td>
                        <td><input type="time" name =  'time_open' /></td>
                    </tr>
                    <tr>
                        <td>Time Close: </td>
                        <td><input type="time" name =  'time_close' /></td>
                    </tr>
                    <tr>
                        <td>Service Cost: </td>
                        <td><input type="text" name =  'service_cost' /></td>
                    </tr>
                    <tr>
                        <td>Photo: </td>
                        <td><input type='file' name =  'service_photo' /></td>
                    </tr> -->
                    <!-- <tr>
                        <td>Accept Coupons: </td>
                        <td>
                            <input type="checkbox" id="chkCoupon" onclick="ShowHideDiv(this)" /> Yes
                        </td>  
                        <td id = "coupon_code" style = "display:none; margin-left: -200px">
                            Coupon Code: <input type ='text' name = 'coupon_code' value = <?php echo generateRandomString(); ?> readonly/><button>Generate Another Code</button>
                        </td>
                    </tr> -->
                    <!-- <tr>
                        <td>Select Category:</td>
                        <td>
                            <select>
                                
                            </select>
                        </td>
                    </tr>
                
                </table>
                <button name = 'add_service'>Add Service</button>
            </form>
        </div>
    </div>
<?php
    call_user_func('add_service');
?> -->

<!-- <script type="text/javascript">
    function ShowHideDiv(chkCoupon) {
        var coupon_code = document.getElementById("coupon_code");
        coupon_code.style.display = chkCoupon.checked ? "block" : "none";
    }
</script>  -->