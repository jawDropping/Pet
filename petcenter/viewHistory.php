<div class = "scroll" id ="bodyright">
    <h3>Services History</h3>
    <form method = "POST" enctype = "multipart/form-data">
    <table>
        <tr>
            <th>User Name</th>
            <th>Coupon Code</th>
            <th>Transaction Code</th>
            <th>Amount</th>
            <th>Date Confirmed</th>
        </tr>
        <tr>
            <?php
                include ("inc/function.php");
                call_user_func('viewHistory'); 
            ?>
        </tr>
        </table>
    </form>
</div>

