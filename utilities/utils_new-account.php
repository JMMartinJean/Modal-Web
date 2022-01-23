<?php

function createAccount($username, $passw) {
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM users WHERE username = ?');
    $req->execute(array($username));
    if ($req->fetch()) {//Un utilisateur possède déjà ce username
        addAlert('Le nom d\'utilisateur est déjà utilisé !', 'error');
    } else if (!preg_match('/^(?:[a-zA-Z0-9]|\.|_|-){1,30}$/', $username)) {//Le username n'est pas valide
        addAlert('Le nom d\'utilisateur ne peut contenir que des caractères alphanumériques (non accentués), et les caractères "." , "_" et "-". <br> Il doit aussi être de longueur <= 30', 'error');
    } else {//Tout est valide
        $req = $bdd->prepare('INSERT INTO users (ID, username, password, first_date, type, type_demande) VALUES (NULL, ?, ?, CURRENT_TIMESTAMP, \'visiteur\', \'visiteur\')');
        $req->execute(array($username, password_hash($passw, PASSWORD_DEFAULT)));
        addAlert('Compte créé avec succès', 'success');
        $_SESSION['username'] = $username;
        $_SESSION['loggedIn'] = true;
        $_SESSION['usertype'] = 'visiteur';
        $_SESSION['userid'] = $bdd->lastInsertId();
    }
}

function runBefore() {
    if (array_key_exists('username', $_POST) && array_key_exists('password', $_POST)) {
        createAccount($_POST['username'], $_POST['password']);
    }
}

function runCore() {
    if (!isLoggedIn()) {
        $default = '';
        if (array_key_exists('username', $_POST)) {
            $default = $_POST['username'];
        }
        generateForm_newaccount($default);
    } else {
        require('content/content_main.php');
        generateMainPage();
    }
}
