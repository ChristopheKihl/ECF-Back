<?php

require_once ("./Database.php");
require_once("./model/LoginModel.php");

class LoginController{
    private $model;

    function __construct()
    {
        $this->model = new LoginModel();
    }

    public function doGET(){
            $title = "Se connecter";
            
            require("view/LoginView.php");
        }
        // $data = $this->model->readAll();
        // header('Content-type: application/json');
        // echo json_encode($data);

    
    public function doPOST(){
        $data = $this->model->read();
        if($data){
            echo 'OK !!!';
        }else {
            echo 'VA TE FAIRE FOUTRE !!!';
        }
    }
}
?>