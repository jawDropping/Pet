<div class = "scroll" id ="bodyright">
    <h3>Ledger</h3>
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
                include("inc/function.php");
                echo search_transaction_number();
            ?>
        </tr>
        </table>
    </form>
</div>