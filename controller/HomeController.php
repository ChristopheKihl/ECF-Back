<?php

require_once ("./Database.php");
require_once("./model/HomeModel.php");

class HomeController{
    private $model;

    function __construct()
    {
        $this->model = new HomeModel();
    }

    public function doGET()
    {
        $data = $this->model->readAll();
        echo json_encode($data);
        require "./view/home.php";

    }
    
    public function doPOST(){
        
    }
}
?>