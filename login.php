<?php 
session_start();
ini_set('display_errors','off');
$_SESSION['username'];

?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<html lang="fr">
<link rel="stylesheet" href="styles/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

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
                        <a class="nav-link" href="index.php">Accueil <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Produits.php">Produits</a>
                    </li>
				</ul>
				<a href="index.php" class="btn btn-info my-2 my-sm-0" role="button">Retour</a>
            </div>
        </nav>

	</header>
	<div class="fond_color"></div>
	<div class="connect"> 
		<div class="form-style-6">
			<h1>Bienvenue sur TechnOld</h1>
			<form id='formulaire1' action="" method="post">
				<input type="text" name="name" required autocomplete placeholder="Utilisateur" id="username1"></input><br> 
				<input type="password" name="pwd_connect1" id="pwd_connect1" required placeholder="Mots de passe"></input><br>
				<input type="submit" id="submit1" value="Envoyer le Formulaire" ></input>
			</form>
			<a id="add_user" >je n'ai pas de compte</a>        
		</div>
	</div>
	<div class="inscription"> 
		<div class="form-style-6">
			<h1>Bienvenue sur TechnOld</h1>
			<form id='formulaire2' action="" method="post">
				<input type="text" name="name" required placeholder="Utilisateur" id="username2"></input><br> 
				<input type="password" name="pwd_connect2" id="pwd_connect2" required placeholder="Mots de passe"></input><br>
				<input type="text" name="email" id="email" required placeholder="E-mail"></input><br>
                <input type="radio" id="type_user" name="type_user" class='type_user' checked value='U' required>
                <label for="type_user">Utilisateur</label>
                <input type="radio" id="type_compagny" name="type_user" class='type_user' value='E' required>
                <label for="type_user">Entreprise</label>     
                <br>
				<input type="submit" id="submit2" value="Inscription" ></input>
			</form>
			<a id="connect" >Retour Arriere</a>
		</div>
	</div>
		<p id="resultat"></p>
 
</body>

<script>	
$(".connect").show();
$(".inscription").hide();
$(document).ready(function(){
            
    $("#submit1").on("click",function(event){
    event.preventDefault();
    var username = $("#username1").val();  
    var password = $("#pwd_connect1").val();      
    $.ajax({
        url: "asyncform.php",
        method: "POST",
        data: {
            password: password,
            username: username
        },
        success : function(data){
            if(data == 'Success'){
				$("#resultat").html("<p>Vous avez été connecté avec succès !</p>");
				window.location.replace("index.php");
            }else{
                $("#resultat").html("<p>Vos identifiants sont faux !</p>");
            }           
        }
    });                   
	});
		 
    $("#submit2").on("click",function(event){
    event.preventDefault();
    var username = $("#username2").val();  
	var password = $("#pwd_connect2").val();
	var email = $("#email").val();   
    var type_user = $("input[name='type_user']:checked").val();
    $.ajax({
        url: "asyncform.php",
        method: "POST",
        data: {
            password: password,
			username: username,
			email: email,
			type_user: type_user
        },
        success : function(data){
            if(data == 'Success'){
				$("#resultat").html("<p>Inscrit avec succès !</p>");
				window.location.replace("index.php");
            }else{
                $("#resultat").html("<p>Erreur</p>");
            }           
        }
    });                   
	});


    $("#add_user").on("click",function(){
		$(".connect").hide();
		$(".inscription").show()
	});
	$("#connect").on("click",function(){
		$(".connect").show();
		$(".inscription").hide();
    });
}); 
</script>