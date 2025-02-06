<?php

require_once ("./Database.php");
require_once("./model/UserModel.php");

/**
 * Class UserController
 *
 * Contrôleur pour gérer les requêtes GET et POST de la page des utilisateurs.
 */
class UserController {
    /**
     * @var UserModel Instance du modèle pour interagir avec la base de données.
     */
    private $model;

    /**
     * Constructeur de la classe UserController.
     * Initialise le modèle des utilisateurs.
     */
    function __construct() {
        $this->model = new UserModel();
    }

    /**
     * Gère les requêtes GET.
     * Récupère tous les utilisateurs et renvoie les données au format JSON.
     */
    public function doGET() {
        $data = $this->model->readAll();
        header('Content-type: application/json');
        echo json_encode($data);
    }

    /**
     * Gère les requêtes POST.
     * Met à jour les informations de l'utilisateur et redirige vers la page d'accueil si la mise à jour est réussie.
     */
    public function doPOST() {
        $data = $this->model->update();
        if ($data === true) {
            session_abort();
            header("location:./index.php");
        }
    }
}
?>