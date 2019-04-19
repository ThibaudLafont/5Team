<?php
// Error show
/////////////
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//ROOT PATH
///////////
define('ROOT', dirname(__DIR__));


//AUTOLOADER
/////////////
require(ROOT . '/core/Service/Autoloader.php');
\Core\Service\Autoloader::register();

//DIC
/////
$dic = new \Core\Service\DIC();

//$dic->addDefinitions(ROOT . '/config/DIC/config.php');   //Variables d'environnement
$dic->addDefinitions(ROOT . '/config/DIC/classes.php');    //Classes
//$dic->addDefinitions(ROOT . '/config/DIC/method.php');   //Appel méthodes classe nécessitant dépendance


//ROUTER
////////
$router = $dic->get('Router');

$router->addDefinitions(ROOT . '/config/Router/routes.php');  //Ajout des routes

$router->execute($_SERVER['REQUEST_URI']);                    //Execution du router
