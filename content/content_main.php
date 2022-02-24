<?php

function generateUne() {
    global $bdd;

    $rep = $bdd->prepare('SELECT id, titre, image FROM articles WHERE statut = "valide" ORDER BY parution DESC LIMIT 1');
    $rep->execute();
    $article = $rep->fetch();

    echo '
        <div class="col-12" style="border:solid grey 1px">
            <div class="col-8 offset-2">
                <img src="images/' . htmlspecialchars($article['image']) . '.JPG" id = "imgUne" alt="' . $article["image"] . '">
            </div>
        </div>
        <h1 class="col-12" id="titreUne">
            <a class="softUnderline" href="index.php?page=read&article=' . $article["id"] . '">
            ' . htmlspecialchars($article['titre']) . '</a>
        </h1>
';
}

function generatePopulaires() {
    global $bdd;

    $rep = $bdd->prepare('SELECT id, titre, contenu, image FROM articles WHERE statut = "valide" ORDER BY parution DESC, nb_like ASC LIMIT 5');
    $rep->execute();
    while ($article = $rep->fetch()) {
        echo '
        <div class="row articlesPop" style="border:solid gray 1px; margin-bottom: 5px">
            <img class="col-2 imgPop" src="images/' . $article["image"] . '.JPG" alt="' . $article["image"] . '">
            <div class="col-10" style="padding-top:5px">
                <a class="softUnderline titrePop" href="index.php?page=read&article=' . $article["id"] . '">
                ' . htmlspecialchars($article['titre']) . '</a>
                <p class="contenuPop">' . substr(strip_tags($article['contenu']), 0, 130) . '... 
                    <a href="index.php?page=read&article=' . $article["id"] . '">Lire la suite</a></p>
            </div>
            
        </div>';
    }
}

function generateTous() {
    global $bdd;
    $rep = $bdd->prepare('SELECT id, titre, image, contenu FROM articles WHERE statut = "valide" ORDER BY parution DESC LIMIT 20');
    $rep->execute();
    while ($article = $rep->fetch()) {
        echo '
        

<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">Article</strong>
          <h3 class="mb-0"> ' . htmlspecialchars($article['titre']) . ' </h3>
          <p class="card-text mb-auto">' . substr(strip_tags($article['contenu']), 0, 600) . '...</p>
          <a href="index.php?page=read&article=' . $article["id"] . '"> Lire l\'article</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <img src="images/' . $article["image"] . '.JPG" alt="' . $article["image"] . '">
        </div>
      </div>

';
    }
}

function generateMainPage() {
    echo '
<div class="container-fluid">
    <div class="row" id = "main_top">
        <div class="col-md-7" id="alaune">
            <h1>A la une</h1>';
    generateUne();
    echo '
    </div>
        <div class="col-md-5" id ="populaire">
            <h1>Populaires</h1>';

    generatePopulaires();
    echo '
        </div>
    </div>
    <div class="container" id = "main_all">
        <h3>&nbsp;&nbsp;Tous les articles</h3>';
    generateTous();
    echo '
    </div>
</div>';
}
