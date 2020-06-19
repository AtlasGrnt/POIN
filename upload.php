<?php 
session_start();
ini_set('display_errors', 'off');
include "function.php";

?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- //SECTION Formulaire d'upload-->
<form id="upload_img" method="post" action="" class="formulaire" enctype="multipart/form-data">
    <!--<h2 class="titre_formulaire">Formulaire d'upload </h2>
    <div class="search_input" style="width: 50%;">
        <label for="image">Le Titre de l'Image</label>
        <input type="text" name="nom_img"  class="titre_img">
    </div>
    <div class="search_input" style="width: 100%;">
        <label for="desc_img">Entrez votre Description</label>
        <textarea class="textarea" name="desc_img" ></textarea>
    </div>
    
    <div class="affichage_upload">
    
    </div>				
-->
<?php
    

    $connect = connexion();

    $sql = "SELECT id, name FROM categorie_produit";

    $rep = $connect->prepare($sql);
    $rep->execute();
    while($ligne = $rep->fetch())
    {
        $datas[$cpt] = array (
            "id" => $ligne['id'],
            "name" => $ligne['name']
        );
        $cpt++;
    }

    $html = '<option value="0">--Please choose an option--</option>';

    for($i = 0; $i < sizeof($datas); $i++)
    {
        $html .= '<option value="'.$datas[$i]['id'].'">'.$datas[$i]['name'].'</option>';
    }
?>
    
	<div class="inscription"> 
		<div class="form-style-6">
		<form class="add">
        <label for="name">Name</label><br>
        <input type="text" id="name" placeholder="name"><br>

        <label for="categorie">Categorie</label><br>
        <select id="categorie"><?php echo $html ?></select><br>

        <label for="description">Description</label><br>
        <textarea id="description" rows="4" cols="50"></textarea><br>

        <label for="motif">Motif</label><br>
        <textarea id="motif" row="2" cols="20"></textarea><br>

        <label for="quantite">Quantité</label><br>
        <input type="number" id="quantite" min="1"><br>

        <label for="inputfile_image" class="label">Choissiez votre Image :</label><br>  
        <input id="inputfile_image" type="file" class="btn_upload" name="image" accept=" .jpg ,.jpeg ,.gif "><br> 

        <input type="submit" id="upload" value="Envoyer"/>
    </form>
		</div>
	</div>
    
    <br><br>
</form>	
<!-- //!SECTION -->
<script>

$('#upload').on('click', function(e){
	//on empeche le comportement normal du formulaire
	e.preventDefault(); 

	/* à partir du formulaire en html, on initialise en javascript le formulaire à envoyer */
	var form = $('#upload_img')[0];
	var data = new FormData(form); 
	var name = $("#name").val();
            var categorie = $("#categorie").val();
            var description = $("#description").val();
            var motif = $("#motif").val();
            var quantite = $("#quantite").val();			
	/* on rajoute des infos au formulaire a transmettre  */              
	data.append('action','upload');
	data.append('name',name);
	data.append('description',description);
	console.log(data);
	/* on envoie le formulaire au serveur grâce à la méthode ajax */
	$.ajax({
		url: "asyncform.php",
		dataType: 'json',
		type: 'POST',
		enctype:'multipart/form-data',
		cache:false,
		contentType:false,
		processData:false,
		data: data,			
		success: function(retour){
			$('.progressSave').hide();
			if(retour.erreur == ''){


			}else{

			}
		}
	});
});
</script>