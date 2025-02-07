<?php

require_once ("./Database.php");
require_once("./model/LoginModel.php");

/**
 * Class LoginController
 *
 * Contrôleur pour gérer les requêtes GET et POST de la page de connexion.
 */
class LoginController {
    
    /**
     * @var LoginModel Instance du modèle pour interagir avec la base de données.
     */
    private $model;

    /**
     * Constructeur de la classe LoginController.
     * Initialise le modèle de connexion.
     */
    function __construct() {
        $this->model = new LoginModel();
    }

    /**
     * Gère les requêtes GET.
     * Charge la vue de la page de connexion.
     */
    public function doGET() {
        $title = "Se connecter";
        require("view/LoginView.php");
    }

    /**
     * Gère les requêtes POST.
     * Vérifie les informations de connexion et initialise la session utilisateur.
     */
    public function doPOST() {
        $data = $this->model->read();
        if ($data === false) {
            $exist = 2;
            $title = 'Se connecter';
            include("view/LoginView.php");
        } else {
            session_start();
            $_SESSION['user'] = $data['prenom_client'];
            $_SESSION['mail'] = $data['email_client'];
            $_SESSION['id'] = $data['id_client'];
            header("location:./index.php");
        }
    }
}
?>