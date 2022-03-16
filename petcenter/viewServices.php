<div class = "scroll" id ="bodyright">
    <h3>View My Services</h3>
    <form method = "POST" enctype = "multipart/form-data">
    <table>
        <tr>
            <th>Service Name</th>
            <th>Service Location</th>
            <th>Service Email</th>
            <th>Service Contact Number</th>
            <th>Service Date Open</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <tr>
            <?php
                include ("inc/function.php");
                call_user_func('view_service'); 
            ?>
        </tr>
        </table>
    </form>
</div>

