<?php

//Dans ce fichier, on met toutes les fonctions qui génèrent une page entière

function generateUnknownPage() {
    generateHTMLHeader('Le kI - Page inexistante', 'css/stylesperso.css');
    generateNavbar();
    echo<<<FIN_MSG
    <div class="container-fluid">
        <h1>Page inexistante</h1>
        <p>La page demandée n'existe pas</p>
    </div>
    FIN_MSG;
    generateHTMLFooter();
}

function generateUnauthPage() {
    generateHTMLHeader('Le kI - Accès interdit', 'css/stylesperso.css');
    generateNavbar();
    echo '<div class="container-fluid"><h1>Accès interdit.</h1>';
    if (isLoggedIn()) {
        echo
        '<p>Vous êtes actuellement ' . htmlspecialchars($_SESSION['usertype']) . '.<br>
            Faites une demande d\'amélioration dans <a href="index.php?page=my-space">votre espace personnel</a>';
    } else {
        echo '<p><a href="index.php?page=login">Connectez-vous</a> ou bien <a href="index.php?page=new-account">créez un compte</a> pour avoir accès à plus de fonctionalités !';
    }
    echo '<p><a href="index.php?page=main">Revenir à l\'acceuil</a></p></div>';
    generateHTMLFooter();
}
