<?php


/**
 * Fonction de connexion à la base de données
 *
 * @return false|mysqli
 */
function connect(){
    $db = mysqli_connect('localhost', 'root', 'root', 'vente_en_ligne') or die('Erreur SQL : ' . mysqli_error($db));
    $db->query('SET NAMES UTF8');
    return $db;
}


/**
 * Fonction de déconnexion à la base de données
 *
 * @param $db : instance de la base de données à déconnecter
 */
function close($db){
    mysqli_close($db);
}

/**
 * Fonction pour ajouter un article dans le panier
 *
 * @param $id_article : ID de l'article à ajouter
 * @param $db : instance de la base de données
 */
function ajouter_article($id_article, $db)
{
    $sql = 'SELECT taux, prix_ttc
                FROM article INNER JOIN tva ON (article.id_tva = tva.id)
                WHERE article.id = '.$id_article.';';
    $result = $db->query($sql);
    $data = mysqli_fetch_array($result);
    if(!empty($data)) //TEST SI ID_ARTICLE EST VALIDE
    {
        $sql = 'SELECT * FROM panier_article WHERE id_article = '.$id_article.';';
        $result = $db->query($sql);
        $test = mysqli_fetch_array($result);
        if(!empty($test)) //AJOUT D'UN L'ARTICLE DEJA PRESENT DANS LE PANIER
        {
            $sql = 'UPDATE panier_article
                        SET quantite = quantite+1
                        WHERE id_article='.$id_article.';';
        }
        else { //AJOUT D'UN ARTICLE NON EXISTANT DANS LE PANIER
            $data['prix_ht'] = $data['prix_ttc'] / (1+$data['taux']/100);
            $data['prix_tva'] = $data['prix_ttc'] - $data['prix_ht'];
            $sql = 'INSERT INTO panier_article 
                        VALUES (1, '. $id_article .', 1, ' . $data['prix_ht'] . ', ' . $data['prix_tva'] . ',  ' . $data['prix_ttc'] . ');';
        }
        $db->query($sql) or die('Erreur SQL : ' . mysqli_error($db));
    }
}

/**
 * Fonction pour supprimer toutes les lignes du panier
 *
 * @param $db : instance de la base de données
 */
function viderPanier($db){
    if (isset($_GET['Vide_panier'])){
        $sql ='DELETE FROM panier_article
               WHERE id_panier = 1';
        $db->query($sql);
    }
}

?>
