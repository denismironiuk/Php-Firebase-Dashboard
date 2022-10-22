<!--UPDATE PRODUCT VIEW-->
<?php
include '../dbcon.php';

/**CHECK IF ID EXIST */

if(isset($_POST['edit_id'])){
    $id=$_POST['edit_id'];
 /**GET ALL DATA BY CHILD ID */
    $result=$database->getReference('products')->getChild($id)->getValue();

            $name=$result['productName'];
            $category=$result['categoryId'];
            $brandId=$result['brandId'];
            $description=$result['description'];
            $price=$result['price'];
            $amount=$result['amount'];
            $type=$result['type'];
            $uploaded_image=$result['uploaded_image'];
            $barcode=$result['barcode'];
            $start_date=$result['createdAt'];
            $expire_date=$result['expire_date'];
            
            
    
}
?>
 <!--LOAD DATA TO THE FORM INPUT-->
<table class="form "  >
                    <tr>
                        <td>
                            <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $id ?>" name="edit_id">
                            <input type="hidden" name="edit_img" id="edit_img" value="<?php echo $uploaded_image ?>" name="edit_img">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="productName" id="productName" value="<?php echo $name ?>"  class="medium" disabled />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="catId" >
                                <option>Select Category</option>
                                <?php

                               /*********GET ALL CATEGORIES ********************/

                                $getCat =  $database->getReference('Category')->getValue();
                                if ($getCat) {
                                    foreach ($getCat as $key => $catagory) {


                                ?>
                                        <option <?php
                                                if ($key == $category) { ?> selected="selected" <?php }  ?> value="<?php echo $category;   ?>"><?php echo $catagory['categoryName'] ?> </option>

                                <?php   }
                                } ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Brand</label>
                        </td>
                        <td>
                            <select id="select" name="brandId" >
                                <option>Select Brand</option>

                                <?php

                                /*********GET ALL BRANDS ********************/

                                $getBrand =  $database->getReference('Brand')->getValue();
                               
                                if ($getBrand) {
                                    foreach ($getBrand as $key => $brand) {


                                ?>

                                        <option <?php

                                                if ($key == $brandId) { ?> selected="selected" <?php }  ?> value="<?php echo $brandId;  ?>"><?php echo $brand['brandName']; ?> </option>
                                <?php   }
                                } ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                        <textarea name="description"><?=$description?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input type="number" name="price" min=0 value="<?php echo $price ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Amount</label>
                        </td>
                        <td>
                            <input type="number" name="amount" min=1 value="<?php echo $amount ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="<?=  $uploaded_image?>" height="60px; width=" 80px;"><br />
                            <input type="file" name="image" id="file"   />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Barcode</label>
                        </td>
                        <td>
                            <input type="text" name="barcodeName" placeholder="Enter Barcode..." value="<?php echo $barcode ?>" class="medium" disabled />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option>Select Type</option>
                                <?php

                                if ($type == 0) { ?>
                                    <option selected="selected" value="0">Inactive</option>
                                    <option value="1">Active</option>
                                <?php } else {  ?>

                                    <option value="0">Inactive</option>
                                    <option selected="selected" value="1">Active</option>
                                <?php }  ?>
                            </select>
                        </td>
                    </tr>

                   
                </table>