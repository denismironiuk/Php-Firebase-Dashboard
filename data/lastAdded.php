
<?php

/****************LOAD JSON FILE WITH THREE LAST ADDED PRODUCTS */

include '../dbcon.php';

/** GET ALL PRODUCTS FROM TABLE.
 *  ORDER BY DATE
 * RETURN 3 LAST ADDED */

$db=$database->getReference('products')->orderByChild('start_date')->getValue(); 
$rows=array();
foreach($db as  $data){
    
        $rows[]=$data;
    
    
}
krsort($rows); // SORT VALUE ASCENDING ORDER
echo json_encode(  array_slice($rows,0,3));

?>