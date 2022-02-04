<!-- 
/* TODO: 
 *       Input Daten über filter funktionen auslesen
 *       Überprüfen ob Benutzername schon vergeben ist
 *       - nach eingegebenen Benutzernamen suchen
 *       - wenn: Benutzernamen bereits vorhanden ist
 *       - dann: 
 *               - benutzer informieren
 *               - registrierungs seite neu laden
 *       - ansonsten: 
 *               - benutzer und passwort in DB speichern
 *               - Login Seite laden
 *       
 */
-->




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
         
         require_once 'registerParameterClass.php';
     
         $registerParam=new registerParameterClass();
         if(($registerParam->checkEmail()==true) && ($registerParam->checkUsername()==true))
         {
             $registerParam->insertNewUser();
             //Redirect to Login Page
             header("Location: http://localhost:8080/PHP_HTML_WebData/FullStackProjekt_Social_Media/Login.html");
             
         }
         else
         {
            
             echo"<b> registration failed redirecting to Register.php in 5 Seconds</b>";
             time_sleep_until(time()+5);
             header("Location: http://localhost:8080/PHP_HTML_WebData/FullStackProjekt_Social_Media/Register.php");
         }
        ?>
    </body>
</html>
