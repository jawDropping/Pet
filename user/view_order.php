<div class = "scroll" id ="bodyright">
    <h3>My Order</h3>
    <form method = "POST" enctype = "multipart/form-data">
    <table>
        <tr>
            <th>Product:</th>
            <th>Quantity</th>
            <th>Total Amount</th>
            <th>Cancel</th>
        </tr>
        <tr>
            <?php
                 include("inc/function.php");
                 call_user_func('view_orders');
            ?>
        </tr>
        <a href = 'index.php'>Go Home</a>
        </table>
    </form>
</div>


