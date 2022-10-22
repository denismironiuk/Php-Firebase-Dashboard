<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>




<?php

/*******************GET ID OF SPECIFIED USER FROM URL *************************************************/

if (!isset($_GET['categoryId'])  || $_GET['categoryId'] == NULL) {
    echo "<script>window.location = 'listCategory.php';  </script>";
} else {
    $id = $_GET['categoryId'];
}

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock">
        <div id="message" class="form-message"></div>


            <?php
            
/*********************LOAD  VALUES OF SPECIFIED CHILD ***********************************/

            $getCategory = $database->getReference('Category')->getChild($id)->getValue();
            if ($getCategory) {
            ?>
            <!--FORM VIEW-->

                <form id="form">
                    <table class="form">

                        <tr>
                            <td>
                                <input type="hidden" name="categoryId" value="<?php echo $id ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="categoryName" value="<?php echo $getCategory['categoryName']; ?>"     class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="update_category" Value="Update" />
                            </td>
                        </tr>
                    </table>
                </form>

            <!--END fORM-->

            <?php    }    ?>

        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#form').on('submit', function(e) {
            e.preventDefault();
            

            $.ajax({
                url: './data/editCategory.php',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                cache: false,
                success: function(res) {
                    console.log(res)


                    if (res.trim() != 'success')
                        $('#message').html(res);
                    else {

                        $('#message').html("<span class='success'>Category Updated Successfully.</span> ");
                        window.location.href = "./listCategory.php";

                    }

                }
            })

        })
    })
</script>
<?php include 'inc/footer.php'; ?>