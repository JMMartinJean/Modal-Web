<?php

$idArticle = 0;
try {
    $idArticle = intval($_GET['article']);
} catch (Exception $e) {
    addAlert(errorMsg(), 'error');
}

function saveCom($idArticle, $content) {
    global $bdd;
    if (isLoggedIn()) {
        $req = $bdd->prepare('SELECT ID FROM users WHERE username=?');
        $req->execute(array($_SESSION['username']));
        if ($req->rowCount() != 1 || $_GET['article'] != $idArticle) {
            addAlert(ErrorMsgOnPost(), 'error'); //!\ je n'ai jamais testé cette ligne
        } else {
            $id_auteur = $req->fetch()['ID'];
            $req = $bdd->prepare('INSERT INTO comments (ID, id_auteur, id_article, date_release, content) VALUES (NULL, ?, ?, NOW(), ?)');
            $req->execute(array($id_auteur, $idArticle, $content));
        }
    }
}

function runBefore() {
    if (checkComReceive($_POST)) {
        saveCom($_POST['id_article'], $_POST['content']);
    }
}

function runCore() {
    global $bdd, $idArticle;
    $req = $bdd->prepare('SELECT *, DATE_FORMAT(maj, "%d/%c/%Y") AS last_maj FROM articles JOIN users ON id_auteur = Users.id WHERE articles.id = ? AND articles.statut="valide"');
    $req->execute(array($idArticle));

    if ($article = $req->fetch()) {
        echo '<div class="container-fluid">
                    <div class="row" style="margin-bottom: 20px">';
        article_likes();
        article_title(htmlspecialchars($article['titre']), htmlspecialchars($article['username']), $article['last_maj']);
        echo '      </div>';
        echo '<div class="container-fluid">' . ($article['contenu']) . '</div>';  //pas besoin de htmlspecialchars grâce au formulaire sécurisé

        echo '</div>';
        echo '<div class="container-fluid" style="margin-top:40px">';
        echo '<h2>Commentaires</h2>';
        generateCommentForm($idArticle);
        generateComments($bdd, $idArticle);
        echo '</div>';
    } else {
        echo errorMsg();
    }
}

function checkComReceive($tab) {
    return array_key_exists('id_article', $tab) && array_key_exists('content', $tab);
}
