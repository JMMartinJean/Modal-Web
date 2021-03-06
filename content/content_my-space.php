<?php

function printArticles() {
    global $bdd;

    $req = $bdd->prepare("SELECT ID, titre, statut, DATE_FORMAT(maj, ' - Le %d/%m/%Y') as my_date, nb_like FROM articles WHERE id_auteur = ? ORDER BY maj DESC");
    $req->execute(array($_SESSION['userid']));

    echo '<div class="container-fluid"><h3>Mes articles</h3>';

    if ($req->rowCount() == 0) {
        echo 'Vous n\'avez pas encore écrit d\'articles. N\'attendez plus, <a href="index.php?page=write-article">contribuez dès maintenant !</a>';
    } else {
        echo '<ul>';
        while ($article = $req->fetch()) {
            if ($article['statut'] === 'valide') {
                echo '<li><a href="index.php?page=read&article=' . $article['ID'] . '">'
                    . htmlspecialchars($article['titre']) . '</a>' . $article['my_date'];
            }
            else {
                echo '<li>' . htmlspecialchars($article['titre']) . $article['my_date'];
            }
            switch($article['statut']) {
                case 'valide':
                    echo ' [article publié] (' . $article['nb_like'] . ' likes)<br>';
                break;
                case 'attente':
                    echo ' [article en attente de relecture]<br>';
                break;
                case 'refuse':
                    echo ' [article refusé]<br>';
                break;
                default:
                    echo ' [ERREUR - statut invalide]<br>';
            }
            echo '<a href="index.php?page=edit&article=' . $article['ID'] . '">Modifier l\'article</a></li>';
        }
        echo '</ul>';
    }
    echo '</div>';
}

function generateForm_upgrade() {
    echo <<<FIN_FORM
    <form method="post" action="index.php?page=my-space">
        <label>Votre vrai nom : </label>
        <input type="text" name="nom"><br>
        
        <label>Votre promotion : </label>
        <input name="promo" placeholder="X2020" style="width:58px" type="text"><br><br>
    
        <label>Un petit texte de motivation?</label><br>
        <textarea name="motivation" style="width:50%; resize:vertical"></textarea><br>
    
        <input type="submit" value="Soumettre la demande"><br><br>
    </form>
    FIN_FORM;
}

function printUpgrade() {
    global $bdd;
    
    echo '<div class="container-fluid"><h3>Améliorer son compte</h3>';
    echo 'Vous êtes actuellement ' . $_SESSION['usertype'] . '.<br>';
    
    $req = $bdd->prepare('SELECT ID, type_demande FROM upgrade_requests WHERE id_user = ?');
    $req->execute(array($_SESSION['userid']));
    if ($req->rowCount() > 0) {
        echo '<p><em>Vous avez une demande en cours pour devenir ' . $req->fetch()['type_demande'] . '.</em></p>';
    }
    else {
        $newtype = 'journaliste';
        if ($_SESSION['usertype'] == $newtype) {
            $newtype = 'admin';
        }
        echo 'Remplissez le formulaire ci-dessous pour devenir ' . $newtype . ' !';
        generateForm_upgrade();
    }
}
