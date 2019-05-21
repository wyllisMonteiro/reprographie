<?php
    session_start();
    require "bdd.php";

    if(isset($_POST['email']) AND isset($_POST['pass'])) {
        $sql = 'SELECT *
                FROM user
                WHERE email = :email
                AND pass = :pass';

        $sth = $bdd->prepare($sql);
        $sth->execute(array(':email' => $_POST['email'], ':pass' => $_POST['pass']));
        $user = $sth->fetch();

        if(isset($user["id"])) {
            $_SESSION["auth"] = $user;
            header('Location: ./demand.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        form{
            width: 50%;
            margin: 200px auto 0px auto;
        }
    </style>
</head>
<body>

    <form action="" method="POST">
        <div class="form-group">
            <label for="email">Email address</label>
            <input class="form-control" name="email" type="email" id="email" placeholder="example@gmail.com">
        </div>
        <div class="form-group">
            <label for="pass">Password</label>
            <input type="password" class="form-control"  name="pass" id="pass" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>