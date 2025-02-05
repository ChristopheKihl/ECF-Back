<?php

require(__DIR__ . '/vendor/autoload.php');


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once("./Database.php");


$route = isset($_GET["route"]) ? $_GET["route"] : "home";

switch ($route) {
    
    case 'pizza': //Récupére les données des pizzas dans la BDD
        require_once("./controller/PizzaController.php");
        $controller = new PizzaController();
        break;
        
    case 'verification': //Vérifie si le client est déja authentifié ou non
        require_once("./controller/VerificationController.php");
        $controller = new VerificationController();
        break;

    case "home": //Affichage du site
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