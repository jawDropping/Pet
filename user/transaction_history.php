
<div class = "scroll" id ="bodyright">
    <h3>Transaction History</h3>
    <table>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Date Delivered</th>
        </tr>
        <tr>
            <?php
                 include("inc/function.php");
                 viewall_transactions();
            ?>
        </tr>
        <a href = 'index.php'>Go Home</a>
        </table>
</div>


