
<?php 
include '../dbcon.php';

session_start();

if (isset($_POST['userEmail']) && isset($_POST['userPassword'])){
	$userEmail = $_POST['userEmail'];
    $clearTextPassword = $_POST['userPassword'];
if(empty($userEmail) || empty($clearTextPassword)){
		echo 'Email And Password Not Be Blank!!!';
		exit();
	}
	try{
		$user = $auth->getUserByEmail($userEmail);
		

		if ($user->customClaims['admin'] == 1){
			try{
				$signInResult = $auth->signInWithEmailAndPassword($userEmail, $clearTextPassword);
			    $_SESSION['verified_user_id']=$user;
				echo "success";
				exit();
            }catch (Exception $e){
                echo $e->getMessage();
                exit();
			}
		}
		else{
			echo "Don't have permissions";
			
		}
	}catch (Exception $e){
 echo $e->getMessage();
 
	}
	exit();
}