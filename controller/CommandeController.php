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
        header('Content-Type: application/json');
        $input = json_decode(file_get_contents("php://input"), true);

        if (is_array($input)) {
            $results = [];
            foreach ($input as $item) {
                $data = $this->model->create($item);
                if ($data !== false) {
                    $results[] = $data;
                }
            }
            echo json_encode($results);
        } else {
            echo json_encode(['error' => 'Invalid input']);
        }
    }
}
?>