<?php

function checkTimeIntervall() {
    //bloc if a activer pour le dev
    if ($_SESSION['usertype'] == 'admin') {
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

function getExtension($name) {
    $tmp = explode('.', $name);
    return end($tmp);
}

function checkImage($tmp_name, $name) {
    $taille_maxi = 100000;
    $taille = filesize($tmp_name);
    list($widthOrig, $heightOrig) = getimagesize($tmp_name);
    if (!in_array(getExtension($name), array('jpg', 'png', 'jpeg'))) {
        addAlert('Les types de fichier autorisés sont .png, .jpg, .jpeg', 'error');
        return false;
    }
    if ($taille>$taille_maxi) {
        addAlert('Le fichier doit faire moins de 100Ko', 'error');
        return false;
    }
    if (300 > $widthOrig || 350 < $widthOrig || 200 > $heightOrig || 250 < $heightOrig) {
        addAlert('La forme de l\'image n\'est pas adaptée. <br> La largeur doit être 325&plusmn;25 et la hauteur 225&plusmn;25, ', 'error');
        return false;
    }
    return true;
}
function resize($file, $chemin) {    
    list($widthOrig, $heightOrig) = getimagesize($file['tmp_name']);
    $newHeight = 236;
    $newWidth = 315;
    $tmpPhotoResized = imagecreatetruecolor($newWidth, $newHeight);
    //imagecreatetruecolor($newWidth, $newHeight)
    //$tmpPhotoResized = imagecreatetruecolor($newWidth, $newHeight);
    if (getExtension($file['name']) === 'png') {
        $image = imagecreatefrompng($file['tmp_name']);
    } else {
        $image = imagecreatefromjpeg($file['tmp_name']);
    }
    imagecopyresampled($tmpPhotoResized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $widthOrig, $heightOrig);

    // $photoLD est le chemin vers votre nouvelle photo LD

    imagejpeg($tmpPhotoResized, $chemin, 100);

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

        generateForm_writearticle($def_titre, $def_contenu);
    }
}
