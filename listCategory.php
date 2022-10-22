<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>



<?php
//QUERY TO DELETE CHOOSEN CATEGORY
if (isset($_GET['delcat'])) {
    
    $id = $_GET['delcat'];
   
    try{

        $del=$database->getReference('Category/'.$id)->remove();
    }
    catch (Exception $e){
        echo $e->getMessage();
    }
    
    
}

//END QUERY

?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    //QUERY TO GETALL EXISTING CATEGORIES AND LOAD THEM TO THE PAGE

                    $getCategory = $database->getReference('Category')->getValue();

                    

                    if ($getCategory) {
                        $i = 0;
                        foreach ($getCategory as $key=>$category) {
                            $i++;
                    ?>

                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $category['categoryName']; ?></td>
                                <td><a href="editCategory.php?categoryId=<?php echo $key; ?>">Edit</a>
                                    || <a onclick="return confirm('Are you sure to delete')" href="?delcat=<?php echo $key; ?>">Delete</a></td>
                            </tr>

                    <?php     }
                    }  
                    //END LOADING QUERY
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>

<?php include 'inc/footer.php'; ?>