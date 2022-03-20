<div id = "navbar">
            <ul>
                <li>
                    <a href="/Pet/user/index.php">HOME</a>
                </li>
                <li>
                    <a href = "#">CATEGORIES</a>
                    <ul>
                        <?php echo all_cat(); ?>
                    </ul>
                </li>
                <li> 
                    <a href = "#">SERVICES</a>
                    <ul>
                        <?php echo viewall_cat(); ?>
                    </ul>
                </li>
                <li> <a href = "#">DONATE</a></li>
                <li> <a href = "#">MY PET</a></li>
            </ul>
        </div>
        <?php
    ?>