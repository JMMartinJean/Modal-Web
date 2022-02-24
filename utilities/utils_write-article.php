<?php
require('utilities/utils_img.php');

function checkTimeIntervall() {
    //bloc if a activer pour le dev
    if (!false && $_SESSION['usertype'] == 'admin') {
        return true;
    }

    global $bdd;
    $req = $bdd->prepare(
            'SELECT maj
     FROM articles JOIN users ON articles.id_auteur = users.id
     WHERE users.username = ? AND NOW() < maj + INTERVAL 30 MINUTE'
    );
    $req->execute(array($_SESSION['username']));
    return $req->rowCount() == 0;
}


function runBefore() {
    global $bdd;
    $_SESSION['article_soumis'] = false;
    if (!checkTimeIntervall()) {
        addAlert('Vous ne pouvez soumettre qu\'un article toute les demi-heures. Eh oui, les admins ne peuvent pas bosser à plein temps ! Si tout le monde les harcelait comme vous, ce serait la panique.', 'error');
    } elseif (array_key_exists('contenu', $_POST) && array_key_exists('titre', $_POST) && array_key_exists('img', $_FILES)) {
        try {
            if (checkImage($_FILES['img']['tmp_name'], $_FILES['img']['name'])) {
                $id = $_SESSION['userid']; //Toutes les vérifications ont été faites en amont
                $req1 = $bdd->prepare('INSERT INTO images (`ID`, `original_name`, `id_auteur`) VALUES (NULL, ?, ?)');
                $req1->execute(array($_FILES['img']['name'], $id));
                $idImg = $bdd->lastInsertId();

                resize($_FILES['img'], 'images\img_'.$idImg.'.jpg');

                $req = $bdd->prepare("INSERT INTO `articles` (`ID`, `id_auteur`, `titre`, `contenu`, `image`, `statut`, `parution`, `maj`, `nb_like`) VALUES (NULL, ?, ?, ?, ?, 'attente', current_timestamp(), current_timestamp(), 0)");
                $req->execute(array($id, $_POST['titre'], $_POST['contenu'], 'img_'.$idImg));
                addAlert('Article soumis avec succès', 'success');
                $_SESSION['article_soumis'] = true;
            }
            else {
                addAlert('Image non conforme.', 'error');
            }
        } catch (Throwable $e) {
             addAlert('Image non conforme: ' . $e->getMessage(), 'error');
        }
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
        $def_titre = '';
        $def_contenu = '';
        if (array_key_exists('titre', $_POST)) {
            $def_titre = htmlspecialchars($_POST['titre']);
        }
        if (array_key_exists('contenu', $_POST)) {
            $def_contenu = htmlspecialchars($_POST['contenu']);
        }

        generateForm_writearticle($def_titre, $def_contenu, 'write-article');
    }
}
