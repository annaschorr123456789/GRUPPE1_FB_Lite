<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <link rel="stylesheet" id="ownstyles-css" href="CSSFiles/HeaderStyle.css" media="all">
        <link rel="stylesheet" id="ownstyles-css" href="CSSFiles/FooterStyle.css" media="all">
        <link rel="stylesheet" id="ownstyles-css" href="CSSFiles/ForumStyle.css?x=1" media="all">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="../Font-Awesome/css/fontawesome.min.css">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="JavaScriptFiles/ForumArticlePageFunctions.js?x=1" type="text/javascript"></script>
        <style>    
            body {
                background-image: url('Img/paws2.png');
            }
        </style>
    </head>
    <body onload="GetUserData()">

        <!-- MENU BAR -->
        <div class='m-4' id='NavBar'>
            <nav class='navbar navbar-expand-sm navbar-light'>
                <div class='container-fluid'>
                    <img src='Img/Logo_orange.svg'>
                    <a href='Feed.php' class='navbar-brand' style="font-family: 'Brush Script MT', cursive"> Pfotenglück</a>
                    <div id='navbarCollapse' class='collapse navbar-collapse' style='font-size:20'>
                        <ul class='nav navbar-nav'>
                            <li class='nav-item dropdown'>
                                <a href='#' class='nav-link dropdown-toggle' data-bs-toggle='dropdown'><i class='fas fa-user'></i></a>
                                <div class='dropdown-menu'>
                                    <a href='Profile.html' class='dropdown-item'>Profil</a>
                                    <div class='dropdown-divider'></div>
                                    <a href='LogOut.php' class='dropdown-item'>Ausloggen</a>
                                </div>
                            </li>
                            <li class='nav-item'>
                                <div class='input-group rounded'>
                                    <input type='search' class='form-control rounded' placeholder='Suche...' aria-label='Search' aria-describedby='search-addon' />
                                    <span class='input-group-text border-0' id='search-addon'>
                                        <i class='fas fa-search'></i>
                                    </span>
                                </div>
                            </li>
                        </ul>
                        <ul class='nav navbar-nav ms-auto'>
                            <li class='nav-item'>
                                <a href='Feed.php' class='nav-link' >Feed</a>
                            </li>
                            <li class='nav-item'>
                                <a href='ForumMainPage.html' class='nav-link active' style="color: #034c73 !important">Forum</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <!-- PAGE CONTENT -->
        <?php
        require_once 'PHPFiles/FaceBookLiteConnection.php';
        $pdo = new FaceBookLiteConnection();
        if (!filter_has_var(INPUT_GET, "QuestionId")) {
            echo "<h1>Die Frage wurde nicht gefunden<h1>";
            return;
        }

        if (!filter_var(filter_input(INPUT_GET, "QuestionId"), FILTER_VALIDATE_INT)) {
            echo "<h1>Netter versuch, aber die Id der Frage muss ein Integer sein</h1>";
            return;
        }
        echo "<script>onscroll='AddNewAnswersIfNecessary(" . filter_input(INPUT_GET, "QuestionId") . ")'</script>";
        $sql = "select t.ThemenName as Topic, b.BenutzerName as CreatorName, Frage as Question from Frage f join thema t on f.ThemenId = t.ThemenId join benutzer b on f.ErstellerId = b.BenutzerId where f.FragenId = " . filter_input(INPUT_GET, "QuestionId") . ";";
        $res = $pdo->query($sql);
        if ($res == null) {
            echo "<h1>Die Frage wurde nicht gefunden<h1>";
            return;
        }
        echo "<h1> " . $res[0]["Topic"] . "</h1>";
        echo "<h4>Frage von " . $res[0]["CreatorName"] . "</h4>";
        echo "<h5>" . $res[0]["Question"] . "</h5>";
        echo "<div class='answerContainer'></div>";
        echo "<script>AddNewAnswersIfNecessary(" . filter_input(INPUT_GET, "QuestionId") . ")</script>";
        ?>
        <br>
        <textarea placeholder="Schreibe hier deine Antwort" id="UserComment"></textarea>
        <button onclick="AddAnswerToQuestion(<?php echo filter_input(INPUT_GET, "QuestionId") ?>)">Antworten</button>

        <!-- FOOTER -->
        <div class='row'>
            <br>
            <div class='container'>
                <div class='d-flex flex-wrap fixed-bottom justify-content-between align-items-center border-top bg-light'>
                    <p class='col-md-4 mb-0 text-muted'>© 2022 Pfotenglück GmbH</p>

                    <ul class='nav col-md-4 justify-content-end'>
                        <li class='nav-item'><a href='FooterKontakt.html' class='nav-link px-2 text-muted'>Kontakt</a></li>
                        <li class='nav-item'><a href='FooterFAQs.html' class='nav-link px-2 text-muted'>FAQs</a></li>
                        <li class='nav-item'><a href='FooterAbout.html' class='nav-link px-2 text-muted'>Über uns</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>
