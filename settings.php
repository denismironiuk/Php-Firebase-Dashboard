<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include './dbcon.php'?>

<?php

$data=[
    'interval'=>0
];
$post = $database->getReference('Settings')->push($data);
?>


<div class="grid_10">
    <div  class="box round first grid">

    <h1>Set Interval For Page Refresh</h1>
    <form class="settings-container">
        <label for="">Interval</label>
        <input type="number" value="0" name="number" id="number">
        <div>

            <button type="submit">Set</button>
        </div>


    </form>

    </div>
</div>
<?php include './inc/footer.php';
