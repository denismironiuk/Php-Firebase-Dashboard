<?php

require '../dbcon.php';

/** CHECK IF POST METHOD NOT NULL*/

if(isset($_POST['edit_id'])){
    $id=$_POST['edit_id'];
    $date=$_POST['date'];
    $time=$_POST['time'];
 $specifiedDate=date('d M, Y',$date);
 $specifiedTime=date('H:i:s a',strtotime($time));

 ?>
 <!--LOAD TABLE -->
 <table class="table">
 <thead>
   <tr>
     
     <th scope="col">Product</th>
     <th scope="col">Price</th>
     <th scope="col">Quantity</th>
     <th scope="col">Total</th>
   </tr>
 </thead>
 <tbody>
  <?php
  /** GET ORDERS BY SPECIFIED DATE AND TIME*/
 $db=$database->getReference('Cart List/Admin View/'.$id.'/'.'Orders Summary/'.$specifiedDate.'/'.$specifiedTime)->getValue();
 $totalOrder=0;
 
 foreach($db as $value){
  /**TOTAL AMOUNT PRICE THROW SPECIFIED PRODUCT */
$totalOrder+=intval($value['price'])*intval($value['quantity']);
  ?><tr>
      
      <td><?= $value['name'] ?></td>
      <td><?= $value['price']?></td>
      <td><?= $value['quantity']?></td>
       
      <td>Total: <?=intval($value['price'])*intval($value['quantity'])?> &#8362;</td>
    </tr>
    

 <?php }

        
    
}

?>

    
      
      
      
      <td colspan="3"></td>
      <td>Total:<?= $totalOrder ?> &#8362;</td>
    </tr>
  </tbody>
</table>