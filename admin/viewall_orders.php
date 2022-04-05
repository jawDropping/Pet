<div class = "scroll" id ="bodyright">
    <h3>View All Orders</h3>
    <form method = "POST" enctype = "multipart/form-data">
    <table>
        <tr>
    
            <th>User </th>
     
            <th>Product Name</th>
        
            <th>Product Quantity</th>

            <th>Delivery Date</th>
           
            <th>Action</th>
        </tr>
        <tr>
            <?php
                echo viewall_orders();
            ?>
        </tr>
        </table>
    </form>
</div>