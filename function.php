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
            <p id='image'><img src='images/".$index['images']."'></p>
            <input class='buttonCommander' type='button' value='commander'><br>
        </article><br>";
    }
    return $return;
}

?>