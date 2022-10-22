<!--ADD PRODUCT VIEW-->

<?php include './inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>



<div class="grid_10">
  <div class="box round first grid">
    <h2>Add New Product</h2>

    <div class="block">
    <div id="message" class="form-message"></div>

      <form id="form"
        action="./data/addProduct.php"
        
        enctype="multipart/form-data"
      >
        <table class="form">
          <tr>
            <td>
              <label>Name*</label>
            </td>
            <td>
              <input
                type="text"
                name="productName"
                id="productName"
                placeholder="Enter Product Name..."
                required
                class="medium"
              />
            </td>
          </tr>

          <tr>
            <td>
              <label>Category</label>
            </td>
            <td>
              <select id="catId" name="catId" required>
                <option>Select Category</option>
                <?php

                                /**************GET ALL CATEGORIES ****************************
                                 * ************LOAD TO TABLE**********************************
                                 * */

                                $getCat = $database->getReference('Category')->getValue();
                if ($getCat) { foreach ($getCat as $key => $category) { ?>
                <option value="<?php echo $category['categoryName'];  ?>">
                  <?php echo $category['categoryName']; ?>
                </option>

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
              <select id="brandId" name="brandId" required>
                <option>Select Brand</option>

                <?php
                                /****************GET ALL BRANDS ****************************
                                 * **************LOAD TO TABLE******************************
                                 * */

                                $getBrand =  $database->getReference('Brand')->getValue();
                if ($getBrand) { foreach ($getBrand as $key => $brand) { ?>

                <option value="<?php echo $brand['brandName'] ?>">
                  <?php echo $brand['brandName'];  ?>
                </option>
                <?php   }
                            }
                             ?>
              </select>
            </td>
          </tr>

          <tr>
            <td style="vertical-align: top; padding-top: 9px">
              <label>Description</label>
            </td>
            <td>
              <textarea id="description" name="description"></textarea>
            </td>
          </tr>
          <tr>
            <td>
              <label>Price*</label>
            </td>
            <td>
              <input
                type="number"
                id="price"
                min="0"
                name="price"
                placeholder="Enter Price..."
                class="medium"
                required
              />
            </td>
          </tr>
          <tr>
            <td>
              <label>Amount*</label>
            </td>
            <td>
              <input
                type="number"
                min="1"
                name="amount"
                id="amount"
                placeholder="Enter Amount Of Your Product..."
                class="medium"
                required
              />
            </td>
          </tr>

          <tr>
            <td>
              <label>Expire Date*</label>
            </td>
            <td>
              <input type="date" id="expDate" name="expDate" min="<?= date('Y-m-d',strtotime("+1 Day")) ?>"
              required/>
            </td>
          </tr>

          <tr>
            <td>
              <label>Stock Minimum*</label>
            </td>
            <td>
              <input type="number" id="stock_min" name="stock_min" min=0 required/>
            </td>
          </tr>

          <tr>
            <td>
              <label>Upload Image*</label>
            </td>
            <td>
              <input type="file" id="image" name="image" required />
            </td>
          </tr>

          <tr>
            <td>
              <label>Product Type*</label>
            </td>
            <td>
              <select id="type" name="type" required>
                <option>Select Type</option>
                <option value="0">InActive</option>
                <option value="1">Active</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <label>Barcode*</label>
            </td>
            <td>
              <input
                type="text"
                id="barcode"
                name="barcode"
                placeholder="Enter Barcode..."
                class="medium"
                required
              />
            </td>
          </tr>
          <tr>
            <td></td>
            <td>
              <input type="submit" id="submit" name="submit" value="Save" />
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>

<script>

$(document).ready(function(){
		$('#form').on('submit',function(e){
			e.preventDefault();
			
   
			$.ajax({
				url:'./data/addProduct.php',
				type:'POST',
        method:'POST',
        data: new FormData(this),
        contentType:false,
        processData:false,
				
				success:function(res){
          
					console.log(res);
          if(res.trim()=="success"){
            $('#message').html("Product Inserted Successully");
            window.location.href='./listProduct.php';
          }
					else{
            $('#message').html(res);
          }
				}
			})
		})
	})

</script>

<?php include 'inc/footer.php'; ?>

<!--END-->
