<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
?>
<html>
    <head>
        <title>Register</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="BootstrapSource\bootstrap-5.1.3-dist\css\bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
        <link href="CSS_Source\registerStyle.css" rel="stylesheet">
        <script type="text/javascript" src="JS_Source\registerFunctions.js"> </script>
    </head>
    <body >
        Test erfolgreich
        <?php
            echo "you are logged in as: ". $_SESSION["loggedInAs"];
        ?>
     
        
    </body>
</html>
