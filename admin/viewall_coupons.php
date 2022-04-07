<div class = "scroll" id ="bodyright">
    <h3>Coupons: </h3>
    <form method = "POST" enctype = "multipart/form-data">
    <table>
        <tr>
            <th>Full Name</th>
            <th>Email Address</th>
            <th>Coupon</th>
        </tr>
        <tr>
            <?php
                echo viewall_coupons();
            ?>
        </tr>
        </table>
    </form>
</div>



