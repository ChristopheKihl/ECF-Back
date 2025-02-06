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

        var_dump($userExist);

        if($userExist){
            $exist = true;
            $title = 'Se connecter';
            include ("view/LoginView.php");
        }else{
            $data = $this->model->create(); //Crée l'utilisateur dans la BDD
                $_SESSION['user'] = $_POST['firstname'];
            include ("index.php");
        }
    }
}
?>