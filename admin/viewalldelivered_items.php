<div class = "scroll" id ="bodyright">
    <h3>Transaction History</h3>
    <form method = "POST" enctype = "multipart/form-data">
    <table>
        <tr>
  
            <th>ORDER ID</th>
            <th>ITEMS</th>
            <th>CUSTOMER</th>
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

