

<?php

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start();
include ('dbcon.php');

if(!isset($_SESSION['verified_user_id']))
header("Location:login.php");



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Admin</title>
    
    <!--CSS LOADING-->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/custoTable.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link rel="stylesheet" href="css/settings.css" media="screen">

    <!--END CSS-->

    <!--SCRIPT LOADING-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script  src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script  src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script  src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script  src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script  src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script   type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script  src="js/setup.js" type="text/javascript"></script>

    <!--END LOADING SCRIPT-->

	 <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu(); //SET SIDEBAR FROM LEFT
            setSidebarHeight(); //SET SIDEBAR AUTO HEIGHT
        });
    </script>
</head>

<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">

                <div class="floatleft middle">
                    <h1></h1>
                    <p></p>
                </div>
                <div class="floatright">
                    <div class="floatleft">
                        <!-- <img src="" alt="Profile Pic" />  OPTION TO LOAD PROFILE IMAGE-->
                    </div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">

                            <?php
/**CHECK IF USER ACTION LOGOUT */
if (isset($_GET['action']) && $_GET['action'] == "logout") {

    /***********CLEAR CHOOSEN SESSION **********/
    
    unset($_SESSION['verified_user_id']);

    /***************************************** */
    /*RETURN TO LOGIN PAGE*/
    header("Location:./login.php");
}

?>
                            <li><a href="?action=logout">Logout</a></li>


                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul style="display: flex; justify-content:space-around" class="nav main">

                <li class="ic-dashboard"><a href="dashbord.php"><span>Dashboard</span></a> </li>
                <li class="ic-grid-tables"><a href="mainorder.php"><span>Order</span></a></li>

            </ul>
        </div>
        <div class="clear">
        </div>

        <!--END-->