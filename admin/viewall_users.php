<div class = "scroll" id ="bodyright">
    <h3>View All Users</h3>
    <form method = "POST" enctype = "multipart/form-data">
    <table>
        <tr>
            <th>User Id</th>
            <th>User Name</th>
            <th>User Password</th>
            <th>Contact Info</th>
            <th>Name</th>
            <th>Image</th>
            <th>Delete</th>
        </tr>
        <tr>
            <?php
                echo viewall_users();
            ?>
        </tr>
        </table>
    </form>
</div>



