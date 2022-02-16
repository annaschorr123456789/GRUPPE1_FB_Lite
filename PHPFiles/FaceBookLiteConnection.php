<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FaceBookLiteConnection {

    protected static $pdo = null;

    public function __construct() {
        $dbhost = "localhost";
        $dbname = "facebooklite";
        $dbuser = "root";
        $dbpassword = "";

        if (FaceBookLiteConnection::$pdo == null) {
            try {
                //$pdo = new PDO('mysql:host=' . $dbhost , $dbuser, $dbpassword);
                FaceBookLiteConnection::$pdo = new PDO('mysql:host=' . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpassword);
                FaceBookLiteConnection::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Verbindung fehlgeschlagen: ' . $e->getMessage();
            }
        }
    }

    public function getpdo() {
        return FaceBookLiteConnection::$pdo;
    }

    public function query($sql, $format = PDO::FETCH_ASSOC) {
        try {
            $res = FaceBookLiteConnection::$pdo->query($sql);
            $rows = $res->fetchall($format);
            //var_dump($rows);
            return $rows;
        } catch (Exception $ex) {
            echo __FILE__ . " " . __LINE__ . $ex->getMessage();
            die();
        }
    }

    public function execute($sql) {
        FaceBookLiteConnection::$pdo->query($sql);
    }

}
