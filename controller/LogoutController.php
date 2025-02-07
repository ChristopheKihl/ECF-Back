<?php

require_once("./model/LoginModel.php");

/**
 * Class LogoutController
 *
 * Contrôleur pour gérer les requêtes GET et POST de la page de déconnexion.
 */
class LogoutController {
    /**
     * @var LoginModel Instance du modèle pour interagir avec la base de données.
     */
    private $model;

    /**
     * Constructeur de la classe LogoutController.
     * Initialise le modèle de connexion.
     */
    function __construct() {
        $this->model = new LoginModel();
    }

    /**
     * Gère les requêtes GET.
     * Détruit la session utilisateur et redirige vers la page d'accueil.
     */
    public function doGET() {
        session_start();
        session_destroy();
        header("location:./index.php");
    }

    /**
     * Gère les requêtes POST.
     * (À implémenter selon les besoins spécifiques de l'application)
     */
    public function doPOST() {
        // Code pour gérer les requêtes POST
    }
}
?>