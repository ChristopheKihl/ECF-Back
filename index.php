<?php

require(__DIR__ . '/vendor/autoload.php');


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once("./Database.php");


$route = isset($_GET["route"]) ? $_GET["route"] : "home";

switch ($route) {

    case 'user': //Récupérer les données des pizzas dans la BDD
        require_once("./controller/UserController.php");
        $controller = new UserController();
        break;
    
    case 'pizza': //Récupérer les données des pizzas dans la BDD
        require_once("./controller/PizzaController.php");
        $controller = new PizzaController();
        break;
        
    case 'login': //Envoi vers le formulaire d'authentification
        require_once("./controller/LoginController.php");
        $controller = new LoginController();
        break;

    case 'register': //Envoi vers le formulaire d'authentification
        require_once("./controller/RegisterController.php");
        $controller = new RegisterController();
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