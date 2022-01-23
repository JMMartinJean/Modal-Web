<?php

function titreSite() {
    echo <<<TITRE_FIN
    <a class="navbar-brand big-item-navbar" id="titreSite" href="index.php">Le kI</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
    </button>
TITRE_FIN;
}

function navbar_accueil() {
    echo '<li class="nav-item mini-item-navbar">
            <a class="nav-link active" aria-current="page" href="index.php"> Accueil </a>
         </li>';
}

function navbar_action($pageCible, $description) {
    echo <<<FIN_ACTION
        <li class="nav-item mini-item-navbar">
            <a class="nav-link softLink" aria-current="page" href="index.php?page=$pageCible">$description</a>
        </li>
FIN_ACTION;
}

function navbar_actions() {
    global $bdd;
    if (!array_key_exists('loggedIn', $_SESSION) || !$_SESSION['loggedIn']) {
        navbar_action('login', 'Se connecter');
    } else {
        $req = $bdd->prepare("SELECT * FROM users WHERE username = ?");
        $req->execute(array($_SESSION['username']));

        navbar_action('my-space', 'Mon espace perso');
        switch ($req->fetch()['type']) {
            case 'visitor': navbar_action('become-writer', 'Devenir journaliste');
                break;
            case 'admin':
                navbar_action('admin', 'Portail administrateur');
            case 'journaliste':
                navbar_action('write-article', 'Ecrire un article');
                break;
        }
    }
}

function navbar_compte() {
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
        echo '
            <div class="nav-item mini-item-navbar mr-auto dropdown" style="margin-right:15px">
                <button class="btn btn-secondary dropdown-toggle" type="button" 
                        id="userOptions" data-bs-toggle="dropdown" aria-expanded="false">
                    ' . htmlspecialchars($_SESSION['username']) . '
                </button>

                <div class="dropdown-menu" aria-labelledby="userOptions">
                    <a class="dropdown-item" href="#" onClick="alert(\'not implemented yet\');">Paramètres</a>
                    <a class="dropdown-item" href="index.php?page=unlog">Déconnexion</a>
                </div>
            </div>';
    } else {
        echo '<a class="nav-link active" aria-current="page" href="index.php?page=login">Se connecter</a>';
    }
}
