
<?php
/*************LIST PRODUCT VIEW*************** */
include 'inc/header.php';?>
<?php include 'inc/sidebar.php';

?>


<div class="grid_10">
	<div  class="box round first grid">
  <h2>Product List</h2>
        <div id="link_wrapper" class="block">


        <table class="data display datatable" id="example" style="width: 100%;">
			<thead>
				<tr>

					<th>Product Name</th>
					<th>Description</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Date</th>
					<th>Expire Date</th>
          <th>Type</th>
					<th>Image</th>
          <th>Action</th>
				</tr>
			</thead>
			<tbody>

      </table>
    </div>
    <!--LOAD BOOTSTRAP MODAL POPUP TO EDIT PRODUCT-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="#" method="post" id="updateForm" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="info_update">




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="edit_id" id="update">Update</button>
        </form>
      </div>
    </div>
  </div>

  <!--END LOADING-->
</div>

    </div>
</div>
<script>
$(document).ready(function () {

$(document).on('click','.edit_data',function(){

  var edit_id=$(this).attr("id");

 //AJAX REQUEST TO TAKE CHOOSEN PRODUCT DATA

  $.ajax({
    url:"./data/loadModalProduct.php",
    type:"post",
    data:{edit_id:edit_id},

    success:function(data){
      $('#info_update').html(data);
      $("#exampleModal").modal('show');//SHOW POPUP

    }
  })
})

$("#updateForm").submit(function(e){
  e.preventDefault();
//AJAX REQUEST TO UPDATE PRODUCT DATA
  $.ajax({
    url:"./data/editProduct.php",
    type:"post",
    method:"post",
    data:new FormData(this),
   cache:false,
    contentType:false,
    processData:false,
    success:function(data){

      $("#editData").modal('hide')//CLOSE POPUP
      location.reload();
    }
  })
})

//LOADING DATATABLE AND AJAX REQUEST FROM HTTPS://DATATABLES.NET
  var table= $('#example').DataTable({
    "paging":false,

      ajax: {
        url: './fetchProduct.php',
        dataSrc: '',
        deferRender: true,
        
    },
    //TABLE OPTIONS NAME,DESCRIPTION,PRICE,AMOUNT,DATE(START_DATE,EXPIRE_DATE),IMAGE,EDIT BUTTON
    columns: [

      { data: 'productName' },

        { data: 'description' },
        { data: 'price' },
        { data: 'amount' },
        { data: 'createdAt' },
        { data: 'expire_date' },





        { data: 'type',
          "render": function (data, type, full, meta) {
        if(data==0)
        return "Inactive"
        return "Active"


      }
        },
        { data: 'uploaded_image',
          "render": function (data, type, full, meta) {
        return "<img src=\"" + data + "\" height=\"50\"/>";
      }
    },{
      data:'barcode', "render":function(data, type, full, meta){
        return  "<button type='button' class='btn btn-primary edit_data' data-bs-toggle='modal' id="+data+" data-bs-target='#exampleModal'>Edit</button>"
      }
    }
    ],

    });
    //SET INTERVAL TO REFRESH PAGE REALTIME
    setInterval(function(){
      table.ajax.reload();
    },5000)

//END LOADING TABLE
});

</script>

<?php include 'inc/footer.php';?>
