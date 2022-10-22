<?php

/**IF VERIFIED USER ID NOT NULL RETURN TO DASHBOARD PAGE */
if (isset($_SESSION['verified_user_id'])) {
	header("Location:dashbord.php");
}

?>

<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

</head>

<body>

	<div class="container">
		<section id="content">

			<h1>Admin Login</h1>

			<div id="message" class="form-message"></div>

			<form action="" method="POST">
				<div>
					<input class="name-message" pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$" type="text" placeholder="Username" name="email" id="email" reqired />
				</div>
				<div>
					<input type="password" placeholder="Password" name="password" id="password" required />
				</div>
				<div>
					<input id="submit" type="submit" value="submit" />
				</div>
			</form>

		</section>
	</div>

</body>

</html>
<script type="">

	$(document).ready(function(){
		$('#submit').click(function(e){
			e.preventDefault();
			let userEmail=$('#email').val().trim();
			let userPassword=$('#password').val().trim();
			$.ajax({
				url:'./data/logincode.php',
				type:'POST',
				data:{
					userEmail:userEmail,
					userPassword:userPassword
				},
				
				success:function(res){
					
					if(res.trim()=='success'){
					
				    window.location.href="./dashbord.php";
					}
					else{
						
						$('#message').html(res);
						
					}

				}
			})
		})
	})
</script>
<!--END-->