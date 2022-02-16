<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loginParameterClass
 *
 * @author z0047brw
 */
require_once 'FaceBookLiteConnection.php';

session_start();

class loginParameterClass {

    protected $username;
    protected $password;
    protected $dbConnection;

    public function __construct() {
        $this->dbConnection = new FaceBookLiteConnection();
        if (empty($_POST["username"])) {
            $_SESSION["UserNameEmpty"] = true;
        } else {
            $_SESSION["UserNameEmpty"] = false;
            $name = $_POST ["username"];
            if (!preg_match("/^[a-zA-z]*$/", $name)) {
                $_SESSION["InvalidInput"] = true;   //Only letters and whitespaces are allowed for user names
            } else {
                $_SESSION["InvalidInput"] = false;
                $this->username = $name;
            }
        }
        $this->password = md5(filter_input(INPUT_POST, "psw", FILTER_DEFAULT));
//            echo $this->password;
    }

    public function __getUsername() {
        return $this->username;
    }

    public function checkLogin() {
        $pdo = $this->dbConnection->getpdo();

        $sql = "select count(*) as IsAssigned from Benutzer where BenutzerName =:username;";
        $res = $pdo->prepare($sql);
        try {
            $res->execute(["username" => $this->username]);
        } catch (PDOException $e) {
            echo 'Abfrage fehlgeschlagen: ' . $e->getMessage();
            die();
        }
        $row = $res->fetch();
        if ($row["IsAssigned"] != 0) {
            $_SESSION["UserNameNotFound"] = false;
        } else {
            $_SESSION["UserNameNotFound"] = true;
        }

        $sql = "select BenutzerId from benutzer where BenutzerName=:username and Passwort=:password";
        $stmt = $pdo->prepare($sql);
        try {
            $stmt->execute(["username" => $this->username, "password" => $this->password]);
        } catch (PDOException $e) {
            echo 'Abfrage fehlgeschlagen: ' . $e->getMessage();
            die();
        }


        $row = $stmt->fetch();
        if ($row) {
            $_SESSION["LoginError"] = false;
            return true;
        } else {
            $_SESSION["LoginError"] = true;
        }
        return false;
    }

}
