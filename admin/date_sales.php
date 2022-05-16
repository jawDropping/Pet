<?php
    include("inc/db.php");

    $date = $_GET['date'];
    $sql = $con->prepare("SELECT * FROM delivered_items WHERE date_delivered = '$date'");
    $sql->setFetchMode(PDO:: FETCH_ASSOC);
    $sql->execute();

    $row = $sql->rowCount();
   
    if($row>0)
    {
        while($rows = $sql->fetch()):
            echo
        "<tr>
            ".$rows['order_id']."
            ".$rows['items']."
            ".$rows['user_username']."
            ".$rows['date_delivered']."
            ".$rows['total_amount']."
        </tr>";
        endwhile;
    
    }
    else
    {
        echo "NO RECORD FOUND!";
    }
    
?>