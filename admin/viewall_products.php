<div class = "scroll" id ="bodyright">
    <h3>View All Deliveries</h3>
    <form method = "POST" enctype = "multipart/form-data">
    <table>
        <tr>
  
            <th>Order Id</th>
            <th>Items</th>
            <th>Total Amount</th>
            <th>Customer</th>
            <th>Delivery Address</th>
            <th>Delivery Date </th>
            <th>Action</th>
        </tr>
        <tr>
            <?php
                echo viewall_deliveries(); 
            ?>
        </tr>
        </table>
    </form>
</div>

