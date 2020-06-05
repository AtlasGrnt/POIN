<?php
ini_set('display_errors', 'off');
session_start();

require "function.php";

if( isset($_POST['username']) && isset($_POST['password'])){
    $connect = connexion();
    $username = $_POST['username'];
    
    if(isset($_POST['email']) && isset($_POST['type_user'])){
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
        }
        else
        {
            echo 'error';
        }

    }catch (PDOException $error){
        echo "Erreur : ",$error->getMessage();
    }
}

?>