<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php $db=$database->getReference('products')->orderByChild('amount')->equalTo('0')->getSnapshot()->getValue();
if($db){
  
  try{
foreach($db as $key=> $product){
  $updateData=[
    'type'=>$product['type']=0,
  ];
  $database->getReference('products/'.$key)->update($updateData);
}
  }
  catch (Exception $e){
    echo $e->getMessage();
  }
}
?>
<?php
/** QUERY TO RETURN ALL MONTHS THERE CUSTOMERS BUYING PRODUCTS */
$db = $database->getReference('Cart List/Admin View')->getChildKeys();
$dates = array();

foreach ($db as $value) {
  $monthList = $database->getReference('Cart List/Admin View/' . $value . '/products')->getValue();
  foreach ($monthList as $date) {
    $month = date('F', strtotime($date['date']));
    $dates[] = $month;
  }
}
$newMonth = array_unique($dates);
/***END QUERY */
// rsort($newMonth);
?>
<div class="grid_10">
  <div class="box round first grid">
    <h2>Dashbord</h2>

    <div class="block">

      <!--LOADIN TABLE WITH ALL PRODUCTS THAT NEED TO BE UPDATED-->

      <h2 class="mt-1">Products that need to be updated</h2>

      <table id="example" class="data display datatable mt-2" style="width: 100%">
        <thead>
          <tr>
            <th>Name</th>
            <th>Amount</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot></tfoot>
      </table>
    </div>
    <!--END LOADING-->
    
    <script type="text/javascript">
      //LOADING DATA FROM GOOGLE CHARTS

      google.charts.load('current', {
        'packages': ['bar']
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var month = $("#month").val()
        console.log(month)

        var chatData = $.ajax({
          url: "./data/chart.php",
          method: "post",
          data: {
            month
          },
          dataType: "json",
          async: false,

        }).responseText;
        var data = google.visualization.arrayToDataTable(JSON.parse(chatData));

        var options = {
          chart: {
            title: '',


          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

      google.charts.load("current", {
        packages: ["corechart"]
      });
      google.charts.setOnLoadCallback(drawChart1);

      function drawChart1() {
        var chatData1 = $.ajax({
          url: "./data/chart2.php",
          method: "post",
          
          dataType: "json",
          async: false,

        }).responseText;
        var data = google.visualization.arrayToDataTable(JSON.parse(chatData1));

        var options = {
          title: '',

        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }

      //END LOADING
    </script>

    <div class="block">
      <h2 class="mt-1">Total Orders</h2>
      <div class="d-flex flex-column">
        <!--LOAD OPTION TO CHOOSE MONTHS-->
        <div class="d-flex justify-content-end">
          <select style="padding: 0.5rem; margin:2rem" name="month" id="month">
            <?php
            foreach ($newMonth as $month) {
            ?>
              <option value=<?= $month ?>><?= $month ?></option>
            <?php }
            ?>
          </select>
        </div>
        <div id="columnchart_material" style="width: 90%;margin:0 auto; height: 500px; padding:2rem; text-align: center"></div>
        <!--END LOADING-->
      </div>
    </div>

    <h2 class="mt-1">Most Buying Products</h2>
    <div class="col">
      <div id="piechart_3d" style="width: 100%; height: 500px"></div>
    </div>


  </div>

</div>


<!--END LOADING-->

<?php include 'inc/footer.php'; ?>

<!--LOADING DATATABLE AND AJAX REQUEST FROM HTTPS://DATATABLES.NET-->

<script>
  $(document).ready(function() {
    //TABLE THROW PRODUCTS THAN NEED BE UPDATED
    var table = $('#example').DataTable({
      paging: false,
      searching: false,
      "order":[[1,'asc']],
      ajax: {
        url: './data/soldOut.php',
        dataSrc: '',
        deferRender: true,
      },

      //TABLE ROWS INCLUDE: NAME,AMOUNT,IMAGE,BARCODE
      columns: [

        {
          data: 'productName'
        },
        {
          data: 'amount'
        },
        {
          data: 'uploaded_image',
          render: function(data, type, full, meta) {
            return '<img src="' + data + '" height="50"/>';
          },
        },

        {
          data: 'barcode',
          render: function(data, type, full, meta) {
            return (
              '<p>PURCHASE FROM SELLER</p>'
            );
          },
        },
      ],
    });

    //REFRESH PAGE BY INTERVAL VALUE
    setInterval(function() {
      table.ajax.reload();

    }, 1000);
  });
  //IF MONTH CHANGED CHART IS RELOADING
  $('#month').change(function() {
    var month = $(this).val();

    drawChart();
  });
</script>
;
<!--END LOADING-->