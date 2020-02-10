<?php
include "./lib/affichage.php";
include "./lib/DAO.php";
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
            <img width="30%" style="float: left" src="img/logo_500px.gif" >  <p>le leader du modélisme en ligne</p>
        </div>
        <div id="authentification">
            <a>Se connecter</a>
            <a>Créer un compte</a>
        </div>
        <div id="contenu">
            <?php
                affichage_familles($db);
                close($db);
            ?>
        </div>
        <div id="panier">
            <div>
                <img width="30px" style="float: left" src="https://s2.qwant.com/thumbr/0x0/e/f/939d4faafdfac34662361a9f75dc2b32272a91d32f367f5d7d967d6ddbbfb7/Download-Shopping-Cart-Logo-Png-Image-74545-For-Designing-Projects.png?u=http%3A%2F%2Fpngriver.com%2Fwp-content%2Fuploads%2F2018%2F04%2FDownload-Shopping-Cart-Logo-Png-Image-74545-For-Designing-Projects.png&q=0&b=1&p=0&a=1">
                <p>votre Panier</p>
            </div>
            <div>
                <a>Ajouter dans panier</a>
                <a>Commander</a>
            </div>
        </div>
        <div id="piedPage">
            <p>TOPModelisme.com ett enregistré au R.C.S</p>
        </div>
    </div>

</body>
</html>
