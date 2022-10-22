<?php
include '../dbcon.php';

/************CHECK IF POST METHOD NOT NULL 
 * ORDER ALL PRODUCTS BY DATE
 * LOAD JSON FILE OF ALL PRODUCTS PRICE BY CLICKED MONTH
*/

if(isset($_POST['month'])){
    $clickedMonth=$_POST['month'];
$amountSales=[];
$db = $database->getReference('Cart List/Admin View')->getSnapshot()->numChildren();
if($db>0){
    $data[0][0]='Day';
    $data[0][1]='Sales';
    
    $x=1;
    $db = $database->getReference('Cart List/Admin View')->getChildKeys();
    foreach($db as $orders){
        $prod = $database->getReference('Cart List/Admin View/' . $orders . '/products')->getValue();
   
        foreach ($prod as $column) {
            $newMonth=date('F',strtotime($column['date']));
            if(trim($clickedMonth)==trim($newMonth)){
                
                $amountSales[$column['date']]??=0;
                $amountSales[$column['date']] += (intval($column['price']) * (intval($column['quantity'])));
            }
        }
        ksort($amountSales);
        }
      foreach($amountSales as $key =>$value){
$data[$x][0]=$key;
$data[$x][1]=$value;
$x++;
      }
      echo json_encode($data);
    }

}
?>