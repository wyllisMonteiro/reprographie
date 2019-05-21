<?php

$host = "localhost";
$dbname = "reprographie";
$user = "root";
$mdp = "";

try {

    $bdd = new PDO('mysql:host=' . $host . '; dbname=' . $dbname, $user, $mdp);

}

catch(exception $e) {

    die('Erreur '.$e->getMessage());

}