<?php

require(__DIR__ . '/vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once("./Database.php");

$route = isset($_GET["route"]) ? $_GET["route"] : "home";

switch ($route) {
    case 'lol':
        echo 'ici';
        break;
    
    case "home":
        default:
            require_once("./controller/HomeController.php");
            $controller = new HomeController();
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $controller->doPOST();
} else {
    $controller->doGET();
}

?>