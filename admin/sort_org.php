<?php
    include("inc/db.php");
    if(isset($_POST['sort_asc']))
    {
        $sort_org = $con->prepare("SELECT * FROM ledger_tbl ORDER BY org_name ASC");
        $sort_org->setFetchMode(PDO:: FETCH_ASSOC);
        $sort_org->execute();

        while($row = $sort_org->fetch()):
            echo 
            "<tr>
            <td>".$row['transaction_number']."</td>
            <td>".$row['org_name']."</td>
            <td>".$row['last_name'].", ".$row['first_name']."</td>
            <td>".$row['contact_number']."</td>
            <td>".$row['date_confirmed']."</td>
        </tr>";
        endwhile;
    }

    if(isset($_POST['sort_desc']))
    {
        $sort_org = $con->prepare("SELECT * FROM ledger_tbl ORDER BY org_name DESC");
        $sort_org->setFetchMode(PDO:: FETCH_ASSOC);
        $sort_org->execute();

        while($row = $sort_org->fetch()):
            echo 
            "<tr>
            <td>".$row['transaction_number']."</td>
            <td>".$row['org_name']."</td>
            <td>".$row['last_name'].", ".$row['first_name']."</td>
            <td>".$row['contact_number']."</td>
            <td>".$row['date_confirmed']."</td>
        </tr>";
        endwhile;
    }
?>