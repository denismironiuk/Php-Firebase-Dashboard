<?php

/****************LOAD JSON FILE WITH  PRODUCTS SMALLER 10*/

include '../dbcon.php';

/** GET ALL PRODUCTS FROM TABLE AND RETURN ONLY PRODUCTS THAT AMOUNT SMALLER 10 */
$db=$database->getReference('products')->getValue();

$rows=array();
foreach($db as  $data){

    // echo "<br/>";
    // echo strtotime(date('Y-m-d'))-strtotime($data['expire_date']);
    // echo "<br/>";

    if($data['amount']<$data['stock_min']){
        $rows[]=$data;
    }
    
}
echo json_encode($rows);

