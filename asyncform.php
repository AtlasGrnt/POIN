<?php
ini_set('display_errors', 'off');
session_start();

require "function.php";

if( isset($_POST['username']) && isset($_POST['password'])&& isset($_POST['type_user']) ){
    $connect = connexion();
    $username = $_POST['username'];
    
    if(isset($_POST['email'])){
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
?>