<?php

require_once ("./Database.php");
require_once("./model/RegisterModel.php");

class RegisterController{
    private $model;

    function __construct()
    {
        $this->model = new RegisterModel();
    }

    public function doGET(){
            $title = "S'inscrire";
            require("view/RegisterView.php");
        }

    
    public function doPOST(){
        $userExist = $this->model->read(); //Vérifie si l'utilisateur existe déjà dans la BDD

        if($userExist == false){
            $data = $this->model->create(); //Crée l'utilisateur dans la BDD
            session_start();
            $_SESSION['user'] = $_POST['lastname'];
            header("location:./index.php");
        }else{
            $exist = 1;
            $title = 'Se connecter';
            include ("view/LoginView.php");
        }
    }
}
?>