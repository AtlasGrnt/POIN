
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet TechnOld</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="script/slider.js"></script>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Projet TechnOld</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Produits.php">Produits</a>
                    </li>
                </ul>

                <a href="#"><img id="logoPannier" src="images/pannier.png" alt=""></a>
                <a href="login.php" class="btn btn-success my-2 my-sm-0" role="button">Connexion/Inscription</a>
            </div>
        </nav>

    </header>
    <div class="fond_color"></div>
    <div class="image-accueil">
        <img src="images/imgAccueil.png" class="imageAccueil" alt="">
        <div class="bouton">
        <a href="login.php" class="btn btn-info my-2 my-sm-0" role="button">Connexion/Inscription</a>
        </div>
    </div>

    <div class="paragrapheA">
        <p><B>Bienvenue sur notre site "Projet TechnOld"</B><br> Ce projet à pour objectif d'apporter un soutient matériel aux personnes âgées en EHPAD pour que ceux-ci puissent
            garder contact avec leur famille, se distraire, garder un pied dans le monde informatique d'aujourd'hui grâce à votre aide.
        </p>
    </div>
    <footer>
    </footer>
</body>

</html>

<?php 

include "function.php";




?>

