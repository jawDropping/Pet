<div id = "navbar">
            <ul>
                <li>
                    <a href = "#">CATEGORIES</a>
                    <ul>
                        <?php echo all_cat(); ?>
                    </ul>
                </li>
                <li> <a href = "services.php?services">SERVICES</a></li>
                <li> <a href = "#">DONATE</a></li>
            </ul>
        </div>
        <?php
    if(isset($_GET['services']))
    {
        include("services.php");
    }
    ?>