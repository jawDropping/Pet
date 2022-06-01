<?php
    include("inc/db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

<?php

    if(isset($_GET['notf']))
    {
        $delivery_id = $_GET['notf'];
        $sql2 = $con->query("UPDATE delivery_tbl SET nread='0' WHERE delivery_id = '$delivery_id'");
        header("Location:notification.php");
    }
    $sql = $con->query("SELECT * FROM delivery_tbl");
    $new_data = $con->query("SELECT * FROM delivery_tbl WHERE nread=1");
    $count = $new_data->rowCount();
?>
<div class = "dropdown">
    <button class = "btn btn-primary dropdown-toggle" type = "button" data-toggle="dropdown">Notification
    <?php 
    $zero = "0";
    if($count > 0)
    { 
        echo "(".$count.")";
    }
    else
    {
        echo "(".$zero.")";
    }
    ?>
    <span class = "caret"></span></button>
    <ul class = "dropdown-menu">
        <?php
        foreach($sql as $value)
        {
        ?>

        <?php
            if($value['nread'] == '1'){
                $id = $value['delivery_id'];
        ?>

        <li class = "alert-danger"><a href="notification.php?notf=<?php echo $id?>"><?php echo "Your order has been confirmed and will be delivered on ".$value['delivery_date'].""; ?></a></li>

        <?php
            }else{
        ?>

       <li><a><?php echo "Your order has been confirmed and will be delivered on ".$value['delivery_date'].""; ?></a></li>

        <?php
            }
        }
        ?>
    </ul>
</div>


<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>