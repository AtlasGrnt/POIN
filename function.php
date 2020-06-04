<?php

require "const.php";

function connexion() {
    return new PDO(DSN,USERNAME,PASSWORD,
[PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_ASSOC]);
}



?>