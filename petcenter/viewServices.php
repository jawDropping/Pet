<div class = "scroll" id ="bodyright">
    <h3>View My Services</h3>
    <form method = "POST" enctype = "multipart/form-data">
    <table>
        <tr>
            <th>Services Applied</th>
            <th>Service Name</th>
         
            <th>Service Day Open and Close</th>
            <th>Service Time Open and Close</th>
            <th>Service Cost</th>
            <th>Service Photo</th>
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

