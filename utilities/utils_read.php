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
        $req = $bdd->prepare('INSERT INTO comments (ID, id_auteur, id_article, date_release, content) VALUES (NULL, ?, ?, NOW(), ?)');
        $req->execute(array($_SESSION['userid'], $idArticle, $content));
    }
}

function checkComReceive($tab) {
    return array_key_exists('id_article', $tab) && array_key_exists('content', $tab);
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
        echo '<img class="col-2" src="images/' . $article['image'] . '.jpg" alt="' . $article['image'] . '">';
        article_title(htmlspecialchars($article['titre']), htmlspecialchars($article['username']), $article['last_maj']);
        article_likes($idArticle);
        echo '      </div>';
        //echo '<div class="container-fluid">' . ($article['contenu']) . '</div>';  //pas besoin de htmlspecialchars grâce au formulaire sécurisé
        echo '<div class="card">
                <div class="card-body">
                    ' . ($article['contenu']) . '
                </div>
              </div>';
        echo '</div>';
        echo '<div class="container-fluid" style="margin-top:40px">';
        echo '<h2>Commentaires</h2>';
        generateCommentForm($idArticle);
        generateComments($bdd, $idArticle, 0);
        echo '</div>';
    } else {
        echo errorMsg();
    }
}


