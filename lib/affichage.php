<?php

function affichage($db)
{
    if(isset($_GET['Famille']))
    {
        affichage_articles($_GET['Famille'], $db);
    }
    else
        affichage_familles($db);
}

function affichage_familles($db){
    $sql = 'SELECT id, libelle, image, ordre_affichage FROM famille ORDER BY ordre_affichage';
    $result = $db->query($sql) or die('Erreur SQL : '.mysqli_error($db));
    While($data = mysqli_fetch_array($result))
    {
        echo '<a href="index.php?Famille=' . $data['id'] . '">';
        echo '<figure>';
        echo '<img src="img_familles/'. $data['image'] . '" alt=""/>';
        echo '<figcaption>'.$data['libelle'] .'</figcaption>';
        echo '</figure>';
        echo '</a>';
    }
}

function affichage_articles($id_famille, $db){
    echo '<a class="myButton" href="index.php" style="float: left">Retour</a>';
    $sql = 'SELECT reference, libelle, detail, prix_ttc, id_tva, image FROM article WHERE id_famille ='. $id_famille;
    $result = $db->query($sql) or die('Erreur SQL : '.mysqli_error($db));
    //Utiliser des tables pour afficher infos
    While($data = mysqli_fetch_array($result))
    {
        echo '<div id="article">';
            echo '<img src="img_articles/'. $data['image'] . '" alt=""/>';
            echo '<div id="contenuArticle">';
                echo '<h3>'.$data['libelle'].'</h3>';
                echo '<h4>'.$data['detail'] .'</h4>';
                echo '<table><tr><td>'.$data['prix_ttc'].'€</td> <td> <a class="myButton">Commander</a></tr></table>';
            echo '</div>';
        echo '</div>';
    }
}
?>