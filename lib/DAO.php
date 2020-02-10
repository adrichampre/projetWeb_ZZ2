<?php


function connect(){
    $db = mysqli_connect('localhost', 'adrien', 'adriendu48', 'vente_en_ligne') or die('Erreur SQL : ' . mysqli_error($db));
    $db->query('SET NAMES UTF8');
    return $db;
}


function close($db){
    mysqli_close($db);
}

?>
