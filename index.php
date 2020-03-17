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
        <?php
            affichageTitre();
            affichageAuth();
            affichageContenu($db);
            affichagePanier($db);
            affichagePiedPage();
        ?>
    </div>
</body>
</html>
<?php
close($db);
?>
