<?php

function log_in($nom, $mdp) {
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM users WHERE username = ?');
    $req->execute(array($nom));
    if ($req->rowCount() != 1) {
        addAlert('Nom d\'utilisateur inexistant ou duplique', 'error');
        return false;
    }
    $rep = $req->fetch();
    if (!password_verify($mdp, $rep['password'])) {
        addAlert('Mot de passe incorrect', 'error');
        return false;
    }
    $_SESSION['loggedIn'] = true;
    $_SESSION['username'] = $nom;
    $_SESSION['usertype'] = $rep['type'];
    $_SESSION['userid'] = $rep['ID'];
    return true;
}

function runBefore() {
    if (array_key_exists('username', $_POST) && array_key_exists('password', $_POST)) {
        log_in($_POST['username'], $_POST['password']);
    }
}

function runCore() {
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
        echo '<p class="successmsg">Connecté en tant que ' . htmlspecialchars($_SESSION['username']) . '</p>';
        require('content/content_main.php');
        generateMainPage();
    } else {
        $default = '';
        if (array_key_exists('username', $_SESSION)) {
            $default = htmlspecialchars($_SESSION['username']);
        }
        generateForm_login(htmlspecialchars($default));
    }
}
