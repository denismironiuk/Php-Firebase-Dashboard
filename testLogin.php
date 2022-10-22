<?php

session_start();

include 'dbcon.php';

if (isset($_POST['userEmail']) && isset($_POST['userPassword'])) {
    $userEmail = $_POST['userEmail'];
    $clearTextPassword = $_POST['userPassword'];
    
    try {
/************GET USER ID BY userEmail******* */
        $user = $auth->getUserByEmail($userEmail);
        if ($user->customClaims['admin'] == 1) {

            

        try {
/**************SIGN USER BY userEmail AND PASSWORD */
            $signInResult = $auth->signInWithEmailAndPassword($userEmail, $clearTextPassword);
            
            $_SESSION['verified_user_id']=$user;
            header("Location: dashbord.php");
            exit();

            
        } catch (Exception $e) {
            echo "Wrong Password";
            
            exit();
        }
        } else {
            /**IF USER PERMISSIONS NOT ADMIN
             * YOU CANNOT LOGIN IN ADMINISTRATIVE PANEL
             */
            echo "You dont have permissions ";
           
            exit();
        }
    } catch (\Kreait\Firebase\Exception\Auth\UserNotFound$e) {
        
        echo "Invalid userEmail Address";
       
        exit();
    }
} else {
    echo "Not allowed";
   
    exit();
}
