<?php


include('../dbcon.php');
include('../functions/functions.php');
session_start();
use Google\Cloud\Storage\StorageClient;



/****************************************************************************** */
/**EDIT/UPDATE PRODUCT IN FIREBASE STORAGE 
 * CHECK IF SERVER METHOD POST AND POST METHOD NOT NULL
*/
// $db=$database->getReference('products/00000000000000000000000000/uploaded_image')->getValue();
// var_dump($db);
// exit();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_id'])) {
    
   $prodictId=$_POST['edit_id'];
 
    $description = $_POST['description'];
    $price = $_POST['price'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    if(isset($_FILES) || $_FILES!=''){
   
    $uploaded_image = $_POST['edit_img'];
    
    
    
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];
    
    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = $unique_image;
    
    
    move_uploaded_file($file_temp, $uploaded_image);
   
/*********  CREATE INSTANCE TO FIREBASE STORAGE********************************/
try {
    $storage = new StorageClient([
        'keyFilePath' => './easybuy-690d0-firebase-adminsdk-p43yk-67ec73ed42.json',
    ]);$bucketName = 'easybuy-690d0.appspot.com';
    $bucket = $storage->bucket($bucketName);
    
    
    $bucket = $storage->bucket($bucketName);
    $object = $bucket->upload(
        fopen($uploaded_image, 'r'),
        [
            'predefinedAcl' => 'publicRead'
        ]
    );
/************PUBLIC URL TO SEE UPLOAD IMAGE**********************************/
    $uploaded_image="https://$bucketName.storage.googleapis.com/$uploaded_image";
  } catch(Exception $e) {
    echo $e->getMessage();
  }
    }
}else{
    $uploaded_image=$database->getReference('products/'.$prodictId.'/uploaded_image')->getValue();
 }
        $updateData = [
            
            'description'=>$description,
            'price'=>$price,
            'type'=>$type,
            'amount'=>intval($amount),
            'uploaded_image'=>$uploaded_image,
            'updatedAt'=>date("Y-m-d")
            ];

/*************UPDATE SPECIFIED PRODUCT *******************************************/
        $post = $database->getReference('products/'.$prodictId)->update($updateData);
        
       
    
/****************************************************************************** */