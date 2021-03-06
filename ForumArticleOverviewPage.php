<!DOCTYPE html>
<html lang="de-DE" class="js flexbox flexboxlegacy canvas canvastext webgl no-touch postmessage rgba backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransitions fontface"><!--<![endif]-->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta name="description" content="Add description here">
        <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->

        <title></title>

        <link rel="stylesheet" id="ownstyles-css" href="CSSFiles/HeaderStyle.css" media="all">
        <link rel="stylesheet" id="ownstyles-css" href="CSSFiles/FooterStyle.css" media="all">
        <link rel="stylesheet"  id="ownstyles-css" href="CSSFiles/ForumStyle.css"  media="all">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="../Font-Awesome-5.15.4/css/fontawesome.min.css">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="JavaScriptFiles/ForumArticleOverviewFunction.js"></script>

        <style>    
            body {
                background-image: url('Img/paws2.png');
            }
        </style>

        <script async src='/cdn-cgi/bm/cv/669835187/api.js'></script>
    </head>
    <body onload="GetUserData(); LoadQuestions(<?php
    if (filter_has_var(INPUT_GET, "TopicId")) {
        echo filter_input(INPUT_GET, "TopicId");
    } else {
        echo "1";
    }
    ?>)">
        <!-- MENU BAR -->
        <div class='m-4' id='NavBar'>
            <nav class='navbar navbar-expand-sm navbar-light'>
                <div class='container-fluid'>
                    <img src='Img/Logo_orange.svg'>
                    <a href='Feed.php' class='navbar-brand' style="font-family: 'Brush Script MT', cursive"> Pfotengl??ck</a>
                    <div id='navbarCollapse' class='collapse navbar-collapse' style='font-size:20'>
                        <ul class='nav navbar-nav'>
                            <li class='nav-item dropdown'>
                                <a href='#' class='nav-link dropdown-toggle' data-bs-toggle='dropdown'><i class='fas fa-user'></i></a>
                                <div class='dropdown-menu'>
                                    <a href='Profile.html' class='dropdown-item'>Profil</a>
                                    <div class='dropdown-divider'></div>
                                    <a href='LogOut.php'class='dropdown-item'>Ausloggen</a>
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
                                <a href='ForumMainPage.html' style="color: #034c73 !important" class='nav-link active'>Forum</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <!-- FORUM -->
        <br>
        <div> <p class="HeaderMed">ALLE BEITR??GE ZUM THEMA </p> <br></div><br>
        <div class="container-fluid">
            <div id="TopicIndex">
                <div style="margin-left: 20px">
                    <div class="row">
                        <div class="col-1">
                            <i id="SortIcon" class="fas fa-filter fa-2x"></i>
                        </div>
                        <div class="col">
                            <a href='#' class='nav-link data-toggle' data-bs-toggle='dropdown'><div onclick="Sort()" class="SortBar">Sortieren & Filtern</div></a>
                            <div class='dropdown-menu'>
                                <a href='#' class='dropdown-item'>Neueste zuerst</a> 
                                <a href='#' class='dropdown-item'>??lteste zuerst</a>
                                <a href='#' class='dropdown-item'>Viele Antworten zuerst</a>
                                <a href='#' class='dropdown-item'>Wenige Antworten zuerst</a>
                                <div class='dropdown-divider'></div>
                                <div class='dropdown-item'><input type="checkbox" id="OldestFirst" name="subscribe" value="newsletter"> Fragen ohne Antworten </div>
                                <div class='dropdown-item'><input type="checkbox" id="OldestFirst" name="subscribe" value="newsletter"> Fragen mit Antworten </div>
                                <div class='dropdown-item'><input type="checkbox" id="OldestFirst" name="subscribe" value="newsletter"> Fragen ohne Bilder </div>
                                <div class='dropdown-item'><input type="checkbox" id="OldestFirst" name="subscribe" value="newsletter"> Fragen mit Bildern </div>
                                <div class='dropdown-item'><input type="checkbox" id="OldestFirst" name="subscribe" value="newsletter"> Status geschlossen </div>
                                <div class='dropdown-item'><input type="checkbox" id="OldestFirst" name="subscribe" value="newsletter"> Status offen </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <a href="ForumNewQuestionPage.html"><i onclick="AddQuestion()" id="AddNewQuestion" class="fas fa-plus fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div> 
        </div>

        <div class="container-fluid">
            <div id="TopicIndex">
                <div class="ArticleListArea">
                    <div style="margin-left: 20px; margin-right:40px" id="QuestionContainer">
                        
                    </div>
                </div>
            </div> 
        </div> 

        <!-- FOOTER -->
        <div class='row'>
            <br>
            <div class='container'>
                <div class='d-flex flex-wrap fixed-bottom justify-content-between align-items-center border-top bg-light'>
                    <p class='col-md-4 mb-0 text-muted'>?? 2022 Pfotengl??ck GmbH</p>

                    <ul class='nav col-md-4 justify-content-end'>
                        <li class='nav-item'><a href='FooterKontakt.html' class='nav-link px-2 text-muted'>Kontakt</a></li>
                        <li class='nav-item'><a href='FooterFAQs.html' class='nav-link px-2 text-muted'>FAQs</a></li>
                        <li class='nav-item'><a href='FooterAbout.html' class='nav-link px-2 text-muted'>??ber uns</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <script type="text/javascript">(function () {
                window['__CF$cv$params'] = {r: '6ddd805ead5f5b62', m: 'XQSNeyd0.vXud4Ry4znGsDva_ZAKicH1lkPz7DLmCrQ-1644917258-0-AbGX4dOYEKYPEVAtuyGMFOka426lC0dDN5txAzrx9zx8jTuNlpWXO35knJYNaGtQKvkPhP5wsyEnsNno7/SfHXC6QQGYsmLRfiEQaZBJRoPBAWh+aOO39HE4feQl9pHW1JptkVju8zXpTIYH32uLAhJvLYOBq4Ma93lBxry3Ufl5N1JGB7hIUJYhlMTJWBDgVOBjdMx/AbryMq8me/plpqIOKr26UN7B4h9grbaccxZR', s: [0x3f169168e6, 0x4c690cf858], }
            })();</script></body>
</html>