<html>
    <head>
        <title>Pet Society</title>
        <link rel = "stylesheet" href="css/style.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Fredoka+One&family=Open+Sans:wght@500&family=Palette+Mosaic&family=Rubik:wght@500&family=Varela+Round&display=swap" rel="stylesheet">
    </head>

    <body>
       
        <?php 
            include ("inc/db.php");
            include ("inc/function.php");
            include ("inc/header.php"); 
           ?>
            <div id = "navbar">
    <ul>
    <li>
            <a id = 'choice' href = 'index.php'>My services</a>
        </li>
        <li>
            <a id = 'choice2' href = 'addService.php'>Add Service</a>
        </li>
        <li>
            <a id = 'choice' href = 'confirmRequests.php'>Requests(<?php echo count_requests();?>)</a>
        </li>
    </ul>
</div>
           <?php 
            echo "<div id='bodyleft'>";
            add_service();
                  echo"</div>";
           
        ?>
  
        <?php
                                     include("inc/function.php");
                                    call_user_func('days');
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Service Day To: </td>
                        <td>
                            <select name = "day_close">
                                <?php
                                    call_user_func('days');
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Time Open: </td>
                        <td><input type="time" name =  'time_open' /></td>
                    </tr>
                    <tr>
                        <td>Time Close: </td>
                        <td><input type="time" name =  'time_close' /></td>
                    </tr>
                    <tr>
                        <td>Service Cost: </td>
                        <td><input type="text" name =  'service_cost' /></td>
                    </tr>
                    <tr>
                        <td>Photo: </td>
                        <td><input type='file' name =  'service_photo' /></td>
                    </tr> -->
                  
<?php
    call_user_func('add_service');
?>
    </body>
</html>

                                
