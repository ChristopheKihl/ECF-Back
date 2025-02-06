<?php

require_once ("./Database.php");

/**
 * Class LoginModel
 *
 * Modèle pour gérer les opérations de connexion des utilisateurs.
 */
class LoginModel {
    /**
     * @var Database Instance de la base de données.
     */
    private $model;

    /**
     * Vérifie les informations de connexion de l'utilisateur.
     *
     * @return array|false Les données de l'utilisateur si la connexion est réussie, sinon false.
     */
    public function read() {
        try {
            if (isset($_POST['user']) && isset($_POST['password'])) {
                // $password = password_hash($_POST['password'],PASSWORD_BCRYPT);

                $db = Database::getInstance(); // Se connecte à la base de données
                $stmt = $db->prepare(
                    "SELECT *
                    FROM client
                    WHERE email_client = :username"
                );
                $stmt->bindValue(':username', $_POST['user'], PDO::PARAM_STR);
                $stmt->execute();
                $data = $stmt->fetch();
                if ($data && $data['email_client'] === $_POST['user'] && password_verify($_POST['password'], $data['mot_de_passe_client'])) { // Si User et MDP sont OK
                    return $data;
                } else { // Si User et MDP sont NOK
                    return false;
                }
            }
        } catch (PDOException $exc) {
            exit($exc->getMessage());
        }
    }
}
?>