<div class = "scroll" id ="bodyright">
    <h3>View All Orders</h3>
    <form method = "POST" enctype = "multipart/form-data">
    <table>
        <tr>
    
            <th>PRODUCT NAME </th>

            <th>PRODUCT QUANTITY</th>
     
            <th>SAMPLE IMAGE #1</th>

            <th>SAMPLE IMAGE #2</th>

            <th>SAMPLE IMAGE #3</th>
           
            <th>SAMPLE IMAGE #4</th>

            <th>PRODUCT PRICE</th>

            <th>Action</th>
        </tr>
        <tr>
            <?php
                echo view_prods();
            ?>
        </tr>
        </table>
    </form>
</div>