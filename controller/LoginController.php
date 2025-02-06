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

    
    public function doPOST(){
        $data = $this->model->read();
        if($data === false){
            $exist = 2;
            $title = 'Se connecter';
            include ("view/LoginView.php");
        }else{
            session_start();
            $_SESSION['user'] = $data['prenom_client'];
            $_SESSION['mail'] = $data['email_client'];
            $_SESSION['id'] = $data['id_client'];
            header("location:./index.php");
        }
    }
}
?>