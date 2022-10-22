<?php
include '../dbcon.php';
$bestSellerProducts=[];
$data[0][0]='Day';
    $data[0][1]='Sales';
    $x=1;
    $orderSalesByDate = $database->getReference('Cart List/Admin View')->getValue();
    foreach($orderSalesByDate as $key=>$order){
      $tempOrder=$order['products'];
      foreach($tempOrder as $orderKey=> $value){
        $bestSellerProducts[$value['name']] ??= 0;
        $bestSellerProducts[$value['name']] += intval($value['quantity']);
      }
    }

        
     
    foreach($bestSellerProducts as $key =>$value){
        $data[$x][0]=$key;
        $data[$x][1]=$value;
        $x++;
              }

     echo json_encode($data);
?>
