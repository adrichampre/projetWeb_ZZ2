<?php

function affichage($id_famille, $db)
{

}

function affichage_familles($db){
    $sql = 'SELECT libelle, image, ordre_affichage FROM famille ORDER BY ordre_affichage';
    $result = $db->query($sql) or die('Erreur SQL : '.mysqli_error($db));
    While($data = mysqli_fetch_array($result))
    {
        echo '<figure>';
        echo '<img src="img_familles/'. $data['image'] . '" alt=""/>';
        echo '<figcaption>'.$data['libelle'] .'</figcaption>';
        echo '</figure>';
    }
}

function affichage_articles(){

}
?>
