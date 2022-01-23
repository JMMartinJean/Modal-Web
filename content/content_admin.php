<?php

function usersToUpgrade() {
    global $bdd;
    $req = $bdd->prepare('SELECT id, username, type, type_demande FROM users WHERE type != type_demande');
    $req->execute();
    if ($req->rowCount() == 0) {
        echo '<p style="color:green"><em>Aucun utilisateur n\'a une demande en attente</em></p>';
    } else {
        echo '<div>Liste des utilisateurs ayant fait une demande d\'amélioration:<ul>';
        while ($user = $req->fetch()) {
            echo '<li><b>' . htmlspecialchars($user['username']) . '</b> (' . $user['type'] . ') - Demande à devenir ' . $user['type_demande'] . '<br>';
            echo '<a style="color:lightgreen" href="index.php?page=admin&id=' . $user['id'] . '&nvtype=' . $user['type_demande'] . '">Accepter</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            echo '<a style="color:red" href="index.php?page=admin&id=' . $user['id'] . '&nvtype=' . $user['type'] . '">Refuser</a></li>';
        }
        echo '</ul></div>';
    }
}

function articlesToReview() {
    global $bdd;
    $req = $bdd->prepare('
        SELECT articles.id AS id, username, titre, parution
        FROM articles JOIN users on articles.id_auteur = users.id
        WHERE statut = "attente"');
    $req->execute();
    if ($req->rowCount() == 0) {
        echo '<p style="color:green"><em>Aucun article en attente de publication</em></p>';
    } else {
        echo '<div>Liste des articles en attente:<ul>';
        while ($article = $req->fetch()) {
            echo '<li><b>' . htmlspecialchars($article['titre']) . '</b> (par ' . htmlspecialchars($article['username']) . ' le '
            . $article['parution'] . ') - ';
            echo '<a href="index.php?page=review-article&id=' . $article['id'] . '">Vérifier l\'article</a></li>';
        }
        echo '</ul></div>';
    }
}
