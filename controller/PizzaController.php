<?php

require_once ("./Database.php");
require_once("./model/PizzaModel.php");

class PizzaController{
    private $model;

    function __construct()
    {
        $this->model = new PizzaModel();
    }

    public function doGET()
    {
        $data = $this->model->readAll();
        header('Content-type: application/json');
        echo json_encode($data);

    }
    
    public function doPOST(){
    }
}
?>