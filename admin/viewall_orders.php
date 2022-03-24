<div class = "scroll" id ="bodyright">
    <h3>View All Orders</h3>
    <form method = "POST" enctype = "multipart/form-data">
    <table>
        <tr>
            <th>User </th>
            <th>Product Name</th>
            <th>Product Quantity</th>
            <th>Total Amount</th>
            <th>Action</th>
        </tr>
        <tr>
            <?php
              include("inc/db.php");
              $fetch_order=$con->prepare("SELECT * FROM orders_tbl ORDER BY order_id");
              $fetch_order->setFetchMode(PDO:: FETCH_ASSOC);
              $fetch_order->execute();
      
              while($row=$fetch_order->fetch()):
              $user_id = $row['user_username'];
              $pro_id = $row['pro_name'];
      
              $fetch_username=$con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
              $fetch_username->setFetchMode(PDO:: FETCH_ASSOC);
              $fetch_username->execute();
      
              $row_username = $fetch_username->fetch();
      
              $fetch_pro_name=$con->prepare("SELECT * FROM product_tbl WHERE pro_id = '$pro_id'");
              $fetch_pro_name->setFetchMode(PDO:: FETCH_ASSOC);
              $fetch_pro_name->execute();
      
              $row_pro_name = $fetch_pro_name->fetch();
                  echo 
                  "<tr>
                      <td>".$user_id."</td>
                      <td>".$pro_id."</td>
                      <td>".$row['qty']."</td>
                      <td>".$row['total_amount']."</td>
                      <td><a href = 'confirm_order.php?confirm_order=".$row['order_id']."'<button>Confirm</button></a></td>
                  </tr>";
              endwhile;
            ?>
        </tr>
        </table>
    </form>
</div>