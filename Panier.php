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


<?php 

$connect = connexion();
$requestsql ="SELECT * FROM paniers where id_user = '$_SESSION['id_user']'";
echo $requestsql;

?> 

</html>