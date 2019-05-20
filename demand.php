<?php
    session_start();
    require "bdd.php";

    $result = "";

    if(!isset($_SESSION["auth"])) {
        header('Location: ./index.php');
    }
    
    $sql_demand = 'INSERT INTO reprographie.demand (
                                        date_demand ,
                                        date_ready_print ,
                                        nb_print ,
                                        format_page ,
                                        orientation ,
                                        agrafage ,
                                        commentaire
                                        )
            VALUES (:date_demand, :date_ready_print, :nb_print, :format_page, :orientation, :agrafage, :commentaire
        );';

    $sth_demand = $bdd->prepare($sql_demand);

    $request_demand = $sth_demand->execute(array(':date_demand' => '2019-05-21',
                        ':date_ready_print' => "2019-05-22",
                        ':nb_print' => 3,
                        ':format_page' => "A3",
                        ':orientation' => "Paysage",
                        ':agrafage' => 1,
                        ':commentaire' => "sds"));
                        
    
    if(!$request_demand) {
        $result = "oui";
    }

    $id_demand = $bdd->lastInsertId();

    $sql_demand = 'INSERT INTO reprographie.user_demand (id_user, id_demand)
                    VALUES (:id_user, :id_demand);';

    $sth_demand = $bdd->prepare($sql_demand);

    $request_demand = $sth_demand->execute(array(':id_user' => $_SESSION["auth"]["id"], ':id_demand' => $id_demand));

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faire une demande d'impression</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        form{
            width: 50%;
            margin: 50px auto 0px auto;
        }
    </style>
</head>
<body>

    <?php require "navbar.html"; ?>

    <?php echo $result; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="date_demand">Date de la demande</label>
            <input class="form-control" name="date_demand" type="text" placeholder="2019-05-05" id="date_demand" placeholder="2019-05-05">
        </div>

        <div class="form-group">
            <label for="date_ready_print">Date ou les photocopies doivent être prêtes</label>
            <input type="text" class="form-control"  name="date_ready_print" id="date_ready_print" placeholder="Password">
        </div>

        <div class="form-group">
            <label for="photocopies">Photocopies</label>
            <input type="text" class="form-control"  name="photocopies" id="photocopies" placeholder="2">
        </div>

        <div class="form-group">
            <label for="format">Format</label>
            <input type="text" class="form-control"  name="format" id="format" placeholder="A4">
        </div>

        <div class="form-group">
            <label for="orientation">Orientation</label>
            <input type="text" class="form-control"  name="orientation" id="orientation" placeholder="Paysage">
        </div>

        <div class="form-group">
            <span>Photocopies</span>
            <label for="yes_photocopies">Oui</label>
            <input type="radio" class="form-control"  name="photocopies" id="yes_photocopies">
            <label for="no_photocopies">Non</label>
            <input type="radio" class="form-control"  name="photocopies" id="no_photocopies">
        </div>

        <div class="form-group">
            <label for="commentaire">Commentaires</label>
            <textarea class="form-control" style="resize: none" name="commentaire" id="commentaire"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>