<!--LIST CUSTOMERS ORDERS-->

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Orders</h2>


                <div class="block">
                    <table class="data display datatable" id="orderTable">
					<thead>
						<tr>
							<th >Customer Name</th>
							<th >Order Date</th>
							<th >Order Time</th>
							<th >Order Quantity</th>
              <th>Order Details</th>
						</tr>
					</thead>
					<tbody>


					</tbody>
				</table>
               </div>

<!--LOAD BOOTSTRAP MODAL POPUP TO EDIT PRODUCT-->

               <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    <form action="#" method="post" id="updateForm" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
        <button type="button"  class="btn-close"  style="border:none" data-bs-dismiss="modal" aria-label="close">X</button>
      </div>
      <div class="modal-body" id="info_update">




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        </form>
      </div>
    </div>
  </div>

  <!--END LOAD-->
            </div>
        </div>
 <script type="text/javascript">

/**************LOAD DOCUMENT **************************************************/

    $(document).ready(function () {
        $(document).on('click','.edit_data',function(){


 var edit_id=$(this).attr("id");
 var date=$(this).attr("date");
var time=$(this).attr("time")

/**************AJAX REQUEST TO LOAD ORDER DETAILS******************************
 * DATA SEND: ID,DATE,TIME
 */
 $.ajax({
   url:"./data/orderDetails.php",
   type:"post",
   data:{edit_id:edit_id,date:date,time:time},
   success:function(data){
     $('#info_update').html(data);
     $("#exampleModal").modal('show');


   }
 })

/***************************************************** ***************************/

})

$(".modal").on("hidden.bs.modal",function(){
  $(".modal-body").html("");
})

       var table= $('#orderTable').DataTable({
        
        paging:false,
/************AJAX REQUEST TO LOAD TABLE WITH ORDER THROW SPECIFIED CUSTOMER***** */
"order": [[1,'desc'],[2,'desc']],
      ajax: {
        url: './data/orders.php',
        deferRender: false,
        dataSrc: '',

    },
    columns: [

      { data: 'name' },
        { data: 'date' },
        { data: 'time' },
        { data: 'amount' },
        { data:'all', "render":function(data, type, full, meta){
        return  "<button type='button' class='btn btn-primary edit_data' data-bs-toggle='modal' id="+data[0]+" date="+data[1]+" time="+data[2]+"  data-bs-target='#exampleModal'>Order Details</button>"
      }
    }

    ],

    });
    setInterval(function(){
      table.ajax.reload();
    },100000)
/************************************************************************************* */
});



</script>
<?php include 'inc/footer.php';?>
