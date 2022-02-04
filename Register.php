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
        <div class="container "><!-- comment -->
                
                
                
                <div class="row "> 
                
                <div class="col"> <div class="text-center" ><h1> Registrieren </h1></div> </div>
                
                </div>
                <div class="row ">
                   
                    <div class="col">
                    <form  class="text-center" action="register_page.php" method="post">

                        <label  for="username"><b>Benutzername</b> </label>
                        <br>
                        <input  type="text" name="username" required>
                        <br>
                        <label for="email"> <b>E-Mail</b> </label>
                        <br>
                        <input type="email" name="email" required>
                        <br>
                        
                        <label  for="psw"><b>Passwort</b></label>
                        <br>
                        <input  type="password" id="psw" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        <br>
                        <label  for="pswconf"><b>Passwort bestätigen</b></label>
                        <br>
                        <input  type="password" name="pswconf" id="pswconf" title="Password must match" required>
                        <br>
                        <br>
                        <button  type="submit" value="submit">Registrieren</button>
                        <br>
                    </form>
                        
                  
                        
                       
                    </div>
                    
                </div>
                
               
        </div>
        
        <div id="message" class="row" >
            <h3>Password must contain the following:</h3>
            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
            <p id="number" class="invalid">A <b>number</b></p>
            <p id="length" class="invalid">Minimum <b>8 characters</b></p>
            <p id="password_conf" class="invalid">Is <b> identical</b> </p>
        </div>
        
        
        <?php
        /*
        if($_SESSION["RegisterEmailAlreadyTaken"])
        {
            echo"<div id='registerResult' class='row'>";
            echo"<div class='text-center' ><h1> Email bereits vergeben </h1></div>";
            echo"</div>";
            echo"<br>";
        }
        if($_SESSION["RegisterUsernameAlreadyTaken"])
        {
            echo"<div id='registerResult' class='row'>";
            echo"<div class='text-center' ><h1> Benutzername bereits vergeben </h1></div>";
            echo"</div>";
            echo"<br>";
        }
        */ 
         
        ?>
            
            
      
        
        
        
       
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="BootstrapSource/bootstrap-5.1.3-dist/js/bootstrap.min.js"  crossorigin="anonymous"></script>
        <script>src="JS_Source\registerFunctions.js"</script>
        
    </body>
</html>
