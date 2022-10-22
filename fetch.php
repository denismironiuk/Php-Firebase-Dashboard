<?php
include('./dbcon.php');

if(isset($_POST["month"]))
{
  
    $db=$database->getReference('Cart List/Admin View')->getChildKeys();
    $dates=array();
    foreach($db as $value){
      $monthList = $database->getReference('Cart List/Admin View/' . $value . '/products')->orderByChild('date')->getValue();
  foreach($monthList as $date){
 $newMonth=date('F',strtotime($date['date']));
 if($_POST['month'] == $newMonth){
    $output[] = array(
        'month'   => $date['date'],
        'profit'  => floatval($date['price'])
       );
 }
}
  
 }
 echo json_encode($output);
}

?>