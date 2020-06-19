<?php
ini_set('display_errors', 'off');
session_start();

require "function.php";

if( isset($_POST['username']) && isset($_POST['password'])){
    $connect = connexion();
    $username = $_POST['username'];

    if(isset($_POST['email']) && isset($_POST['type_user'])){
        if ($_POST['type_user'] == 'E'){
          send_mail("demande Entreprise", "L entreprise ".$_POST['username']." vient de créer un compte entreprise");
        }
        $email = $_POST['email'];
        $password = crypt($_POST['password']);
        $type = $_POST['type_user'];
        $requete2 = <<<EOD
        INSERT INTO `utilisateurs` (`id`, `username`, `type_user`, `password`, `email`) VALUES (NULL, '$username', '$type', '$password', '$email');
        EOD;
        $stmt = $connect -> prepare($requete2);
        $stmt -> execute();
        $_SESSION['user']=$_POST['username'];
        $_SESSION['role']='Utilisateur';
        echo 'Success';
    }else{

        $requete = <<<EOD
        SELECT * FROM utilisateurs WHERE  username = '$username';
        EOD;

        try{
            $stmt = $connect -> prepare($requete);
            $stmt -> execute();
            $exit = $stmt -> fetch();
            $password_crypt = $exit['password'];
            $explode = explode("$",$password_crypt);
            $salt = "$".$explode[1]."$".$explode[2]."$";
            $password_user = htmlentities($_POST['password']);
            $try_password =  crypt($password_user,$salt);
            if ($try_password == $password_crypt){
                $_SESSION['user']=$exit['username'];
                $_SESSION['role']=$exit['role'];
                $_SESSION['id_user']=$exit['id'];
                $_SESSION['email']=$exit['email'];
                echo 'Success';
            }else{
                echo 'error';
            }
        }catch (PDOException $error){
            echo "Erreur : ",$error->getMessage();
        }
    }
}

if(isset($_POST['TypeProduct'])){
    $Categorie = intval($_POST['TypeProduct']);

    if($_POST['TypeProduct'] == ""){
        $return = '';
        $connect = connexion();

        $requestsql ="SELECT * FROM produits";
        foreach($connect->query($requestsql) as $index) {
            $return.="
        <article>
            <h3>".$index['name']." </h3>
            <p>".$index['description']."</p>
            <p><img src='images/".$index['images']."'id='image'></p>
            <input class='button' type='button' value='commander'><br>
        </article><br>;
        ";
        }


    }
    else {

        $return = '';
        $connect = connexion();
        $requestsql ="SELECT * FROM produits where categorie = $Categorie";
        foreach($connect->query($requestsql) as $index) {
            $return.="
                <article>
                    <h3>".$index['name']."</h3>
                    <p>".$index['description']."</p>
                    <p><img src='images/".$index['images']."' id='image'></p>
                    <input class='button' type='button' value='commander'><br>
                </article><br>;
            ";
        }
    }

    echo $return;
}

if(isset($_POST['name']) && isset($_POST['categorie']) && isset($_POST['description']) &&  isset($_POST['motif']))
{
    $connect = connexion();

    $sql = "INSERT INTO ajout_produit(id_user, name, categorie, description, motif) VALUES(".$_SESSION['id_user'].", \"".$_POST['name']."\", ".intval($_POST['categorie']).", \"".$_POST['description']."\", \"".$_POST['motif']."\"),";

    if($_POST['quantite'] > 1)
    {
        for($i = 1; $i < $_POST['quantite']; $i++)
        {
            $sql .= "(".$_SESSION['id_user'].", \"".$_POST['name']."\", ".intval($_POST['categorie']).", \"".$_POST['description']."\", \"".$_POST['motif']."\"),";
        }
    }

    $sql = substr_replace($sql, ';', -1);

    try
    {
        $rep = $connect->prepare($sql);
        $rep->execute();
        if($rep)
        {
            echo 'success';
            send_mail("Ajout Produit", "ajout de : ".$_POST['name']. "dans les produits");
        }
        else
        {
            echo 'error';
        }

    }catch (PDOException $error){
        echo "Erreur : ",$error->getMessage();
    }
}

if(isset($_POST['action'])){
    if($_POST['action'] == 'upload_img'){
        $extentionimg="";
        $message = '';
        $tailleMAX = 2000000; //2 mo pour limite
        var_dump($_FILES);
        //recupere l'extention de l'img uploadé
        $extimg = explode('/',$_FILES['image']['type']) ;
        //tableau d'extention autorisé
        $extentions=array('jpeg','jpg','gif');

        $bool = true; $erreur = '';
        /* conditions pour verifier si l'image est conforme */

        //ckeck erreur a l'upload
        if($_FILES['image']['error']!=0 ){
            $bool = false;
            $erreur .= 'Erreur lors de l\'upload <br>';
        }

        //check extention
        if(!in_array($extimg[1],$extentions)){
            $bool = false;
            $erreur .='le type de fichier est incorrect <br>';

        }

        //check taille max
        if($_FILES['image']['size']> $tailleMAX){
            $bool = false;
            $erreur .=' Le fichier est trop lourd  <br>';
        }
        $taille = $_FILES['image']['size'];
        $name = $_FILES['image']['name'];
        $date = date("Y-m-d H:i:s");

        if($erreur=='' && $bool = true){
                //création du nom unique de l'image
                $nomimg = md5(time().uniqid());
                $extentionimg =$extimg[1];
                echo $nouveauchemin = __DIR__."\images\ ".$nomimg.'.'.$extentionimg;
                if(move_uploaded_file($_FILES['image']['tmp_name'], $nouveauchemin)){
                    $connect = connexion();
                    $requete = <<<EOD
                    INSERT INTO `images` (`id`, `nom_uniq`, `extention`, `nom_img`, `stamp`, `taille`) VALUES (NULL, '$nomimg', '$extentionimg', '$name', '$date', '$taille');
                    EOD;
                    $stmt = $connect -> prepare($requete);
                    $stmt -> execute();
                    echo 'Success';
                }
        }

    }
}

?>
