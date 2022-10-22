

<?php
include('../dbcon.php');


/*****************UPDATE USER PRIVILIGIES******************* */
if(isset($_POST['edit_claims'])){
    $uid=$_POST['user_id'];
    $roles=$_POST['role_as'];

    //CHECK USER'S ROLE

    if($roles=='admin'){

    $auth->setCustomUserClaims($uid, ['admin' => true]);
    $_SESSION['msg']="<span class='success'>Role Updated Successfully.</span> ";
    header("Location:../editUsers.php?proid=".$uid);
    exit();
   

    }
    
    //BY DEFAULT ROLE "USER"
    elseif($roles=='norole'){
        $auth->setCustomUserClaims($uid,null);
        $_SESSION['msg']="<span class='success'>Role Updated Successfully.</span> ";
    header("Location:../editUsers.php?proid=".$uid);
    exit();
        
    }
    
    

   
}
?>