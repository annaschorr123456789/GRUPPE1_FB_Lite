<!DOCTYPE html>

<html lang="de">
    <head>
        <meta charset="UTF-8">
        <title>Dein Feed</title>
        <link rel="stylesheet" href="CSSFiles/FeedStyle.css?x=1" media="all">
        <link rel="stylesheet" href="CSSFiles/HeaderStyle.css" media="all">
        <link rel="stylesheet" href="CSSFiles/FooterStyle.css" media="all">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="Font-Awesome-master/css/fontawesome.min.css">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="JavaScriptFiles/FeedFunctions.js?x=1" type="text/javascript"></script>

        <style>    
            body {
                background-image: url('Img/paws2.png');
            }
        </style>
    </head>

    <body onload="GetUserData()" onscroll="AddNewLinesIfNecessary()">
        <!-- MENU BAR -->
        <div class='m-4' id='NavBar'>
            <nav class='navbar navbar-expand-sm navbar-light'>
                <div class='container-fluid'>
                    <img src='Img/Logo_orange.svg'>
                    <a href='#' class='navbar-brand' style="font-family: 'Brush Script MT', cursive"> Pfotenglück</a>
                    <div id='navbarCollapse' class='collapse navbar-collapse' style='font-size:20'>
                        <ul class='nav navbar-nav'>
                            <li class='nav-item dropdown'>
                                <a href='#' class='nav-link dropdown-toggle' data-bs-toggle='dropdown'><i class='fas fa-user'></i></a>
                                <div class='dropdown-menu'>
                                    <a href='Profile.html' class='dropdown-item'>Profil</a>
                                    <a href='Favourites.html' class='dropdown-item'>Favoriten</a>
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
                                <a href='#' class='nav-link active' style="color: #034c73 !important" >Feed</a>
                            </li>
                            <li class='nav-item'>
                                <a href='ForumMainPage.html' class='nav-link'>Forum</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <!-- FEED -->

        <div class="HeaderBig">DEIN FEED</div><br>
        <div class="HeaderMed">HIER FINDEST DU DIE NEUESTEN BEITRÄGE</div> <br><br>

        <div id="Feed">
    </body>
</html>
