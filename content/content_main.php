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

function generateTrois() {
    global $bdd;

    $rep = $bdd->prepare('SELECT id, titre, image FROM articles WHERE statut = "valide" ORDER BY parution DESC LIMIT 3');
    $rep->execute();
    $article1 = $rep->fetch();
    $article2 = $rep->fetch();
    $article3 = $rep->fetch();

    echo '
      
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/' . htmlspecialchars($article1['image']) . '.JPG" id = "imgUne" alt="' . $article1["image"] . '" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
            <h5 style="color: grey;">' . htmlspecialchars($article1['titre']) . '</h5>
            <a href="index.php?page=read&article=' . $article1["id"] . '"> Lire l\'article</a>
        
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/' . htmlspecialchars($article2['image']) . '.JPG" id = "imgUne" alt="' . $article2["image"] . '" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 style="color: grey;">' . htmlspecialchars($article2['titre']) . '</h5>
        <a href="index.php?page=read&article=' . $article2["id"] . '"> Lire l\'article</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/' . htmlspecialchars($article3['image']) . '.JPG" id = "imgUne" alt="' . $article3["image"] . '" class="d-block w-100" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5 style="color: grey;">' . htmlspecialchars($article3['titre']) . '</h5>
        <a href="index.php?page=read&article=' . $article3["id"] . '"> Lire l\'article</a>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    

';
}

function generatePopulaires() {
    global $bdd;

    $rep = $bdd->prepare('SELECT id, titre, contenu, image FROM articles WHERE statut = "valide" ORDER BY parution DESC, nb_like ASC LIMIT 5');
    $rep->execute();
    while ($article = $rep->fetch()) {
        echo '
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">Article</strong>
          <h3 class="mb-0"> ' . htmlspecialchars($article['titre']) . ' </h3>
          <p class="card-text mb-auto">' . substr(strip_tags($article['contenu']), 0, 130) . '...</p>
          <a href="index.php?page=read&article=' . $article["id"] . '"> Lire l\'article</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <img src="images/' . $article["image"] . '.JPG" alt="' . $article["image"] . '">
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
    //generateUne();
    generateTrois();
    echo '

    ';
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
