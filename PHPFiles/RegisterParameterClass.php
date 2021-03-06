<?php

require_once 'FaceBookLiteConnection.php';

class registerParameterClass {

    protected $dbConnection;
    protected $eMail;
    protected $password;
    protected $username;

    public function __construct() {

        $this->dbConnection = new FaceBookLiteConnection(); 
        if (empty($_POST["username"])) 
            {
                $errMsg = "Error! You didn't enter the Name.";
                echo $errMsg;
            } 
            else 
            {
                $name = $_POST ["username"];
                if (!preg_match ("/^[a-zA-z]*$/", $name) )
                {
                    $ErrMsg = "Only alphabets and whitespace are allowed.";
                    echo $ErrMsg;
                }
                else 
                {
                    $this->username=$name;

                }
            }
        $this->dbConnection = new FaceBookLiteConnection();
        $this->eMail = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

        $this->password = md5(filter_input(INPUT_POST, "psw", FILTER_DEFAULT));
        echo $this->password;
    }

    public function checkUsername() {
        $sql = "select BenutzerId from benutzer where BenutzerName=:username";
        $stmt = $this->dbConnection->getpdo()->prepare($sql);
        try {
            $stmt->execute(["username" => $this->username]);
        } catch (PDOException $e) {
            echo "<script>console.log('abc')</script>";
            echo 'Abfrage fehlgeschlagen: ' . $e->getMessage();
            die();
        }
        $row = $stmt->fetch();

        if ($row) {
            echo "Benutzername bereits vergeben <br>";
            $_SESSION["RegisterUsernameAlreadyTaken"] = true;
            return false;
        }
        $_SESSION["RegisterUsernameAlreadyTaken"] = false;
        return true;
    }

    public function getUsername() {
        return $this->username;
    }

    public function checkEmail() {
        $sql = "select BenutzerId from benutzer where EMail=:email";
        $stmt = $this->dbConnection->getpdo()->prepare($sql);

        try {
            $stmt->execute(array("email" => $this->eMail));
        } catch (PDOException $e) {
            echo "<script>console.log('abc')</script>";
            echo 'Abfrage fehlgeschlagen: ' . $e->getMessage();
            die();
        }
        $row = $stmt->fetch();
        if ($row) {
            echo"email bereits vergeben <br>";

            $_SESSION["RegisterEmailAlreadyTaken"] = true;

            return false;
        }
        $_SESSION["RegisterEmailAlreadyTaken"] = false;
        return true;
    }

    public function insertNewUser() {

        $sql = "INSERT INTO Benutzer (BenutzerName, EMail, Passwort) VALUES ( :username, :email , :password);";
        $stmt = $this->dbConnection->getpdo()->prepare($sql);

        try {
            $stmt->execute(["username" => $this->username, "email" => $this->eMail, "password" => $this->password]);
        } catch (PDOException $e) {

            echo 'Einf??gen fehlgeschlagen: ' . $e->getMessage();
            die();
        }
    }

}
