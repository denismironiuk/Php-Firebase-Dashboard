<?php
include '../dbcon.php';

/************CHECK IF POST METHOD NOT NULL
* ORDER ALL PRODUCTS BY DATE
* LOAD JSON FILE OF ALL PRODUCTS PRICE BY CLICKED MONTH
*/

if ( isset( $_POST[ 'month' ] ) ) {
    $clickedMonth = $_POST[ 'month' ];
    $amountSales = [];
    $db = $database->getReference( 'Cart List/Admin View' )->getSnapshot()->numChildren();
    if ( $db>0 ) {
        $data[ 0 ][ 0 ] = 'Day';
        $data[ 0 ][ 1 ] = 'Sales';

        $x = 1;
        $db = $database->getReference( 'Cart List/Admin View' )->getValue();
        foreach ( $db as $key=>$order ) {
            $tempOrder = $order[ 'products' ];
            foreach ( $tempOrder as $orderKey=> $value ) {
                
                $newMonth = date( 'F', strtotime( $value[ 'date' ] ) );
                if ( trim( $clickedMonth ) == trim( $newMonth ) ) {

                    $amountSales[ $value[ 'date' ] ]??= 0;
                    $amountSales[ $value[ 'date' ] ] += ( intval( $value[ 'price' ] ) * ( intval( $value[ 'quantity' ] ) ) );
                }
            }
            ksort( $amountSales );
        }
        foreach ( $amountSales as $key =>$value ) {
            $data[ $x ][ 0 ] = $key;
            $data[ $x ][ 1 ] = $value;
            $x++;
        }
        echo json_encode( $data );
    }}
        ?>