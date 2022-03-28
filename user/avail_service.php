<?php  
    include("inc/db.php");
    if(isset($_GET['avail_service']))
    {
        $service_id = $_GET['avail_service'];
        $sql = $con->prepare("SELECT * FROM services WHERE service_id = '$service_id'");
        $sql->setFetchMode(PDO:: FETCH_ASSOC);

        $row_service = $sql->fetch();

        echo 
        "<form method = 'POST' enctype = 'multipart/form-data'>
        <tr>
            <td>Service Cost: </td>
            <td><input type = 'hidden' name = 'service_cost' value = ".$row_service['service_cost']."</td>
            <td>".$row_service['service_cost']."</td>
        </tr>
        <tr>
            <td>Date and Time Reservation: </td>
            <td><input type ='datetime-local' name = 'reservation_date' /></td>
        </tr>
        <tr>
               <td>Accept Coupons: </td>
               <td>
                    <input type='checkbox' id='chkCoupon' onclick='ShowHideDiv(this)' /> Yes
                </td>  
                <td id = 'coupon_code' style = 'display:none; margin-left: -200px'>
                    Coupon Code: <input type ='text' name = 'coupon_code' value = ".generateRandomString()." readonly/><button>Generate Another Code</button>
                </td>
        </tr> -->
        <tr>
            <a href = 'reserve_service.php'>Reserve</a>
        </tr>
        </form>";
    }
?>

<?php
    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    ?>

<script type="text/javascript">
    function ShowHideDiv(chkCoupon) {
        var coupon_code = document.getElementById("coupon_code");
        coupon_code.style.display = chkCoupon.checked ? "block" : "none";
    }
</script>