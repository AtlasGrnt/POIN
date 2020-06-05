<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min"></script>-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="function.js"></script>
    <title>Ajouter Produit</title>
    
</head>

<?php
    require "function.php";

    $connect = connexion();

    $sql = "SELECT id, name FROM categorie_produit"

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

<body>
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

        <input type="button" value="Valider" id="submit">
    </form>

    <div id="ajout"></div>
    
</body>

<script>
    $(document).ready(function(){


        $('#submit').click(function(){

            var name = $("#name").val();
            var categorie = $("#categorie").val();
            var description = $("#description").val();
            var motif = $("#motif").val();
            var quantite = $("#quantite").val();

            $.ajax({
                url: 'asyncform.php', 
                type: 'POST',
                data: {
                    name: name, 
                    categorie: categorie,
                    description: description,
                    motif: motif,
                    quantite: quantite
                },
                success: function(data){
                    if(data == "success")
                    {
                        $("#ajout").replaceWith("<p>Votre ajout a été effectué avec succès !</p>");
                    }else{
                        $("#ajout").replaceWith("<p>Erreur lors de l'ajout</p>");
                    }  
                }
            });
        });
    })
</script>
</html>