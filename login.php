<?php 
session_start();
ini_set('display_errors','off');
$_SESSION['username'];

?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<html lang="fr">

<body>
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
    <?php 
		// check infos de connexion avec la BDD 
        if ($_SESSION['username'] != NULL ){
            header('Location: index.php');
            exit();
        }
    ?>
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
				//window.location.replace("index.php");
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
					//window.location.replace("index.php");
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



<style type="text/css">
body {
  background-image: url('');
  background-size:cover;
}
.form-style-6{
	font: 95% Arial, Helvetica, sans-serif;
	max-width: 400px;
	margin: 10px auto;
	padding: 16px;
	background: #F7F7F7;
}
.form-style-6 h1{
	background: #43D1AF;
	padding: 20px 0;
	font-size: 140%;
	font-weight: 300;
	text-align: center;
	color: #fff;
	margin: -16px -16px 16px -16px;
}
.form-style-6 input[type="text"],
.form-style-6 input[type="password"]
{
	-webkit-transition: all 0.30s ease-in-out;
	-moz-transition: all 0.30s ease-in-out;
	-ms-transition: all 0.30s ease-in-out;
	-o-transition: all 0.30s ease-in-out;
	outline: none;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	width: 100%;
	background: #fff;
	margin-bottom: 4%;
	border: 1px solid #ccc;
	padding: 3%;
	color: #555;
	font: 95% Arial, Helvetica, sans-serif;
}
.form-style-6 input[type="text"]:focus,
.form-style-6 input[type="password"]:focus
{
	box-shadow: 0 0 5px #43D1AF;
	padding: 3%;
	border: 1px solid #43D1AF;
}

.form-style-6 input[type="submit"],
.form-style-6 input[type="button"]{
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	width: 100%;
	padding: 3%;
	background: #43D1AF;
	border-bottom: 2px solid #30C29E;
	border-top-style: none;
	border-right-style: none;
	border-left-style: none;	
	color: #fff;
}
.form-style-6 input[type="submit"]:hover,
.form-style-6 input[type="button"]:hover{
	background: #2EBC99;
}
</style>

