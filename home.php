<?php
    session_start();
    require "config/bdd.php";
    
    if(!isset($_SESSION["auth"])) {
        header('Location: ./index.php');
    }

    $sql = 'SELECT date_demand, date_ready_print, nb_print, format_page, orientation, agrafage, commentaire
            FROM user, demand, user_demand
            WHERE user.id = :id
            AND user.id = user_demand.id_user
            AND demand.id = user_demand.id_demand
            ORDER BY demand.id ASC
            LIMIT 5';

    $sth = $bdd->prepare($sql);
    $sth->execute(array(':id' => $_SESSION["auth"]["id"]));
    $demands = $sth->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Historique de mes demandes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/home.css">
</head>
<body>

    <?php require "navbar.html"; ?>
    
    <h1>Historique de mes demandes</h1>
    <div class="demands">
        <?php

            foreach($demands as $key => $demand) {
                if($demand['agrafage'] == 1) $demand['agrafage'] = "Oui";
                else $demand['agrafage'] = "Non";

                echo "<div class='demand'>";
                echo "Date de la demande : " .                              $demand['date_demand'] . "<br>";
                echo "Date ou les photocopies doivent être prêtes : " .     $demand['date_ready_print'] . "<br>";
                echo "Nombre d'impressions : " .                            $demand['nb_print'] . "<br>";
                echo "Format : " .                                          $demand['format_page'] . "<br>";
                echo "Orientation : " .                                     $demand['orientation'] . "<br>";
                echo "Agraffage : " .                                       $demand['agrafage'] . "<br>";
                echo "Commentaires : " .                                    $demand['commentaire'] . "<br>";
                echo "</div>";
            }
            
        ?>
    </div>
    
</body>
</html>