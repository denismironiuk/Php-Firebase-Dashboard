<?php
include 'dbcon.php';

/****************LOAD JSON FILE WITH ALL EXISTING PRODUCTS */

$db=$database->getReference('products')->getValue();
$rows=array();
foreach($db as $key => $data){
    $rows[]=$data;
}
echo json_encode($rows);

/******************************END LOAD******************* */
?>