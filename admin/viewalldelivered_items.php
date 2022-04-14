<div class = "scroll" id ="bodyright">
    <h3>Sales Inventory</h3>
    <form method = "POST" enctype = "multipart/form-data">
    <table>
        <tr>
  
            <th>Product Name</th>
            <th>User Name</th>
            <th>Date Delivered</th>
        </tr>
        <tr>
            <?php
                echo viewalldelivered_items();
            ?>
        </tr>
        </table>
    </form>
</div>

