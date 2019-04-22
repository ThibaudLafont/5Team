<?php
// Error show
/////////////
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

//AUTOLOADER
/////////////
require(__DIR__ . '/core/Autoloader.php');
\Core\Autoloader::register();

// Create Company
$company = new \App\Company([
    'developerOffices' => require(__DIR__ . '/data/developerOffices.php'),
    'commercialOffices'=> require(__DIR__ . '/data/commercialOffices.php')
]);

// Hire workers
$company->hire();
