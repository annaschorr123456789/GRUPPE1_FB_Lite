
<!DOCTYPE html>

<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pfotenglück | Registrieren</title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="CSSFiles/RegisterLoginStyle.css?x=1"/>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="JavaScriptFiles/RegisterFunctions.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="BootstrapSource/bootstrap-5.0.2-dist/js/bootstrap.min.js"  crossorigin="anonymous"></script>
        <script>src = "JavaScriptFiles/RegisterFunctions.js"</script>
        <script>src = "JavaScriptFiles/ForumFunctions.js"</script>

        <style>    
            body 
            {
                background-image: url('Img/paws2.png');
            }
        </style>
    </head>
    <body>
        <img src='Img/Logo_orange.svg'>
        <h2 class='navbar-brand' style="font-family: 'Brush Script MT', cursive"> Pfotenglück</h2>
        <div class="container" id="container">
            <div class="form-container sign-in-container">
                <form  class="text-center" action="RegisterPage.php" method="post">
                    <h1>Registrieren</h1><br>
                    <input  type="text" name="username" required placeholder="Benutzername">
                    <input type="email" name="email" required placeholder="E-Mail">
                    <input  type="password" id="psw" name="psw" placeholder="Passwort" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    <input  type="password" name="pswconf" id="pswconf" title="Password must match" placeholder="Passwort bestätigen" required><br>

                    <div class="row">
                        <div class="popup" onmouseover="myFunction()">
                            <button class="Button" type="submit" value="submit">Registrieren</button>
                            <span class="popuptext" id="myPopup">Du musst dich nach einer erfolgreichen Registrierung erst einmal einloggen.</span><br>
                        </div>
                    </div>
                    <script>
                        function myFunction() {
                            var popup = document.getElementById("myPopup");
                            popup.classList.toggle("show");
                        }
                    </script>


                </form>
            </div>
            <div class="overlay-panel overlay-right">
                <div id="message" class="row" style="text-align: left">
                    <h3>Passwörter müssen die folgenden Kriterien erfüllen:<br><br></h3>
                    <div id="letter" class="invalid">Mindestens ein <b>Kleinbuchstabe</b></div>
                    <div id="capital" class="invalid">Mindestens ein <b>Großbuchstabe</b></div>
                    <div id="number" class="invalid">Mindestens eine <b>Zahl</b></div>
                    <div id="length" class="invalid">Mindestens <b>8 Zeichen</b> lang</div>
                    <div id="password_conf" class="invalid"><b>Passwörter müssen identisch sein</b></div>
                </div>
            </div>
        </div>
    </body>
</html>
