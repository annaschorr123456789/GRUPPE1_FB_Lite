<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register_php</title>
    </head>
    <body>
        <?php
        require_once 'PHPFiles/RegisterParameterClass.php';

        $registerParam = new registerParameterClass();
        $emailCheck = $registerParam->checkEmail();
        $usernameCheck = $registerParam->checkUsername();

        if (($emailCheck == true) && ($usernameCheck == true)) {
            $registerParam->insertNewUser();
            //Redirect to Login Page
            $_SESSION["loggedInAs"] = $registerParam->getUsername();
            header("Location: Login.html");
        } else {
            $_SESSION["checkEmail"] = $emailCheck;
            $_SESSION["checkUsername"] = $usernameCheck;
            header("Location: RegisterFailedRedirect.php");
        }
        ?>
    </body>
</html>
