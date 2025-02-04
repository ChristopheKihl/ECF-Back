<?php

require_once ("./Database.php");

class HomeController{
    function __construct()
    {
        
    }

    public function doGET()
    {
        self::doPOST();
    }
    
    public function doPOST()
    {
        $db = Database::getInstance();
        $stmt = $db->prepare(
            "SELECT pizza.nom_pizza, base.nom_base, pizza.prix_pizza, GROUP_CONCAT(ingredient.nom_ingredient SEPARATOR ',') as ingredients
            FROM pizza
            JOIN base
            ON base.id_base = pizza.id_base
            JOIN compose
            ON compose.id_pizza = pizza.id_pizza
            JOIN ingredient
            ON compose.id_ingredient = ingredient.id_ingredient
            GROUP BY pizza.nom_pizza");
        $stmt->execute();
        $result = $stmt->fetchAll();

        require("./view/home.php");
    }
}
?>