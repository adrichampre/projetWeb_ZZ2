<?php
/**
 * Fonction affichant le formulaire d'authentification
 */
function affichageAuth()
{
    echo '<div id="authentification">
            <form method="post" action="enregistre_utili.php">
                <p>adresse email 
                    <br> 
                    <input type="texte" name="login" /> 
                </p>
                <p>mot de passe
                    <br> 
                    <input type="password" name="mdp" /> 
                </p>
            </form>
            <a class="myButton">Se connecter</a>
            <a class="myButton">Créer un compte</a>
          </div>';
}

/**
 * Fonction affichant le bloc de contenus des familles et des articles
 *
 * @param $db : instance de la base de données
 */
function affichageContenu($db)
{
    echo '<div id="contenu">';
    if(isset($_GET['Famille']))
        affichage_articles($_GET['Famille'], $db);
    else
        affichage_familles($db);
    echo '</div>';
}

/**
 * Fonction affichant les familles
 *
 * @param $db : instance de la base de données
 */
function affichage_familles($db){
    $sql = 'SELECT id, libelle, image, ordre_affichage FROM famille ORDER BY ordre_affichage';
    $result = $db->query($sql) or die('Erreur SQL : '.mysqli_error($db));
    While($data = mysqli_fetch_array($result))
    {
        echo '<a href="index.php?Famille=' . $data['id'] . '">
                 <figure>
                    <img src="img_familles/'. $data['image'] . '" alt=""/>
                    <figcaption>'.$data['libelle'] .'</figcaption>
                 </figure>
              </a>';
    }
}

/**
 * Fonction affichant les articles d'une famille
 *
 * @param $id_famille : ID de la famille à afficher
 * @param $db : instance de la base de données
 */
function affichage_articles($id_famille, $db){
    echo '<a class="myButton" href="index.php" style="float: left">Retour</a>';
    $sql = 'SELECT id, reference, libelle, detail, prix_ttc, id_tva, image FROM article WHERE id_famille ='. $id_famille;
    $result = $db->query($sql) or die('Erreur SQL : '.mysqli_error($db));
    //Utiliser des tables pour afficher infos
    echo '<div id="divArticles">';
    While($data = mysqli_fetch_array($result))
    {
        echo '<table id="article">
                    <tr>
                        <td rowspan="2">
                            <img src="img_articles/'. $data['image'] . '" alt=""/>
                        </td>
                        <td colspan="2">
                            <p class="libelle">'.$data['libelle'].'</p>
                            <p class="detail">'.$data['detail'] .'</p>
                        </td>
                    </tr>
                    <tr>
                        <td id="prix">'.$data['prix_ttc'].' €</td> 
                        <td> 
                            <a class="myButton" href="index.php?Famille='.$id_famille.'&Commander='.$data['id'].'">Commander</a>
                        </td>
                    </tr>
               </table>';
    }
    echo '</div>';
}

/**
 * Fonction affichant le panier
 *
 * @param $db : instance de la base de données
 */
function affichagePanier($db)
{
    echo '<div id="panier">
            <div id="tetePanier">
                <img width="30px" src="img/panier.gif"/>
                <b>votre panier</b>
            </div>
            <hr>';

    if (isset($_GET['Commander']))
        ajouter_article($_GET['Commander'], $db);

    afficherContenuPanier($db);

    echo '</div>';
}

/**
 * Fonction affichant le contenu du panier
 *
 * @param $db : instance de la base de données
 */
function afficherContenuPanier($db){
    if(isset($_GET['Vide_panier'])){
        viderPanier($db);
    }
    $sql = 'SELECT quantite, panier_article.prix_ttc, libelle 
            FROM panier_article INNER JOIN article 
            ON panier_article.id_article = article.id';
    $result = $db->query($sql);
    $data = mysqli_fetch_array($result);
    if(empty($data))
    {
        echo '<p>Votre panier est vide</p>';
    }
    else
    {
        $total = 0;
        do {
            $soustotal = $data['quantite'] * $data['prix_ttc'];
            echo '<table class="tablePanier">
                    <tr> 
                        <td colspan="2" class="detail">' . $data['libelle'] . '</td>
                    </tr>
                    <tr>
                        <td class="total">' . $data['quantite'] . ' x ' . $data['prix_ttc'] . ' = ' . number_format($soustotal, 2, '.', '') . ' €</td>
                    </tr>
                  </table>';
            $total += $soustotal;
        }while($data = mysqli_fetch_array($result));
           echo '<div>
                    <hr>
                    <table class="tablePanier">
                        <tr>
                            <td class="total">TOTAL : '. number_format($total,2,'.','') .' €</td>
                        </tr>
                    </table>
                    <a class="myButton" href="index.php?Vide_panier=1">Vider panier</a>
                    <a class="myButton">Commander</a>
                </div>';
    }
}

?>
