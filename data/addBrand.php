<?php
include '../dbcon.php';
include '../functions/functions.php';


/****************INSERT BRAND TO REALTIME DATABASE***************************** 
CHECK IF REQUEST METHOD "POST"  **********************/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

/*CHECK IF POST METHOD NOT NULL AND NOT BLANK*/

    if (isset($_POST['brandName']) && $_POST['brandName'] !== "") {
        $brand = $_POST['brandName'];

        $postdata = [
            'brandName' => $brand,
        ];

        $children = $database->getReference('Brand')->getSnapshot()->numChildren();

        if ($children > 0) {

/********************** FUNCTION isExistValueInSchema RETURN TRUE **************
 ********************** IF NOT DUPLICATE VALUE AND FALSE IF VALUE EXIST */
            if (isExistValueInSchema('Brand', 'brandName', $brand, $database)) {
                echo "<span class='error'>Brand Already Exists .</span>";
               
                exit();
            } else {

/*********************** ADD DATA TO TABLE BRAND********************************/

                $post = $database->getReference('Brand')->push($postdata);
                echo "success";
                // header("Location:../addBrand.php");
                exit();
            }
            ;
        }
/******************************************************************************* 
 *********************** ADD DATA TO TABLE BRAND********************************/
        $post = $database->getReference('Brand')->push($postdata);
        echo  "success";
      
        // header("Location:../addBrand.php");
        exit();
    }
    echo "<span class='error'>Brand Must Not Be Blank.</span> ";

    // header("Location:../addBrand.php");
    exit();
}
/****************************************************************************** */
