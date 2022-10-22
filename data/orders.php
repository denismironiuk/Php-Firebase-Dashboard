<?php

include '../dbcon.php';

$a = array();

/**LOAD JSON FILE WITH CUSTOMER ORDERS  BY SPECIFIED DATE AND TIME */

$db = $database->getReference( 'Cart List/Admin View' )->getValue();

foreach($db as $dbKey=>$dblist){
$orderSummary=$dblist['Orders Summary'];
    $custName = $database->getReference( 'Users/'.$dbKey )->getValue();

 
    $row[ 'name' ] = $custName[ 'm_sName' ];
    $row[ 'uid' ] = $dbKey;

    foreach ( $orderSummary as $key=>$date ) {

        $row[ 'date' ] = date( 'm-d-y', strtotime( $key ) ) ;

        $dateInSec = strtotime( $key );

        $rows = array();
        foreach ( $date as $dateKey=>$time ) {
            // var_dump( $dateKey );
            $row[ 'time' ] = $dateKey;

            $row[ 'all' ] = array( $dbKey, $dateInSec, $dateKey );

            $row[ 'amount' ] = count( $time );

            $a[] = $row;
        }

    }

}

echo json_encode( $a );

/**END LOADING */