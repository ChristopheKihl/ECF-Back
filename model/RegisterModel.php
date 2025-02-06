<?php

require_once ("./Database.php");

class RegisterModel{
    private $model;

    public function read() {
        try{
            if(
                isset($_POST['lastname']) && 
                isset($_POST['firstname']) && 
                isset($_POST['adresse']) && 
                isset($_POST['phone']) &&
                isset($_POST['mail']) &&
                isset($_POST['password']))
                {
                $db = Database::getInstance(); //se connecte a la Base de données
                $stmt = $db->prepare(
                    "SELECT * FROM client
                    WHERE email_client = :mail");
                $stmt->bindValue(':mail', $_POST['mail'], PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch();
            }
        } catch (PDOException $exc) {
            exit($exc->getMessage());
        }
    }


    public function create() {
        try{
            $db = Database::getInstance(); //se connecte a la Base de données
            $stmt = $db->prepare(
                "INSERT INTO client(nom_client, prenom_client, adresse_client, telephone_client, email_client, mot_de_passe_client)
                VALUES (:lastname,:firstname,:adresse,:phone,:mail,:pass)");
            $stmt->bindValue(':lastname', $_POST['lastname'], PDO::PARAM_STR);
            $stmt->bindValue(':firstname', $_POST['firstname'], PDO::PARAM_STR);
            $stmt->bindValue(':adresse', $_POST['adresse'], PDO::PARAM_STR);
            $stmt->bindValue(':phone', $_POST['phone'], PDO::PARAM_STR);
            $stmt->bindValue(':mail', $_POST['mail'], PDO::PARAM_STR);
            $stmt->bindValue(':pass', password_hash($_POST['password'],PASSWORD_DEFAULT), PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $exc) {
            exit($exc->getMessage());
        }
    }
}
?>