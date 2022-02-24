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

function generateTous($bdd, $page) {
    $nb_article_par_page = 6;
    $offset = 0;
    if (is_int($page) && $page > 0) {
        $offset = $nb_article_par_page * $page;
    }

    $rep = $bdd->prepare('SELECT id, titre, image, contenu FROM articles '
            . 'WHERE statut = "valide" '
            . 'ORDER BY parution DESC '
            . 'LIMIT ' . ($nb_article_par_page + 1) . ' OFFSET ' . $offset);
    $rep->execute();
    $nbAffiches = 0;
    while ($article = $rep->fetch()) {
        if ($nbAffiches < $nb_article_par_page) {
            echo '
            <div class="row" style="border:solid gray 1px; margin-bottom: 5px">
                <img class="col-2 imgTous" src="images/' . $article["image"] . '.JPG" alt="' . $article["image"] . '">

                <div class="col-10">
                    <h5>
                        ' . htmlspecialchars($article['titre']) . '
                    </h5>
                    <p>
                        ' . substr(strip_tags($article['contenu']), 0, 600) . '...
                        <a href="index.php?page=read&article=' . $article["id"] . '"> Lire l\'article</a>
                    </p>
                </div>
            </div>';
        }
        $nbAffiches++;
    }

    echo '<button data-page="' . ($page - 1) . '" class="navigate"' . ($page == 0 ? 'disabled' : '') . '>Précédent</button>';
    echo '<button data-page="' . ($page + 1) . '" class="navigate"' . ($nbAffiches <= $nb_article_par_page ? 'disabled' : '') . '>Suivant</button>';
}

function generateMainPage() {
    global $bdd;
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
    generateTous($bdd, 0);
    echo '
    </div>
</div>';
}
