<?php

require_once('./model/CommandeModel.php');

class CommandeController {

    private $model;

    /**
     * Constructeur de la classe CommandeController.
     * Initialise une instance de CommandeModel.
     */
    function __construct(){
        $this->model = new CommandeModel();
    }

    /**
     * Gère les requêtes GET.
     * Cette méthode est actuellement vide et doit être implémentée pour traiter les requêtes GET.
     */
    public function doGET()
    {
        // Code pour gérer les requêtes GET
    }

    /**
     * Gère les requêtes POST.
     * Cette méthode récupère les données de la commande envoyées en JSON,
     * extrait les informations nécessaires et crée une nouvelle commande.
     */
    public function doPOST(){
        session_start();

        header('Content-Type: application/json');
        $json = json_decode(file_get_contents("php://input"));

        $id_client = $_SESSION['id'];
        $id_pizza = '';
        $quantite = '';
        
        foreach ($json as $data) {
            foreach ($data as $key => $value) {

                if($key === 'nomPizza'){
                    $dataPizza = $this->model->readPizza($value); // Récupère l'ID de la pizza
                    foreach ($dataPizza as $key => $value) {
                        $id_pizza = $value;
                    }
                }
                if($key === 'quantite'){
                    $quantite = $value;
                }
            }
            $result = $this->model->createCommande($id_pizza, $id_client, $quantite);
        }
        echo $result; // Affiche le résultat de la création de la commande
    }
}