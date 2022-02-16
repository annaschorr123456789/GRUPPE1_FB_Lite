<!DOCTYPE html>

<?php
session_start();
?>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Pfotenglück | Log In</title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <link rel="stylesheet" href="CSSFiles/RegisterLoginStyle.css?x=1"/>

    </head>
    <body>

        <img src='Img/Logo_orange.svg'>
        <h2 class='navbar-brand' style="font-family: 'Brush Script MT', cursive"> Pfotenglück</h2>
        <div class="container" id="container">
            <div class="form-container sign-in-container">
                <form  class="text-center" action="LoginPage.php" method="post">
                    <h1>Hups, da ist wohl was schief gelaufen...</h1><br><br>
                    <a href="Login.html">
                        <button type="button">Zurück zum Login</button>
                    </a>
            </div>
            <div class="overlay-panel overlay-right" style="text-align: center !important;">
                <h1>Woran hat's gelegen?</h1>
                <p>
                    <?php
                    if ($_SESSION["UserNameEmpty"]) {
                        echo "Du hast keinen Usernamen eingegeben.";
                        echo "<br>";
                    }
                    if ($_SESSION["InvalidInput"]) {
                        echo "Für Usernamen sind nur Buchstaben und Leerzeichen erlaubt.";
                        echo "<br>";
                    }
                    if ($_SESSION["UserNameNotFound"]) {
                        echo "Der Username, den du eingegeben hast, ist nicht vergeben.";
                        echo "<br>";
                    } else {
                        echo "Wir konnten deinen Username zwar finden aber dein Passwort war falsch.";
                        echo "<br>";
                    }
                    ?>
                </p>
            </div>
        </div>

        <script src = "https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity = "sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin = "anonymous"></script>
        <script src="BootstrapSource/bootstrap-5.1.3-dist/js/bootstrap.min.js"  crossorigin="anonymous"></script>
    </body>
</html>
