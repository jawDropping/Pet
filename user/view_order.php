<div class = "scroll" id ="bodyright">
    <h3>My Order</h3>
    <table>
        <tr>
            <th>Product:</th>
            <th>Quantity</th>
            <th>Order Status</th>
            <th>Action</th>
        </tr>
        <tr>
            <?php
                 include("inc/function.php");
                 call_user_func('view_orders');
            ?>
        </tr>
        <a href = 'index.php'>Go Home</a>
        </table>
</div>


