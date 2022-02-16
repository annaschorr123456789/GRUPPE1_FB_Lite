<?php

require_once 'FaceBookLiteConnection.php';

$pdo = new FaceBookLiteConnection();
$res = [];

$UserId = filter_input(INPUT_GET, "UserId");

if (filter_has_var(INPUT_GET, "Alter")) {
    if (filter_input(INPUT_GET, "Alter") == "Password") {
        try {
            $NewPassword = md5(filter_input(INPUT_GET, "Password"));
            $sql = "UPDATE benutzer SET Passwort = '" . $NewPassword . "' WHERE BenutzerId = " . $UserId . ";";
            $pdo->execute($sql);
            echo "altered";
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    } else if (filter_input(INPUT_GET, "Alter") == "UserName") {

        try {
            $NewUserName = filter_input(INPUT_GET, "NewUserName");
            $sql = "select count(*) as IsAssigned from Benutzer where BenutzerName = '" . $NewUserName . "';";
            $res = $pdo->query($sql);
            if ($res[0]["IsAssigned"] == 0) {
                $sql = "update Benutzer set BenutzerName = '" . $NewUserName . "' where BenutzerId = " . $UserId . ";";
                $res = $pdo->execute($sql);
                echo "true";
            } else {
                echo "already assigned";
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    } else if (filter_input(INPUT_GET, "Alter") === "Email") {
        try {
            $NewEmail = filter_input(INPUT_GET, "Email");
            $sql = "update Benutzer set EMail = '" . $NewEmail . "' where BenutzerId = " . $UserId . ";";
            $pdo->execute($sql);
            echo "true";
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    } else if (filter_input(INPUT_GET, "Alter") === "Description") {
        try {
            $NewDescription = filter_input(INPUT_GET, "Description");
            $sql = "update Benutzer set Beschreibung='" . $NewDescription . "' where BenutzerId = " . $UserId . ";";
            $pdo->execute($sql);
            echo "true";
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
}

if (filter_has_var(INPUT_GET, "Check")) {
    if (filter_input(INPUT_GET, "Check") == "Password") {
        $sql = "select Passwort from benutzer where BenutzerId = " . $UserId . ";";
        $res = $pdo->query($sql);
        $UserPassword = $res[0]["Passwort"];
        $MaybePassword = filter_input(INPUT_GET, "Password");
        if (strcmp(md5($MaybePassword), $UserPassword) == 0) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (filter_input(INPUT_GET, "Check") == "EmailAndUserId") {
        try {
            $OldEmail = filter_input(INPUT_GET, "Email");
            $sql = "select count(*) as IsAssignedToUser from Benutzer where EMail = '" . $OldEmail . "' and BenutzerId = " . $UserId . ";";
            $res = $pdo->query($sql);
            if ($res[0]["IsAssignedToUser"] == 1) {
                echo "true";
            } else {
                echo "false";
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    } else if (filter_input(INPUT_GET, "Check") == "Email") {
        try {
            $Email = filter_input(INPUT_GET, "Email");
            $sql = "select count(*) as IsAssigned from Benutzer where EMail = '" . $Email . "';";
            $res = $pdo->query($sql);
            if ($res[0]["IsAssigned"] == 0) {
                echo "true";
            } else {
                echo "false";
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
}

