<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>




<?php
/**********CHECK IF GET METHOD ID NOT NULL*/
if (!isset($_GET['proid']) || $_GET['proid'] == null) {
    header("Location:listProducts.php");
} else {
    $id = $_GET['proid'];
}

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit User</h2>
        <div class="block">
<?php

try {

/******************GET USER ID*********************** */

    $user = $auth->getUser($id);
} catch (\Kreait\Firebase\Exception\Auth\UserNotFound$e) {
    echo $e->getMessage();
}
?>
            <div class="form-message">
            <?php
//PRINT MESSAGE
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
}
unset($_SESSION['msg']);
?>
            </div>
            <!--FORM VIEW-->

            <form id="editForm" action="./data/editUser.php" method="POST" enctype="multipart/form-data">
                <table class="form">

                    <tr>

                        <td>
                            <input type="hidden" name="user_id" value="<?=$user->uid?>" required class="medium" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" name="email" value="<?=$user->email?>" required class="medium" disabled />



                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Role</label>
                        </td>
                        <td>
                            <!--OPTION TO CHOOSE ROLES-->
                            <select name="role_as">
                                <option value="<?php ?>">Select Roles</option>
                                <option value="admin">Admin</option>
                                
                                <option value="norole">User</option>
                            </select>
                            
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="edit_claims" value="Update" />
                        </td>
                    </tr>


                </table>
            </form>

            <!--END FORM-->

        </div>
    </div>
</div>

<?php include 'inc/footer.php';?>