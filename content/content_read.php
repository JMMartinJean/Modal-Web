<?php

function errorMsg() {
    return
            '<h1> Page non trouvée. </h1>
            <a href="index.php">Revenir à l\'accueil</a>';
}

function ErrorMsgOnPost() {
    return
            '<h1> Contenu incompréhensible reçu. </h1>
            <p>Les données reçues n\'ont pas pu être traités : <br>
                - ou bien un conflit dans le nom d\'utilisateur : ' . htmlspecialchars($_SESSION['username']) . '<br>
                - ou bien un numéro d\'article erroné : ' . htmlspecialchars($_POST['id_article']) . '<br>
                <a href="index.php">Revenir à l\'accueil</a>
            </p>';
}

function article_title($titre, $username, $last_maj) {
    echo <<<FIN_TITRE
    <div class="col-10">
        <h1> $titre </h1>
        <h6><em> Par  $username - le $last_maj </em></h6>
    </div>
    <div class="separator"></div>
FIN_TITRE;
}

function article_likes() {
    echo '<img src="images/like_empty.png" class="col-1" id = "like" alt="like">';
    //echo '<script src="js/like.js"></script>';
}

function generateCommentForm($idArticle) {
    if (isLoggedIn()) {
        echo <<<FIN_FORM
            <div>
                <p> Ecrivez un commentaire pour ce billet :</p>            
                <form method="post" action="index.php?page=read&article=$idArticle">
                    <label>Texte :</label><br>
                    <textarea name="content" style="width:50%" id="newCom"></textarea><br>
                    <input type="hidden" name="id_article" value=$idArticle>
                    <input type="submit" value="Envoyer"> 
                </form>
            </div>
FIN_FORM;
    } else {
        echo '<p>Vous devez <a href="login.php">vous connectez</a> pour écrire un commentaire.</p>';
    }
}

function generateComments($bdd, $idArticle, $page) { //!\ CETTE FONCTION PREND $bdd EN PARAMETRES CAR ELLE SERA APPELLEE DYNAMIQUEMENT
    $nb_comms_par_page = 5;
    
    echo '<div class="container-fluid" style="margin-top:20px" id="commentaires">';
    $offset = 0;
    if (is_int($page) && $page > 0) {
        $offset = $nb_comms_par_page*$page;
    }    
    $req = $bdd->prepare(
              "SELECT *,DATE_FORMAT(date_release, ' - Le %d/%m/%Y à %Hh%i') as my_date "
            . "FROM comments JOIN users ON users.id = comments.id_auteur "
            . "WHERE comments.id_article = ? "
            . "ORDER BY date_release ASC "
            . "LIMIT 11 OFFSET " . $offset); //LIMIT 11 pour en prendre 1 après (sous reserve d'existence)
                                             //Malheureusement OFFSET ne peut pas être suivi d'un '?'
    $req->execute(array($idArticle));
    $nb_comms = $req->rowCount();
    if ($nb_comms == 0) {
        echo '
        <p><em>Il n\'y a pas de commentaire pour l\'instant. <br>
            <a href="#newCom">Soyez le premier à réagir !</a>
        </em></p>';
    } else {
        $i = 0;
        while ($com = $req->fetch()) {
            if ($i < $nb_comms_par_page) {
                echo '<p><strong>'
                . htmlspecialchars($com['username']) . htmlspecialchars($com['my_date']) . '</strong><br>'
                . nl2br(htmlspecialchars($com['content']))
                . '</p>';
            }
            $i++;
        }
        echo '<button data-idarticle = "' . $idArticle . '" data-page="' .($page-1) . '" class="navigate"'. ($page == 0 ? 'disabled':'') . '>Précédent</button>';
        echo '<button data-idarticle = "' . $idArticle . '" data-page="' .($page+1) . '" class="navigate"' . ($i <= $nb_comms_par_page ? 'disabled':'') . '>Suivant</button>';        
    }
    echo '</div>';
}
