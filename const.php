<?php
const HOST = 'localhost'; //Configuration des constantes pour la base de données
const USERNAME = 'root';
const PASSWORD = '';
const DBNAME = 'poin';
const DSN = 'mysql:host=' . HOST . ';dbname=' . DBNAME. ';charset=utf8';
const OPTIONS = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

?>
