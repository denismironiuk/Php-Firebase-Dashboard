

<?php
/***************FIREBASE CONNECTION******************* */
require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Database\Query\Filter\LimitToFirst;
use Kreait\Firebase\Factory;
$factory = (new Factory)
->withServiceAccount('easybuy-690d0-firebase-adminsdk-p43yk-67ec73ed42.json')
->withDatabaseUri('https://easybuy-690d0-default-rtdb.firebaseio.com/');

$database = $factory->createDatabase();


$auth = $factory->createAuth();
