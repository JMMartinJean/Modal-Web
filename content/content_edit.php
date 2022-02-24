<?php

require('content/content_write-article.php');

function checkAuth_edit() {
    if (!isLoggedIn() || !array_key_exists('article', $_GET)) {
        return array(false, '', '');
    }

    global $bdd;
    $req = $bdd->prepare("SELECT titre, contenu, id_auteur FROM articles WHERE ID = ?");
    $req -> execute(array($_GET['article']));
    
    if ($req->rowCount() != 1) {
        return array(false, '', '');
    }
    $res = $req->fetch();
    if ($res['id_auteur'] === $_SESSION['userid']) {
        return array(true, $res['titre'], $res['contenu']);
    }
    return array(false, '', '');
}

function display_edit($titre, $contenu) {
    generateForm_writearticle($titre, $contenu);
}

function display_error() {
    echo '<div class="container-fluid"><h1>Erreur</h1><p>Vous essayez d\'accéder à une page inexistante ou interdite.<br><a href = "index.php">Retour en lien sûr</a></p></div>';
}