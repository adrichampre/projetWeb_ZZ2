<?php


function connect(){
    $db = mysqli_connect('localhost', 'root', 'root', 'vente_en_ligne') or die('Erreur SQL : ' . mysqli_error($db));
    $db->query('SET NAMES UTF8');
    return $db;
}


function close($db){
    mysqli_close($db);
}

function ajouter_article($id_article, $db){
    if (isset($_GET['Commander'])){
        $sql = 'SELECT taux, prix_ttc
                FROM article INNER JOIN tva ON (article.id_tva = tva.id)
                WHERE article.id = '.$id_article.';';
        $result = $db->query($sql);
        $data = mysqli_fetch_array($result);
        if(!empty($data)){
            $sql = 'SELECT * FROM panier_article WHERE id_article = '.$id_article.';';
            $result = $db->query($sql);
            $test = mysqli_fetch_array($result);
            if(!empty($test))
            {
                $sql = 'UPDATE panier_article
                        SET quantite = quantite+1
                        WHERE id_article='.$id_article.';';
            }
            else {
                $data['prix_ht'] = $data['prix_ttc'] / (1+$data['taux']/100);
                $data['prix_tva'] = $data['prix_ttc'] - $data['prix_ht'];
                $sql = 'INSERT INTO panier_article 
                        VALUES (1, '. $id_article .', 1, ' . $data['prix_ht'] . ', ' . $data['prix_tva'] . ',  ' . $data['prix_ttc'] . ');';
            }
            $db->query($sql) or die('Erreur SQL : ' . mysqli_error($db));
        }
    }
}

function viderPanier($db){
    if (isset($_GET['Vide_panier'])){
        $sql ='DELETE FROM panier_article
               WHERE id_panier = 1';
        $db->query($sql);
    }
}

?>
