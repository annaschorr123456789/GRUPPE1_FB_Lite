
<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login_php</title>
    </head>
    <body>
        <?php
        require_once 'PHPFiles/LoginParameterClass.php';
        $loginParam = new loginParameterClass();
        if ($loginParam->checkLogin() == true) {
            $_SESSION["loggedInAs"] = $loginParam->__getUsername();
            header("Location: Feed.php"); //Redirect 
        } else {
            header("Location: LoginFailedRedirect.php");
        }
        ?>
    </body>
</html>

