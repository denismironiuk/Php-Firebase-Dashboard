<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>



<div class="grid_10">
	<div class="box round first grid">
		<h2>User List</h2>

		<div class="block">


			<table class="data display datatable" id="example">
				<thead>
					<tr>
						
						<th>User Email</th>
						<th>Role</th>
                        <th>Action</th>

					</tr>
				</thead>
				<tbody>
					<?php

//QUERY TO GET ALL EXISTING USERS AND LOAD THEM TO THE PAGE

$users = $auth->listUsers();

if ($users) {
    $i = 0;
    foreach ($users as $user) {
		

        ?>
							<tr class="odd gradeX">
								
								<td><?=$user->email?></td>

								<td>
									<?php

        if (isset($user->customClaims['admin']) == 1) {
            echo "Admin";

        } elseif ($user->customClaims == null) {
            echo "User";
        }
        ?>
		</td>
		<td>
		<a href="./editUsers.php?proid=<?=$user->uid;?>">Edit</a>
	    </td>


						<?php
						
/**************************END LOAD QUERY*******************************/
    }
}?>


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
<?php include 'inc/footer.php';?>