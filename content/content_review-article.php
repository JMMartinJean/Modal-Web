<?php

function lastModifyRequest($id) {
    global $bdd;
    $req = $bdd->prepare(
        'SELECT * 
        FROM modify_requests JOIN users on modify_requests.id_auteur = users.id 
        WHERE id_article = ? 
        ORDER BY modify_requests.id DESC');
    $req->execute(array($id));
    if ($req->rowCount() == 0) {
        return 0;
    }
    return $req->fetch();
}

function getArticle($id) {
    global $bdd;
    $req = $bdd->prepare('
        SELECT *
        FROM articles JOIN users on articles.id_auteur = users.id
        WHERE articles.id = ?');
    $req->execute(array($id));

    echo '<div class="container-fluid">';
    if ($req->rowCount() != 1) {
        
        return 0;
    }
    $article = $req->fetch();
    if ($article['statut'] != 'attente') {
        echo '<p class="errormsg">L\'article n\'est pas en attente et n\'a aucune modification en attente.</p></div>';
        return 0;
    }
    return $article;
}

function findMetadata($id_article) {
    $article = lastModifyRequest($id_article);
    if ($article == 0) {
        $article = getArticle($id_article);
    }
    return $article;
}

function reviewArticle($id) {
    $article = findMetadata($id);
    if ($article == 0) {
        return;
    }
    echo '<p>Article posté par ' . $article['username'] . '</p>
        <img src="images\\' . $article['image'] . '.jpg" style="width:88px;height:59px;margin-bottom:20px">
        <form method="post" action="index.php?page=admin" id="form_validation">
            <textarea name="titre" style="width:50%; resize:horizontal">' . htmlspecialchars($article['titre']) . '</textarea>
            <br> <br>
            <textarea name="contenu" id = "contenu" style="width:90%; height:800px">' . htmlspecialchars($article['contenu']) . '</textarea>
            <br>
            <input name="id" value=' . $id . ' type="hidden">
            <input id="newstatut" name="newstatut" type="hidden">
            <input id = "green_btn" type="button" style="background-color:green" value="Publier cet article">
            <input id = "red_btn" type="button" style="background-color:red" value="Refuser cet article">
        </form></div>';
    return 1;
}
