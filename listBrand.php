<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<?php

//QUERY TO DELETE CHOOSEN BRAND

if (isset($_GET['delBrand'])) {
   
    $id = $_GET['delBrand'];

    $del = $database->getReference('Brand/' . $id)->remove();
    
}
//END QUERY
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Brand List</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Brand Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    //QUERY TO GET ALL EXISTING BRANDS AND LOAD THEM TO THE PAGE

                    $getBrand = $database->getReference('Brand')->getValue();


                    if ($getBrand) {
                        $i = 0;
                        foreach ($getBrand as $key => $brand) {
                            $i++;
                    ?>

                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $brand['brandName']; ?></td>
                                <td><a href="editBrand.php?brandId=<?php echo $key; ?>">Edit</a>
                                    || <a onclick="return confirm('Are you sure to delete')" href="?delBrand=<?php echo $key; ?>">Delete</a></td>
                            </tr>

                    <?php     }
                    }  

                    //END QUERY

                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
      

        $('#example').DataTable();
       
    });
</script>
<?php include 'inc/footer.php'; ?>