<?php

require_once ("./Database.php");

class UserModel{

    public function readAll() {
        session_start();
        try{
            $db = Database::getInstance(); //se connecte a la Base de données
            $stmt = $db->prepare(
                "SELECT nom_client, prenom_client, adresse_client, telephone_client, email_client
                FROM client
                WHERE email_client = :username");
            $stmt->bindValue(':username', $_SESSION['mail'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $exc) {
            exit($exc->getMessage());
        }
    }
}
?>