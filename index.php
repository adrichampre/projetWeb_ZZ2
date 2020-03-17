<?php
include "./lib/DAO.php";
include "./lib/affichage.php";
session_start();
$db = connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Top Modélisme</title>
    <link href="styles.css" rel="stylesheet" media="all" type="text/css">
</head>
<body>
    <div id="page">
        <div id="titre">
            <img width="30%" style="float: left" src="img/logo_200px.gif" >  <h1>le leader du modélisme en ligne</h1>
        </div>
        <div id="authentification">
            <form method="post" action="enregistre_utili.php">
                <br>
                adresse email <br> <input type="texte" name="login" /> 
                <br>
                mot de passe <br> <input type="password" name="mdp" /> 
                <br>
            </form>
            <br>
            <a class="myButton">Se connecter</a>
            <a class="myButton">Créer un compte</a>
        </div>
        <?php
            affichageContenu($db);
            affichagePanier($db);
        ?>
        <div id="piedPage">
            <p>TOPModelisme.com est enregistré au R.C.S sous le numero 1234567890
                <br>
                13 avenue du Pre la Reine - 75007 Paris
            </p>
        </div>
    </div>
</body>
<?php
close($db);
?>
</html>
