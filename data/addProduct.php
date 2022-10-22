<?php


include('../dbcon.php');
include('../functions/functions.php');
session_start();
use Google\Cloud\Storage\StorageClient;

/**ADD PRODUCT TO FIREBASE STORAGE */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  
$productName = $_POST['productName'];

$categoryId = $_POST['catId'];
$brandId = $_POST['brandId'];
$description = $_POST['description'];
$price = $_POST['price'];
$amount = $_POST['amount'];
$type = $_POST['type'];
$barcode=$_POST['barcode'];
$startDate=date("Y-m-d");

$expDate= $_POST['expDate'];
$stock_min=$_POST['stock_min'];




$permited = array('jpg', 'png', 'jpeg', 'gif');
$file_name = $_FILES['image']['name'];
$file_size = $_FILES['image']['size'];
$file_temp = $_FILES['image']['tmp_name'];

$div = explode('.', $file_name);
$file_ext = strtolower(end($div));
$unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
$uploaded_image =  $unique_image;




move_uploaded_file($file_temp, $uploaded_image);
/**  CREATE INSTANCE TO FIREBASE STORAGE            */
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
    /*PUBLIC URL TO SEE UPLOAD IMAGE*/
    $public="https://$bucketName.storage.googleapis.com/$uploaded_image";
  } catch(Exception $e) {
    echo $e->getMessage();

  }

    $postdata = 
    [
        'productName' => $productName,
        'categoryId'=> $categoryId,
        'brandId'=>$brandId,
        'description'=>$description,
        'price'=>$price,
        'amount'=>$amount,
        'type'=>$type,
        'uploaded_image'=>$public,
        'barcode'=>$barcode,
        'createdAt'=>$startDate,
        'expire_date'=>$expDate,
        'stock_min'=>$stock_min,
     ];

    $children = $database->getReference('products')->getSnapshot()->numChildren();
       
        if ($children > 0) {
            if(isExistValueInSchema('products','productName',$productName,$database,$barcode)){
                echo "<span class='error'>Product Already Exists .</span>";
                
               
                exit();
            }
            else{
                $postData = $database->getReference('products')->getChild($barcode)->set($postdata);
                echo "<span class='success'>Product Inserted Successfully.</span> ";
                
                exit(); 
            }
        }
    
    $post = $database->getReference('products')->getChild($barcode)->set($postdata);
  if($post){

   echo "<span class='success'>Product Inserted Successfully.</span> ";
    exit();
  }
}
else{
    echo "<span class='error'>All Required Fields Must Not Be Empty</span>";
    exit();
}