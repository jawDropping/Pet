<div id ="bodyright">
    <div class = "addProduct">
    <h3>Add Products</h3>
    <form method = "POST" enctype = "multipart/form-data">
        <div class="formleft">

        </div>
        <div class="formright">

        </div>
        <table>
            <tr>
                <td>Enter Product Name: </td>
                <td><input type="text" name = "pro_name" /></td>
            </tr>
            <tr>
                <td>Select Category Name: </td>
                <td>
                    <select name = "cat_name">
                        <?php 
                            echo viewall_cat(); 
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Select Sub Category Name: </td>
                <td>
                    <select name = "sub_cat_name">
                        <?php
                            echo viewall_sub_cat(); 
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Enter Product Brand: </td>
                <td><input type="text" name = "pro_brand" /></td>
            </tr>
            <tr>
                <td>Select 1st Product Image: </td>
                <td><input type="file" name = "pro_img" /></td>
            </tr>
            <tr>
                <td>Select 2nd Product Image: </td>
                <td><input type="file" name = "pro_img2" /></td>
            </tr>
            <tr>
                <td>Select 3rd Product Image: </td>
                <td><input type="file" name = "pro_img3" /></td>
            </tr>
            <tr>
                <td>Select 4th Product Image: </td>
                <td><input type="file" name = "pro_img4" /></td>
            </tr>
            <tr>
                <td>Enter Price: </td>
                <td><input type="text" name = "pro_price" /></td>
            </tr>
            <tr>
                <td>Enter Quantity: </td>
                <td><input type="text" name = "pro_quantity" /></td>
            </tr>
            <tr>
                <td>Enter KeyWord: </td>
                <td><input type="text" name = "pro_keyword" /></td>
            </tr>
        </table>
        <button name = "add_prod">Add Product</button>
    </form>
    </div>
    
</div>
<style>
    .addProduct {
  background: white;
  margin-top: 7vh;
  border: 1px solid black;
  padding: 5px;
  height: 90vh;
}

</style>
<?php
    echo add_product();
?>
