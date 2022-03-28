<div class = "scroll" id ="bodyright">
    <h3>View All Products</h3>
    <form method = "POST" enctype = "multipart/form-data">
    <table>
        <tr>
            <th style="width:5%">Product Id</th>
            <th>Product Name</th>
            <th>Product Brand</th>
            <th>Product Images</th>
            <th>Product Price</th>
            <th>Product Quantity</th>
            <th>Product Key Word</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <tr>
            <?php
                echo viewall_deliveries(); 
            ?>
        </tr>
        </table>
    </form>
</div>

