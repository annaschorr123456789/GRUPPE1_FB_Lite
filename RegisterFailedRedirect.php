<!DOCTYPE html>

<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>RegisterFailedRedirect</title>
    </head>
    <body>
        <font size="+3">
        <b>registration failed <br>
            <?php
            if (!$_SESSION["checkEmail"]) {
                echo "E-Mail is already Taken";
                echo "<br>";
            }

            if (!$_SESSION["checkUsername"]) {
                echo "Username is already Taken";
                echo "<br>";
            }
            unset($_SESSION["checkUsername"]);
            unset($_SESSION["checkEmail"]);
            ?>

            redirecting to Register.php in 5 Seconds
        </b>
        </font>
        <script>
            function redirect()
            {
                document.location.href = "Register.php";
            }

            setTimeout(redirect, 5000);

        </script>

    </body>
</html>
