<?php

require_once ("./Database.php");
require_once("./model/RegisterModel.php");

/**
 * Class RegisterController
 *
 * Contrôleur pour gérer les requêtes GET et POST de la page d'inscription.
 */
class RegisterController {
    
    /**
     * @var RegisterModel Instance du modèle pour interagir avec la base de données.
     */
    private $model;

    /**
     * Constructeur de la classe RegisterController.
     * Initialise le modèle d'inscription.
     */
    function __construct() {
        $this->model = new RegisterModel();
    }

    /**
     * Gère les requêtes GET.
     * Charge la vue de la page d'inscription.
     */
    public function doGET() {
        $title = "S'inscrire";
        require("view/RegisterView.php");
    }

    /**
     * Gère les requêtes POST.
     * Vérifie si l'utilisateur existe déjà, sinon crée un nouvel utilisateur et initialise la session.
     */
    public function doPOST() {
        $userExist = $this->model->read(); // Vérifie si l'utilisateur existe déjà dans la BDD

        if ($userExist == false) {
            $data = $this->model->create(); // Crée l'utilisateur dans la BDD
            session_start();
            $_SESSION['user'] = $_POST['firstname'];
            $_SESSION['mail'] = $_POST['mail'];
            header("location:./index.php");
        } else {
            $exist = 1;
            $title = 'Se connecter';
            include("view/LoginView.php");
        }
    }
}
?>