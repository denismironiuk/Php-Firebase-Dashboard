<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>





 <?php
 /*******************GET ID OF SPECIFIED USER FROM URL *************************************************/
if (!isset($_GET['brandId']) || $_GET['brandId'] == null) {
    echo "<script>window.location = 'listBrand.php';  </script>";
} else {
    $id = $_GET['brandId'];

}

?>
<div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand</h2>
               <div class="block copyblock">
               <div id="message" class="form-message"></div>


<?php
/*********************LOAD SPECIFIED VALUES OF PECIFIED CHILD ***********************************/
$getBrand = $database->getReference('Brand')->getChild($id)->getValue(); 
if ($getBrand) {

    ?>

                 <form id="form" >
                    <table class="form">
                    <tr>
                            <td>
                                <input type="hidden" name="brandId" id="brandId" value="<?php echo $id ?>" class="medium" />
                            </td>
                    </tr>
                        <tr>
                            <td>
                                <input type="text" name="brandName" id="brandName"  value="<?php echo $getBrand['brandName']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td>
                                <input type="submit" name="update_brand" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php }?>


                </div>
            </div>
        </div>
        <script>
    $(document).ready(function() {
        $('#form').on('submit', function(e) {
            e.preventDefault();
            

            $.ajax({
                url: './data/editBrand.php',
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

                        $('#message').html("<span class='success'>Brand Updated Successfully.</span> ");
                        window.location.href = "./listBrand.php";

                    }

                }
            })

        })
    })
</script>

<?php include 'inc/footer.php';?>