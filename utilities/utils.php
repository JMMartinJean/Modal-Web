<?php

require('utilities/utils_navbar.php');

$all = array('admin', 'journaliste', 'visiteur', 'unlogged');
$connected = array('admin', 'journaliste', 'visiteur');
$pageList = array(
    'admin' => array(
        'title' => 'Le kI - Espace administrateur',
        'auth' => array('admin')
    ),
    'login' => array(
        'title' => 'Le kI - Se connecter',
        'auth' => array('unlogged'),
    ),
    'main' => array(
        'title' => 'Le kI - Accueil',
        'auth' => $all,
    ),
    'new-account' => array(
        'title' => 'Le kI - Créer un compte',
        'auth' => array('unlogged'),
        'script' => array('js/js_new-account.js')
    ),
    'read' => array(
        'title' => 'Le kI', //Le titre de la page dépend de l'article lu ! Donc je ne mets rien ici
        'auth' => $connected
    ),
    'unlog' => array(
        'title' => 'Le kI - Se connecter',
        'auth' => $connected
    ),
    'write-article' => array(
        'title' => 'Le kI - Ecrire un article',
        'auth' => array('journaliste', 'admin'),
        'script' => array(
            '0' => 'https://cdn.tiny.cloud/1/zjkdssckeizytqdo5av8o6dm2dtceccuhey77jmblx6l0lnb/tinymce/5/tinymce.min.js" referrerpolicy="origin',
            '1' => 'js/fr_FR.js',
            '2' => 'js/js_write-article.js'
        ),
    ),
    'review-article' => array(
        'title' => 'Le kI - Relecture d\'un article',
        'auth' => array('admin'),
        'script' => array(
            '0' => 'https://cdn.tiny.cloud/1/zjkdssckeizytqdo5av8o6dm2dtceccuhey77jmblx6l0lnb/tinymce/5/tinymce.min.js" referrerpolicy="origin',
            '1' => 'js/fr_FR.js',
            '2' => 'js/js_review-article.js',
            '3' => 'js/js_write-article.js'
        ),
    ),
    'my-space' => array(
        'title' => 'Le kI - Mon espace',
        'auth' => $connected,
    )
);

function pageExists($askedPage) {
    global $pageList;
    foreach ($pageList as $page => $info) {
        if ($page == $askedPage) {
            return true;
        }
    }
    return false;
}

function checkAuthorization($auth) {
    $type = 'unlogged';
    if (array_key_exists('usertype', $_SESSION)) {
        $type = $_SESSION['usertype'];
    }
    return in_array($type, $auth);
}

function generateHTMLHeader($titre, $stylessheet) {
    echo <<<FIN_HEADER
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> $titre </title>

        <!-- Bootstrap-->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
            
        <!-- JQuery-->
        <script type="text/javascript" src="js/jquery.min.js"></script>

        <!-- Mon CSS Perso -->
        <link href="$stylessheet" rel="stylesheet">


    </head>
    <body>
FIN_HEADER;
}

function generateHTMLFooter() {
    echo <<<FIN_FOOTER
            <div class="row" style="height:50px"></div>
        </body>
    </html>
FIN_FOOTER;
}

function getDonnees($askedPage) {
    global $pageList;

    return $pageList[$askedPage];
}

function isLoggedIn() {
    $to_check = array('loggedIn', 'username', 'usertype', 'userid');
    foreach($to_check as $key) {
        if (!array_key_exists($key, $_SESSION)) {
            return false;
        }
    }
    return ($_SESSION['loggedIn'] == true);
}

function generateNavbar() {
    echo '
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">';
    titreSite();
    echo '<div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-1 mb-lg-0">';
    navbar_accueil();
    navbar_actions();
    echo ' </ul>';

    navbar_compte();
    echo '
            </div> 
        </nav>';
}

function generateScripts($scripts) {
    for ($i = 0; $i < sizeof($scripts); $i++) {
        echo '<script src="' . $scripts[$i] . '"></script>';
    }
}

function addAlert($message, $type) {
    if (!array_key_exists('alerts', $_SESSION)) {
        $_SESSION['alerts'] = array();
    }
    array_push($_SESSION['alerts'], array('msg'=>$message, 'type'=>$type));
}

function displayAlert($message, $type) {
    $validType = array('error', 'success');
    if (in_array($type, $validType) === false) {
        $type = 'error';
    }

    echo '<div class="' . $type . 'msg" role="alert">' . $message . '</div>' . PHP_EOL;
}

function displayAlerts() {
    if (array_key_exists('alerts', $_SESSION)) {
        foreach ($_SESSION['alerts'] as $alert) {
            displayAlert($alert['msg'], $alert['type']);
        }
        unset($_SESSION['alerts']);
    }
}

function my_in_array($one_elt, $arr) {
    foreach ($arr as $elt) {
        if ($elt == $one_elt) {
            return true;
        }
    }
    return false;
}
