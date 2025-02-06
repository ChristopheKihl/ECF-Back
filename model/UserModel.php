<?php

require_once ("./Database.php");

/**
 * Class UserModel
 *
 * Modèle pour gérer les opérations liées aux utilisateurs.
 */
class UserModel {

    /**
     * Récupère toutes les informations de l'utilisateur connecté.
     *
     * @return array Les données de l'utilisateur connecté.
     */
    public function readAll() {
        session_start();
        try {
            $db = Database::getInstance(); // Se connecte à la base de données
            $stmt = $db->prepare(
                "SELECT nom_client, prenom_client, adresse_client, telephone_client, email_client
                FROM client
                WHERE email_client = :username"
            );
            $stmt->bindValue(':username', $_SESSION['mail'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $exc) {
            exit($exc->getMessage());
        }
    }

    /**
     * Met à jour les informations de l'utilisateur connecté.
     *
     * @return bool True si la mise à jour est réussie, sinon false.
     */
    public function update() {
        session_start();
        try {
            $db = Database::getInstance(); // Se connecte à la base de données
            $stmt = $db->prepare(
                "UPDATE client
                SET adresse_client = :adresse, telephone_client = :telephone, email_client = :mail
                WHERE id_client = :id"
            );
            $stmt->bindValue(':adresse', $_POST['adresse'], PDO::PARAM_STR);
            $stmt->bindValue(':telephone', $_POST['telephone_client'], PDO::PARAM_STR);
            $stmt->bindValue(':mail', $_POST['email_client'], PDO::PARAM_STR);
            $stmt->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $exc) {
            exit($exc->getMessage());
        }
    }
}
?>