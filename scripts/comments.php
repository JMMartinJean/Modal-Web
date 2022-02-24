<?php
require('../classes/Database.php');
$bdd = Database::connect();
require('../content/content_read.php');

function main() {
    global $bdd;
    if (!array_key_exists('page', $_POST) || !array_key_exists('idArticle', $_POST)) {
        echo 'ERROR : invalid POST argument';
        return 0;
    }
    generateComments($bdd, intval($_POST['idArticle']), intval($_POST['page']));
}

main();