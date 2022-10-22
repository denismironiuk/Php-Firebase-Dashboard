<?php
include '../dbcon.php';
include '../functions/functions.php';

/************* UPDATE BRAND IN REALTIME DATABASE ******************************
CHECK IF REQUEST METHOD "POST" AND SUBMIT DATA NOT BLANK **********************/

// if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
//     var_dump($_POST);
   
/*CHECK IF POST METHOD NOT NULL AND NOT BLANK*/
    if (isset($_POST['brandName']) && $_POST['brandName'] !== "") {
       
        $brandId = $_POST['brandId'];
        $brand = $_POST['brandName'];

        $updateData = [
            'brandName' => $brand,
        ];

        $updateName = $database->getReference('Brand')->getChild($brandId)->getValue();
        if (trim(strtolower($updateName['brandName'])) === trim(strtolower($brand))) {

            $post = $database->getReference('Brand/' . $brandId)->update($updateData);
           echo "success ";
           
            exit();
        }
/***********FUNCTION isExistValueInSchema RETURN TRUE IF NOT DUPLICATE VALUE (brand) AND FALSE IF VALUE EXIST */
        if (isExistValueInSchema('Brand', 'brandName', $brand, $database)) {
           echo "<span class='error'>Brand Already Exist .</span>";
            
            exit();
        } else {
/*********************** UPDATE DATA TO TABLE BRAND********************************/
            $post = $database->getReference('Brand/' . $brandId)->update($updateData);
          echo "success ";
            
            exit();
        }
        ;
 /*********************** UPDATE DATA TO TABLE BRAND********************************/
        $post = $database->getReference('Brand/' . $brandId)->update($updateData);
     echo "success ";
        
        exit();
    }
   echo "<span class='error'>Brand Must Not Be Blank.</span> ";
    
   
    exit();


/****************************************************************************** */