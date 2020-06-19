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
            <input class='buttonCommander' type='button' value='commander'><br>
        </article><br>";
    }
    return $return;
}

function send_mail($subject, $msg1){
    $to = 'elianfulachier@gmail.com';
    $message = "Bonjour, <br>$msg1";
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .='Content-type: text/html; charset=UTF-8' . "\r\n";
    mail($to, $subject, $message, $headers);
}

?>
