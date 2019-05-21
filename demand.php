<?php
    session_start();
    require "config/bdd.php";

    $result = "";

    if(!isset($_SESSION["auth"])) {
        header('Location: ./index.php');
    }

    if(isset($_POST['date_demand']) &&
       isset($_POST['date_ready_print']) &&
       isset($_POST['photocopies']) && 
       isset($_POST['format']) &&
       isset($_POST['orientation']) &&
       isset($_POST['agrafage'])) {

        $date_demand = $_POST['date_demand'];
        $date_ready_print = $_POST['date_ready_print'];
        $photocopies = $_POST['photocopies'];
        $format = $_POST['format'];
        $orientation = $_POST['orientation'];
        $agrafage = $_POST['agrafage'];
        $commentaire = $_POST['commentaire'];

        if($agrafage == "yes") {
            $agrafage = 1;
        } else {
            $agrafage = 0;
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

        $request_demand = $sth_demand->execute(array(':date_demand' => $date_demand,
                                                    ':date_ready_print' => $date_ready_print,
                                                    ':nb_print' => $photocopies,
                                                    ':format_page' => $format,
                                                    ':orientation' => $orientation,
                                                    ':agrafage' => $agrafage,
                                                    ':commentaire' => $commentaire));


        if(!$request_demand) {
            $result = "oui";
        }

        $id_demand = $bdd->lastInsertId();

        $sql_demand = 'INSERT INTO reprographie.user_demand (id_user, id_demand) VALUES (:id_user, :id_demand);';
        $sth_demand = $bdd->prepare($sql_demand);
        $request_demand = $sth_demand->execute(array(':id_user' => $_SESSION["auth"]["id"], ':id_demand' => $id_demand));

        $message =  "Date de la demande : " .                             
                    "Date ou les photocopies doivent être prêtes : ".
                    "Nombre d'impressions : ".
                    "Format : " .                                        
                    "Orientation : " .                                     
                    "Agraffage : " .                               
                    "Commentaires : ";

        // mail($_SESSION['auth']['email'], "Demande de photocopies", $message);
        header('Location: ./home.php');

    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faire une demande d'impression</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/demand.css">
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
            <input type="text" class="form-control"  name="date_ready_print" id="date_ready_print" placeholder="2019-05-05">
        </div>

        <div class="form-group">
            <label for="photocopies">Photocopies</label>
            <input type="text" class="form-control"  name="photocopies" id="photocopies" placeholder="2">
        </div>

        <div class="form-group">
            <label for="format">Format</label>
            <select name="format" class="form-control form-control-lg">>
                <option value="A4">A4</option>
                <option value="A3">A3</option>
            </select>
        </div>

        <div class="form-group">
            <label for="orientation">Orientation</label>
            <select name="orientation" class="form-control form-control-lg">>
                <option value="Paysage">Paysage</option>
                <option value="Portrait">Portrait</option>
            </select>
        </div>

        <span>Agrafage</span><br>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="agrafage" id="yes_agrafage" checked value="yes">
            <label class="form-check-label" for="yes_agrafage">
                Oui
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="agrafage"id="no_photocopies" value="no">
            <label class="form-check-label" for="no_photocopies">
                Non
            </label>
        </div>

        <div class="form-group">
            <label for="commentaire">Commentaires</label>
            <textarea class="form-control" style="resize: none" name="commentaire" id="commentaire"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>