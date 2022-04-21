<div class = "scroll" id ="bodyright">
    <h3>View All Orders</h3>
    <form method = "POST" enctype = "multipart/form-data">
    <table>
        <tr>
    
            <th>ORDER ID </th>

            <th>USER</th>
     
            <th>ITEMS</th>

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