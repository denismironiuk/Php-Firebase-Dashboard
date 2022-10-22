

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>
         <div class="block copyblock">
         <div id="message" class="form-message"></div>

<form id="form">
<table class="form">
                        <tr>
                            <td>
                                <input type="text" name="categoryName"  class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td>
                                <input type="submit" name="submit_insert" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <script>
    $(document).ready(function() {
        $('#form').on('submit', function(e) {
            e.preventDefault();
            

            $.ajax({
                url: './data/addCategory.php',
                type: 'post',
                data: new FormData(this),
                contentType: false,
                processData: false,
                cache: false,
                success: function(res) {
                    console.log(res)


                    if (res.trim() != 'success')
                        $('#message').html(res);
                    else {

                        $('#message').html("<span class='success'>Category Inserted Successfully.</span> ");
                        window.location.href = "./listCategory.php";

                    }

                }
            })

        })
    })
</script>
<?php include 'inc/footer.php';?>