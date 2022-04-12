<div class = "scroll" id ="bodyright">
    <h3>View All Deliveries</h3>
    <form method = "POST" enctype = "multipart/form-data">
    <table>
        <tr>
  
            <th>User Name</th>
            <th>Qty</th>
            <th>Total Amount</th>
            <th>Delivery Date: </th>
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

