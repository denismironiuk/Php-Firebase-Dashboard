<!--PAGE TO ADD NEW BRAND -->

<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<?php



?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Brand</h2>

        <div class="block copyblock">
            <div id="message" class="form-message"></div>
            <form id="form" >
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="brandName" id="brandName" placeholder="Enter Category Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit_insert" id="submit" value="Save" />
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
                url: './data/addBrand.php',
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

                        $('#message').html("<span class='success'>Brand Inserted Successfully.</span> ");
                        window.location.href = "./listBrand.php";

                    }

                }
            })

        })
    })
</script>

<?php include 'inc/footer.php'; ?>