<?php


function connect(){
    $db = mysqli_connect('localhost', 'root', '', 'vente_en_ligne') or die('Erreur SQL : ' . mysqli_error($db));
    $db->query('SET NAMES UTF8');
    return $db;
}


function close($db){
    mysqli_close($db);
}
/*
function afficher_panier($id,$id_client,,$id_famille,$db){
    $sql = 'SELECT id,date_creation,id_client,id_session FROM panier';
    $result = $db->query($sql) or die('Erreur SQL : '.mysqli_error($db));

    
    
    echo '<a class="myButton" href="index.php" >Vider panier</a>';
    echo '<a class="myButton" href="index.php" >Commander</a>';

    $sql = 'SELECT reference, libelle, detail, prix_ttc, id_tva, image FROM article WHERE id_famille ='. $id_famille;
    $result = $db->query($sql) or die('Erreur SQL : '.mysqli_error($db));


    While($data = mysqli_fetch_array($result))
    {
        echo '<figure>';
        echo '<img src="img_articles/'. $data['image'] . '" alt=""/>';
        echo '<figcaption>'.$data['libelle'] .'</figcaption>';
        echo '</figure>';
    }


    if (isset($_GET['commander'])){
        ajouter_article('commander');
    }
    if(isset($_GET['Famille'])){
        affichage_articles($id_famille,$db);
    }

}

function ajouter_article($id_client,$db){

}*/

?>
