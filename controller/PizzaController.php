<?php

require_once ("./Database.php");
require_once("./model/PizzaModel.php");

/**
 * Class PizzaController
 *
 * Contrôleur pour gérer les requêtes GET et POST de la page des pizzas.
 */
class PizzaController {
    /**
     * @var PizzaModel Instance du modèle pour interagir avec la base de données.
     */
    private $model;

    /**
     * Constructeur de la classe PizzaController.
     * Initialise le modèle des pizzas.
     */
    function __construct() {
        $this->model = new PizzaModel();
    }

    /**
     * Gère les requêtes GET.
     * Récupère toutes les pizzas et renvoie les données au format JSON.
     */
    public function doGET() {
        $data = $this->model->readAll();
        header('Content-type: application/json');
        echo json_encode($data);
    }

    /**
     * Gère les requêtes POST.
     */
    public function doPOST() {
        // Code pour gérer les requêtes POST
    }
}
?>