<?php

try {

    $bdd = new PDO('mysql:host=localhost; dbname=reprographie', 'root', '');

}

catch(exception $e) {

    die('Erreur '.$e->getMessage());

}