<div id ="bodyright">
<div class="addCat">
    <h3 id = "add_cat">Record Donations</h3>
    <form method = "POST">
        <table>
            <tr>
                <td>Enter Category Name: </td>
                <td style="width:60%"><input type="text" name = "cat_name" /></td>
                <td> <button name = "add_cat">Add Category</button></td>
            </tr>
        </table>
       
    </form>
    </div>

    <div class="caty">
    <h3>Categories</h3>
    <form method = "POST" enctype = "multipart/form-data">
        <table>
            <tr>
                <th style="width:15%" >Category Id</th>
                <th colspan = 3 style="width:80%" >Category Name</th>
            </tr>
            <tr>
                <?php
                    echo viewall_category(); 
                ?>
            </tr>
        </table>
    </form>
    </div>
    

   
</div>

<?php
    echo add_cat();
?>
