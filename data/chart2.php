<?php
include '../dbcon.php';
$bestSellerProducts=[];
$data[0][0]='Day';
    $data[0][1]='Sales';
    $x=1;
$orderSalesByDate = $database->getReference('Cart List/Admin View')->getChildKeys();
    foreach ($orderSalesByDate as $orders) {
      $prod = $database->getReference('Cart List/Admin View/' . $orders . '/products')->getValue();
      foreach ($prod as $column) {
        $bestSellerProducts[$column['name']] ??= 0;
        $bestSellerProducts[$column['name']] += intval($column['quantity']);
      }
    }
    foreach($bestSellerProducts as $key =>$value){
        $data[$x][0]=$key;
        $data[$x][1]=$value;
        $x++;
              }

    echo json_encode($data);
?>
