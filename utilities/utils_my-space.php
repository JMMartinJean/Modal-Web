<?php

function runBefore() {
    global $bdd;
    if (isLoggedIn() && array_key_exists('nom', $_POST) && array_key_exists('promo', $_POST) && array_key_exists('motivation', $_POST)) {
        $req = $bdd->prepare('SELECT ID FROM upgrade_requests WHERE id_user = ?');
        $req->execute(array($_SESSION['userid']));
        if ($req->rowCount() > 0) {
            addAlert('Une demande d\'upgrade à votre nom est encore en cours de traitement.', 'error');
            return 0;
        }
        
        $req = $bdd->prepare('INSERT INTO `upgrade_requests` (`ID`, `id_user`, `nom`, `promo`, `motivation`, `type_demande`) VALUES (NULL, ?, ?, ?, ?, ?)');
        $typedemande = 'journaliste';
        if ($_SESSION['usertype'] === $typedemande) {
            $typedemande = 'admin';
        }
        $req->execute(array($_SESSION['userid'], $_POST['nom'], $_POST['promo'], $_POST['motivation'], $typedemande));
        addAlert('Demande envoyée aux admin !', 'success');
    }
}

function runCore() {
    if ($_SESSION['usertype'] != 'admin') {
        printUpgrade();
    }
    if ($_SESSION['usertype'] != 'visiteur') {
        printArticles();
    }
}
