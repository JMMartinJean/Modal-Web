<?php
session_start();
require('../classes/Database.php');
$bdd = Database::connect();

function isLoggedIn() {
    $to_check = array('loggedIn', 'username', 'usertype', 'userid');
    foreach($to_check as $key) {
        if (!array_key_exists($key, $_SESSION)) {
            return false;
        }
    }
    return ($_SESSION['loggedIn'] == true);
}
function addAlert($msg, $type) {
    echo '<div class="' . $type. 'msg">' . $msg . '</div>';
}

function changeUsername($username) {
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM users WHERE username = ?');
    $req->execute(array($username));
    if ($req->fetch()) {//Un utilisateur possède déjà ce username
        addAlert('Le nom d\'utilisateur est déjà utilisé !', 'error');
        return 0;
    }
    if (!preg_match('/^(?:[a-zA-Z0-9]|\.|_|-){1,30}$/', $username)) {//Le username n'est pas valide
        addAlert('Le nom d\'utilisateur ne peut contenir que des caractères alphanumériques (non accentués), et les caractères "." , "_" et "-". <br> Il doit aussi être de longueur <= 30', 'error');
        return 0;
    }
    $req = $bdd->prepare("UPDATE `users` SET `username` = ? WHERE `users`.`ID` = ?");
    $req->execute(array($username, $_SESSION['userid']));
    addAlert('Nom d\'utilisateur modifé avec succès. Bienvenue, ' . htmlspecialchars($username) .' !' ,'success');
    $_SESSION['username'] = $username;
    return 1;
}

function changePassword($mdp, $newmdp, $newmdpconfirm) {
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM users WHERE username = ?');
    $req->execute(array($_SESSION['username']));
    $rep = $req->fetch();
    
    if (!password_verify($mdp, $rep['password'])) {
        addAlert('Mot de passe incorrect.' ,'error');
        return 0;
    }
    if ($newmdp !== $newmdpconfirm) {
        addAlert('Les mots de passes ne correspondent pas.' ,'error');
        return 0;
    }
    $req = $bdd->prepare("UPDATE `users` SET `password` = ? WHERE `users`.`ID` = ?");
    $req->execute(array(password_hash($newmdp, PASSWORD_DEFAULT), $_SESSION['userid']));
    addAlert('Mot de passe mis à jour.', 'success');
}


function main() {
    if (isLoggedIn()) {
        if (array_key_exists('username', $_POST)) {
            changeUsername($_POST['username']);
        }
        if (array_key_exists('password', $_POST) && array_key_exists('newpassword', $_POST) && array_key_exists('newpasswordconfirm', $_POST)) {
            changePassword($_POST['password'], $_POST['newpassword'], $_POST['newpasswordconfirm']);
        }
    }
}

main();

