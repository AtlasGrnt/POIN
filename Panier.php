<?php 
session_start();
?>

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
                    <li class="nav-item">
                        <a class="nav-link" href="Panier.php">Panier</a>
                    </li>
                </ul>
                <form class="form-inline my-lg-1 mr-auto">
                 <div class="input-group mb-3">
                     <div class="input-group-prepend">
                          <span class="input-group-text">&#128270;</span>
                     </div>
                      <input type="text" class="form-control">
                    </div>
                </form>
                <a href="login.php" class="btn btn-success my-2 my-sm-0" role="button">Connexion/Inscription</a>
            </div>
        </nav>

    </header>

    <footer>
    </footer>
</body>
    

<div id="Panier">
    <h2> Récapitulatif de votre commande : </h2>
    <article>
       
        <?php 

            include 'function.php';
            echo printPanier();

        ?>


    </article>


    <form >
        <fieldset>

            <legend> Vos coordonnées de livraison : </legend>
            <input type="radio" name="civility" id="monsieur" value="Monsieur">
            <label for="monsieur">Monsieur</label><br>
            <input type="radio" name="civility" id="madame" value="Madame" checked>
            <label for="madame">Madame</label><br>
            <input type="text" id="Lastname" placeholder="Nom"><br>
            <input type="text" id="Firstname" placeholder="Prénom"><br>
            <input type="text" id="adresse" placeholder="Adresse"><br>
            <input type="text" id="cpltAdresse" placeholder= "Complément d'adresse"><br>
            <input type="text" id="City" placeholder="Ville"><br>
            <input type="number" step="1" id="age" placeholder="âge"><br>
            <div id="erreurPassword" style="color: red"></div>
            <input type="button" id="ValiderCommande" value="Valider la commande">

        </fieldset>
    </form>
</div>

</html>