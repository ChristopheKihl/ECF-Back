<?php

require_once ("./Database.php");

class LoginModel{
    private $model;

    public function read() {
        try{
            if(!isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['user'];
                $password = $_POST['password'];
                // $password = password_hash($_POST['password'],PASSWORD_BCRYPT);

                $db = Database::getInstance(); //se connecte a la Base de données
                $stmt = $db->prepare(
                    "SELECT prenom_client, email_client, mot_de_passe_client
                    FROM client
                    WHERE email_client = :username AND mot_de_passe_client = :password");
                $stmt->bindValue(':username', $username, PDO::PARAM_STR);
                $stmt->bindValue(':password', $password, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch();
            }
        } catch (PDOException $exc) {
            exit($exc->getMessage());
        }
    }
}
?>