<?php

require_once ("./Database.php");

/**
 * Class CommandeModel
 *
 * Modèle pour interagir avec la table des commandes dans la base de données.
 */
class CommandeModel {

    /**
     * Lit les enregistrements de la table clients en fonction d'une clé et d'une valeur.
     *
     * @param string $key La clé pour la condition WHERE.
     * @param mixed $value La valeur pour la condition WHERE.
     * @return array|false Les enregistrements trouvés ou false en cas d'erreur.
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
     * @param array $data Les données de la commande à insérer.
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