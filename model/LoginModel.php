<?php

require_once ("./Database.php");

class LoginModel{
    private $model;

    public function read() {
        try{
            if(isset($_POST['user']) && isset($_POST['password'])) {
                // $password = password_hash($_POST['password'],PASSWORD_BCRYPT);

                $db = Database::getInstance(); //se connecte a la Base de données
                $stmt = $db->prepare(
                    "SELECT *
                    FROM client
                    WHERE email_client = :username");
                $stmt->bindValue(':username', $_POST['user'], PDO::PARAM_STR);
                $stmt->execute();
                $data =  $stmt->fetch();
                if($data && $data['email_client'] === $_POST['user'] && password_verify($_POST['password'], $data['mot_de_passe_client'])){ //Si User et MDP sont OK
                    return $data;
                }else{ // Si User et MDP sont NOk
                    return false;
                }
            }
        } catch (PDOException $exc) {
            exit($exc->getMessage());
        }
    }
}
?>