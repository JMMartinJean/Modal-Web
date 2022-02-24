<?php
require('utilities/utils_img.php');

function giveImgName($id_article) {
    global $bdd;
    try {
        if (checkImage($_FILES['img']['tmp_name'], $_FILES['img']['name'])) {
            $id = $_SESSION['userid']; //Toutes les vérifications ont été faites en amont
            $req1 = $bdd->prepare('INSERT INTO images (`ID`, `original_name`, `id_auteur`) VALUES (NULL, ?, ?)');
            $req1->execute(array($_FILES['img']['name'], $_SESSION['userid']));
            return 'img_' . $bdd->lastInsertId();
        }
    } catch (Throwable $e) {
        $req = $bdd->prepare('SELECT image FROM articles WHERE ID = ?');
        $req->execute(array($id_article));
        if ($req->rowCount() == 1) {
            return $req->fetch()['image'];
        }
        
        addAlert('Image non conforme: ' . $e->getMessage(), 'error');
        return 'img_kI';
    }
}

function runBefore() {
    $auth = checkAuth_edit(); //sert à sécuriser l'accès à $_GET['article']
    if (!$auth[0]) {
        return;
    }
    
    global $bdd;
    $_SESSION['article_soumis'] = false;
    if (array_key_exists('contenu', $_POST) && array_key_exists('titre', $_POST)) {
        $img = giveImgName($_GET['article']);
        
        $req = $bdd->prepare("INSERT INTO `modify_requests` (`ID`, `id_article`, `id_auteur`, `titre`, `contenu`, `image`) VALUES (NULL, ?, ?, ?, ?, ?)");
        $req->execute(array($_GET['article'], $_SESSION['userid'], $_POST['titre'], $_POST['contenu'], $img));
        addAlert('Modification soumise avec succès', 'success');
        $_SESSION['article_soumis'] = true;
    }
}

function runCore() {
    if (array_key_exists('article_soumis', $_SESSION) && $_SESSION['article_soumis']) {
        require('content/content_my-space.php');
        unset($_SESSION['article_soumis']);
        if ($_SESSION['usertype'] != 'admin') {
            printUpgrade();
        }
        if ($_SESSION['usertype'] != 'visitor') {
            printArticles();
        }
    } else {
        $auth = checkAuth_edit();
        if ($auth[0]) {
            display_edit($auth[1], $auth[2], $_GET['article']); //checkAuth_edit sert à vérifier que ce $_GET['article'] contient une valeur autorisée
        } else {
            display_error();
        }
    }
}

