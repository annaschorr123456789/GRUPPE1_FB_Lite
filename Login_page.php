<!--/* 
 * TODO:
 *      -inputfelder über filter funktion auslesen
 *      -überprüfen ob benutzername in der datenbank existiert
 *      wenn: benutzer existiert
 *      dann: passwort vergleichen
 *                  wenn: passwort richtig
 *                  dann: benutzer auf hauptseite weiterleiten
 *                  ansonsten: falsches passwort mitteilung
 *      ansonsten: benutzer existiert nicht mitteilung
 * 
 */-->

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
         require_once 'loginParameterClass.php';
         $loginParam=new loginParameterClass();
         if($loginParam->checkLogin()==true)
         {
             //TODO: Session mit benutzernamen öffnen
             
             $_SESSION["loggedInAs"]=$loginParam->__getUsername();
             //Redirect to facebooklite mainpage
             header("Location: http://localhost:8080/PHP_HTML_WebData/FullStackProjekt_Social_Media/Test.php");
         }
         else
         {
             echo"login failed";
         }
        ?>
    </body>
</html>

