<?php
    include("inc/db.php");

    if(isset($_GET['reviews']))
    {   
        $service_id = $_GET['reviews'];

        $sql = $con->prepare("SELECT * FROM feedback_tbl WHERE service_id = '$service_id'");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        echo
        "Comments: <br>";
        while($row = $sql->fetch()):
            $user_id = $row['user_id'];

            $sql2 = $con->prepare("SELECT * FROM users_table WHERE user_id = '$user_id'");
            $sql2->setFetchMode(PDO::FETCH_ASSOC);
            $sql2->execute();

            $row2 = $sql2->fetch();
            echo
            
            "<tr>
            <td>".$row2['user_username'].":".$row['comment']."<br></td>
            </tr>";
        endwhile;

        $sql3 = $con->prepare("SELECT AVG(rating) FROM review WHERE service_id = '$service_id'");
        $sql3->setFetchMode(PDO::FETCH_ASSOC);
        $sql3->execute();

        $row3 = $sql3->fetch();

        echo 
        "<td>Average Rating:".$row3['AVG(rating)']."</td>";
    }
?>