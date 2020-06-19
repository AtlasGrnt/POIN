<?php

require "const.php";

function connexion() {
    return new PDO(DSN,USERNAME,PASSWORD,
[PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_ASSOC]);
}

function printProducts(){
    $return = '';
    $connect = connexion();

    $requestsql ="SELECT * FROM produits";
    foreach($connect->query($requestsql) as $index) {
        $return.="
        <article>
            <h3>".$index['name']."</header> </h3>
            <p>".$index['description']."</p>
            <p><img src='images/".$index['images']."'id='image'></p>
            <input class='buttonCommander' type='button' id='".$index['id']."' value='ajouter au panier'><br>
        </article><br>";
    }
    return $return;
}

function printPanier(){
    $return='';
    $connect = connexion();
    $IdUSer = $_SESSION['id_user'];
    $requestsql = "SELECT * from paniers where id_user = $IdUSer";
    
    foreach($connect->query($requestsql) as $index){
        $return.="
        <p>".$index['name']."</p>
        <p><img src='images/".$index['images']."'id='image'></p>
        ";
    }

    return $return;
}

?>