<?php
    include("inc/db.php");

    if(isset($_GET['return_delivery']))
    {
        $id = $_GET['return_delivery'];
        
        // $q = $con->query("
        //     SELECT od.order_id, od.order_date, od.delivery_status, sum(od.qty * od.price), GROUP_CONCAT(concat(od.pro_name, '(x', od.qty, ')') SEPARATOR ', ') items FROM
        //     (select o.order_id, p.pro_name, count(p.pro_name) qty, p.pro_price price, o.delivery_status, o.order_date
        //     from orders_tbl o join product_tbl p on o.pro_id = p.pro_id
        //     WHERE o.user_id = o.user_id
        //     group by o.order_id, p.pro_name, o.delivery_status, o.order_date) od
        //     group by od.order_id, od.delivery_status, od.order_date    
        //     ");
        $query = $con->query("SELECT * FROM delivery_tbl WHERE delivery_id = '$id'");
        $query->setFetchMode(PDO:: FETCH_ASSOC);
        $query->execute();

        $row = $query->fetch();

        echo $items = $row['items'];

    }
?>