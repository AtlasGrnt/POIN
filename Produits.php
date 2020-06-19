<!DOCTYPE html>

<html lang="fr">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet TechnOld</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Projet TechnOld</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Produits.php">Produits</a><span class="sr-only">(current)</span></a>
                    </li>
                </ul>
<<<<<<< HEAD
                <a href="#"><img id="logoPannier" src="images/pannier.png" alt=""></a>
=======
>>>>>>> 2bf2bbb75a0713f09df509614da959a62a4a647f
                <a href="login.php" class="btn btn-success my-2 my-sm-0" role="button">Connexion/Inscription</a>
            </div>
        </nav>

    </header>
<div class="fond_color"></div>
<div>
    <div class="titre_produit">
    <h2>Les Produits à votre disposition :</h2>   
    </div>
    <div class="selectproduct"> 
        <label for="products-select">Type de produit :</label>
        <select name="Products" id="products-select">
            <option value="">Tout les produits</option>
            <option value="2">Clavier</option>
            <option value="1">Ecrans</option>
            <option value="3">Souris filaire </option>
            <option value="4">Souris sans fil</option>
            <option value="5">Clavier sans fil</option>
            <option value="6">Tours</option>
            <option value="7">Webcam</option>
            <option value="8">Casques</option>
            <option value="9">Micros</option>
            <option value="11">Disques durs externes</option>
            <option value="12">Cables</option>
            <option value="13">Pc Portable</option>
            <option value="14">Enceintes</option>
            <option value="15">Retro-Projecteur</option>
            <option value="16">Téléphones Fixes</option>
            <option value="17">Téléphones portables</option>
            <option value="18">Consoles</option>
            <option value="10">Autres</option>
        </select>
    </div>
</div>  

<script> 
    $(document).ready(function(){
        $("#products-select").on('change',function(event){
            var product = $("#products-select").val();
            $.ajax({
                url: 'asyncform.php', 
                method : 'POST',
                data : { 
                    TypeProduct :product
                },
                success : function(data){
                    if(data != ' false'){
                        $('#Produits').html(data);
                    }
                }
            }); 
        });
    });
</script> 



<div id="Produits">   
    <?php 
        include 'function.php';
        echo printProducts();
    ?> 
</div>
 
<script>
    $(document).ready(function(){
        $("buttonCommander").on('click',function(event){

        });
    });
</script>



</body>
</html>

