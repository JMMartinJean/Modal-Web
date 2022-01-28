<?php

function do_changeUserStatus($idUser, $nvtype) {
    global $bdd;
    if (($nvtype == 'admin' || $nvtype == 'journaliste' || $nvtype == 'visiteur') && is_numeric($idUser)) {
        $req = $bdd->prepare("UPDATE `users` SET `type` = ? WHERE `users`.`ID` = ?");
        $req->execute(array($nvtype, $idUser));
        
        $req = $bdd->prepare("DELETE FROM upgrade_requests WHERE id_user = ?");
        $req->execute(array($idUser));

        addAlert('L\'utilisateur a bien été nommé ' . $nvtype, 'success');
        return 1;
    } else {
        addAlert('Les informations reçues sont incorrectes', 'error');
        return 0;
    }
}

function validateArticle_aux($id, $titre, $contenu, $newstatut) {
    global $bdd;
    $req = $bdd->prepare('
        UPDATE articles 
        SET 
            titre = ?,
            contenu = ?,
            maj = NOW(),
            statut = ?
        WHERE articles.ID = ?');
    $req->execute(array($titre, $contenu, $newstatut, $id));
}

function do_changeArticleStatus($idArticle, $titre, $contenu, $newstatut) {
    if (is_numeric($idArticle) && ($newstatut == 'refuse' || $newstatut == "valide")) {
        validateArticle_aux(intval($idArticle), $titre, $contenu, $newstatut);
        if ($newstatut == "valide") {
            addAlert('Article publié !', 'success');
        } else {
            addAlert('Article rangé à la poubelle.', 'success');
        }
        return 1;
    } else {
        addAlert('Les informations reçues sont incorrectes', 'error');
        return 0;
    }
}

function runBefore() {
    if (array_key_exists('id', $_GET) && array_key_exists('nvtype', $_GET)) {
        do_changeUserStatus($_GET['id'], $_GET['nvtype']);
    }

    if (array_key_exists('newstatut', $_POST) && array_key_exists('contenu', $_POST) && array_key_exists('titre', $_POST) && array_key_exists('id', $_POST)) {
        do_changeArticleStatus($_POST['id'], $_POST['titre'], $_POST['contenu'], $_POST['newstatut']);
    }
}

function runCore() {
    echo '<div class="container-fluid">';
    usersToUpgrade();
    articlesToReview();
    echo '</div>';
}
