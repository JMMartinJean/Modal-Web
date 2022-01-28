<?php
session_start();
require('../classes/Database.php');
//require('../utilities/utils.php');
$bdd = Database::connect();

function isLoggedIn() {
    $to_check = array('loggedIn', 'username', 'usertype', 'userid');
    foreach($to_check as $key) {
        if (!array_key_exists($key, $_SESSION)) {
            return false;
        }
    }
    return ($_SESSION['loggedIn'] == true);
}
function addAlert($msg, $type) {
    echo '<div class="' . $type. 'msg">' . $msg . '</div>';
}


function add_like($idLikeur, $idArticle) {
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM likes WHERE id_likeur = ? AND id_article = ?');
    $req->execute(array($idLikeur, $idArticle));
    if ($req->rowCount()>0) {
        addAlert('Vous avez déjà réagi sur cet article', 'error');
        return 0;
    }
    $req = $bdd->prepare('UPDATE `articles` SET `nb_like` = nb_like + 1 WHERE `articles`.`ID` = ?');
    $req->execute(array($idArticle));
    
    $req = $bdd->prepare('INSERT INTO `likes` (`ID`, `id_likeur`, `id_article`, `date_like`, `nature_like`) VALUES (NULL, ?, ?, NOW(), "like")');
    $req->execute(array($idLikeur, $idArticle));
    addAlert('Article ajouté à mes likes', 'success');
}

function delete_like($idLikeur, $idArticle) {
    global $bdd;
    $req = $bdd->prepare('DELETE FROM likes WHERE id_likeur = ? AND id_article = ?');
    $req->execute(array($idLikeur, $idArticle));
    
    if ($req->rowCount() > 0) {
        $req = $bdd->prepare('UPDATE `articles` SET `nb_like` = nb_like - 1 WHERE `articles`.`ID` = ?');
        $req->execute(array($idArticle));
        addAlert('Article retiré de mes likes', 'success');
    }
    else {
        addAlert('il n\'y avait aucun like à supprimer !!', 'error');
    }
}


function main() {
    if (!isLoggedIn()) {
        addAlert('Vous devez <a href="index.php?page=login">vous connecter</a> pour ajouter une réaction sur un article.', 'error');
        return 0;
    }
    if (!array_key_exists('increment', $_POST) || !array_key_exists('id_article', $_POST)) {
        addAlert(var_dump($_POST), '');
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

main();

