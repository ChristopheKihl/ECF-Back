<?php

require_once ("./Database.php");

/**
 * Class CommandeModel
 *
 * Modèle pour interagir avec la table des commandes dans la base de données.
 */
class CommandeModel {

    /**
 * Lit les enregistrements de la table pizza en fonction du nom de la pizza.
 *
 * @param string $value Le nom de la pizza.
 * @return array|false L'ID de la pizza si trouvé, false en cas d'erreur.
 */
    public function readPizza($value) {
        try {
            $db = Database::getInstance();
            $stmt = $db->prepare(
                "SELECT id_pizza FROM pizza WHERE nom_pizza = :value"
            );
            $stmt->bindParam(':value', $value);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $exc) {
            return false;
        }
    }

    /**
 * Crée une nouvelle commande dans la table commande.
 *
 * @param int $pizza L'ID de la pizza commandée.
 * @param int $client L'ID du client qui passe la commande.
 * @param int $quantite La quantité de pizzas commandées.
 * @return bool True si l'insertion a réussi, false sinon.
 */
    public function createCommande($pizza,$client, $quantite) {
        $date = date("Y-m-d H:i:s");
        try {
            $db = Database::getInstance();
            $stmt = $db->prepare(
                "INSERT INTO commande (id_pizza, id_client, quantite_commande, date_commande) VALUES (:idpizza, :idclient, :quantite, :datecommande)"
            );
            $stmt->bindParam(':idpizza', $pizza);
            $stmt->bindParam(':idclient', $client);
            $stmt->bindParam(':quantite', $quantite);
            $stmt->bindParam(':datecommande', $date);
            $stmt->execute();
            return true;

        } catch (PDOException $exc) {
            return false;
        }
    }
}
?>