

<?php
include('../dbcon.php');
include('../functions/functions.php');


/****************INSERT Category TO REALTIME DATABASE****************************** */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['categoryName']) && $_POST['categoryName'] !== "") {
        $categoryName = $_POST['categoryName'];

        $postdata = [
            'categoryName' => $categoryName,
        ];

        $children = $database->getReference('Category')->getSnapshot()->numChildren();

        if ($children > 0) {

            /***********FUNCTION isExistValueInSchema RETURN TRUE IF NOT DUPLICATE VALUE (Category) AND FALSE IF VALUE EXIST */
            if (isExistValueInSchema('Category', 'categoryName', $categoryName, $database)) {
                echo "<span class='error'>Category Already Exists .</span>";


                exit();
            } else {

                $post = $database->getReference('Category')->push($postdata);
                echo "success";

                exit();
            };
        }
        /******************************************************************************************************* */
        $post = $database->getReference('Category')->push($postdata);
        echo "success ";

        exit();
    }
    echo "<span class='error'>Category Must Not Be Blank.</span> ";


    exit();
}
