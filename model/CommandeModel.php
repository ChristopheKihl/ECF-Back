<?php

require_once ("./Database.php");

class CommandeModel {

    public function read($key, $value) {
        try {
            $db = Database::getInstance();
            $stmt = $db->prepare(
                "SELECT * FROM clients WHERE $key = :value"
            );
            $stmt->bindParam(':value', $value);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $exc) {
            return false;
        }
    }

    public function create($data) {
        $date = date("Y-m-d H:i:s");
        try {
            $db = Database::getInstance();
            $stmt = $db->prepare(
                "INSERT INTO commande (id_pizza, id_client, quantite_commande, date_commande) VALUES (:idpizza, :idclient, :quantite, :datecommande)"
            );
            $stmt->bindParam(':idpizza', $data['value1']);
            $stmt->bindParam(':idclient', $_SESSION['id']);
            $stmt->bindParam(':quantite', $data['value3']);
            $stmt->bindParam(':datecommande', $date);
            $stmt->execute();
            return true;

        } catch (PDOException $exc) {
            return false;
        }
    }
}
?>