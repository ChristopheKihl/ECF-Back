<?php

require_once ("./Database.php");

/**
 * Class PizzaModel
 *
 * Modèle pour gérer les opérations liées aux pizzas.
 */
class PizzaModel {

    /**
     * Récupère toutes les pizzas et leurs informations associées.
     *
     * @return array Les données de toutes les pizzas.
     */
    public function readAll() {
        try {
            $db = Database::getInstance(); // Se connecte à la base de données
            $stmt = $db->prepare(
                "SELECT pizza.nom_pizza, base.nom_base, pizza.prix_pizza, images.chemin_image, images.description_image, GROUP_CONCAT(ingredient.nom_ingredient SEPARATOR ',') as ingredients
                FROM pizza
                JOIN base
                ON base.id_base = pizza.id_base
                JOIN compose
                ON compose.id_pizza = pizza.id_pizza
                JOIN ingredient
                ON compose.id_ingredient = ingredient.id_ingredient
                JOIN images
                ON images.image_pizza = pizza.id_pizza
                GROUP BY pizza.nom_pizza"
            );
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $exc) {
            exit($exc->getMessage());
        }
    }
}
?>