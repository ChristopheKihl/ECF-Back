<?php

/**
 * Class HomeController
 *
 * Contrôleur principal pour gérer les requêtes GET et POST de la page d'accueil.
 */
class HomeController {
    /**
     * @var Model Instance du modèle pour interagir avec la base de données.
     */
    private $model;

    /**
     * Constructeur de la classe HomeController.
     * Initialise le modèle avec les paramètres de connexion à la base de données.
     */
    function __construct()
    {}

    /**
     * Gère les requêtes GET.
     * Charge la vue de la page d'accueil.
     */
    public function doGET()
    {
        require "./view/HomeView.php";
    }

    /**
     * Gère les requêtes POST.
     * (À implémenter selon les besoins spécifiques de l'application)
     */    
    public function doPOST(){
        // Code pour gérer les requêtes POST
    }
}
?>