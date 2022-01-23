<?php
session_start();
require('classes/Database.php');
require('utilities/utils.php');
$bdd = Database::connect();

function add_like($idLikeur, $idArticle) {
    $req = $bdd->prepare('SELECT * FROM likes WHERE id_likeur = ? AND id_article = ?');
    $req->execute($idLikeur, $idArticle);
    if ($req->rowCount()>0) {
        addAlert('Vous avez déjà réagi sur cet article', 'error');
        return 0;
    }
    $req = $bdd->prepare('UPDATE `articles` SET `nb_like` = nb_like + 1 WHERE `articles`.`ID` = ?');
    $req->execute($idArticle);
    
    $req = $bdd->prepare('INSERT INTO `like` VALUES (NULL, ?, ?, NOW(), "like")');
    $req->execute($idLikeur, $idArticle);
}

function delete_like($idLikeur, $idArticle) {
    $req = $bdd->prepare('DELETE FROM likes WHERE id_likeur = ? AND id_article = ?');
    $req->execute($idLikeur, $idArticle);
}


function main() {
    if (!isLoggedIn()) {
        addAlert('Vous devez <a href="index.php?page=login">vous connecter</a> pour ajouter une réaction sur un article.', 'error');
        return 0;
    }
    if (!array_key_exists ($_POST['increment'] || array_key_exists('id_article', $_POST))) {
        addAlert('Données reçues incorrectes', 'error');
        return 0;
    }
    
    if ($_POST['increment'] == 1) {
        add_like($_SESSION['userid'], $_POST['id_article']);
    }
    elseif ($_POST['increment'] == -1) {
        delete_like($_SESSION['userid'], $_POST['id_article']);
    }
    else {
        addAlert('Données reçues incorrectes', 'error');
        return 0;
    }
    return 1;
}


echo main();

