<?php

require_once ("./Database.php");
require_once("./model/UserModel.php");

class userController{
    private $model;

    function __construct()
    {
        $this->model = new UserModel();
    }

    public function doGET()
    {
        $data = $this->model->readAll();
        header('Content-type: application/json');
        echo json_encode($data);
    }
    
    public function doPOST(){
        $data = $this->model->update();
        if($data === true){
            session_abort();
            header("location:./index.php");
        }
    }
}
?>