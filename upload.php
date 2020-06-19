<?php 

include "function.php";
var_dump(__DIR__) ;
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
    <div class="upload-btn-wrapper">
        
        <input id="inputfile_image" type="file" class="btn_upload" name="image" accept=" .jpg ,.jpeg ,.gif ">
        <label for="inputfile_image" class="label">Choissiez votre Image</label>
        <img id='output'>
    </div>
    

    
    <input type="submit" value="Envoyer"/><br><br>
</form>	
<!-- //!SECTION -->
<script>

$('#upload_img').on('submit', function(e){
	//on empeche le comportement normal du formulaire
	e.preventDefault(); 

	/* à partir du formulaire en html, on initialise en javascript le formulaire à envoyer */
	var form = $('#upload_img')[0];
	var data = new FormData(form); 			
	/* on rajoute des infos au formulaire a transmettre  */              
	data.append('action','upload_img');
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