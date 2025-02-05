<?php

class HomeController{
    private $model;

    function __construct()
    {
        
    }

    public function doGET()
    {
        require "./view/HomeView.php";

    }
    
    public function doPOST(){
        
    }
}
?>