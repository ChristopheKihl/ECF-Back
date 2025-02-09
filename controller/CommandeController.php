<?php

require_once('./model/CommandeModel.php');

class CommandeController {

    private $model;

    function __construct(){
        $this->model = new CommandeModel();
    }

    public function doGET()
    {
        // Code pour gérer les requêtes GET
    }

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
                    $dataPizza = $this->model->readPizza($value); //Récupère l'ID de la pizza
                    // var_dump($idPizza);
                    foreach ($dataPizza as $key => $value) {
                        $id_pizza = $value;
                    }
                }
                if($key === 'quantite'){
                    $quantite = $value;
                }
            }
            $result = $this->model->createCommande($id_pizza,$id_client, $quantite);
        }
        echo $result;
    }
}
?>