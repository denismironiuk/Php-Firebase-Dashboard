<?php
include('../dbcon.php');
include('../functions/functions.php');

/*************UPDATE Category IN REALTIME DATABASE */

if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $categoryId = $_POST['categoryId'];

    
    if (isset($_POST['categoryName']) && $_POST['categoryName']!=="" ){
        $categoryName = $_POST['categoryName'];
    
    $updateData = [
        'categoryName' => $categoryName,
    ];

    $updateName = $database->getReference('Category')->getChild($categoryId)->getValue();
    if (trim(strtolower($updateName['categoryName']))=== trim(strtolower($categoryName))) {

        $post = $database->getReference('Category/'.$categoryId)->update($updateData);
     echo "success";
       
        exit();
    }



    if (isExistValueInSchema('Category', 'categoryName', $categoryName, $database)) {
        echo "<span class='error'>Category Already Exists .</span>";
       
        exit();
    } else {

        $post = $database->getReference('Category/'.$categoryId)->update($updateData);
        echo "success";
       
        exit();
    };


    $post = $database->getReference('Category/'.$categoryId)->update($updateData);
    echo "success";
    
    exit();
}
echo "<span class='error'>Category Not Be Blank.</span> ";
        
        exit();
}