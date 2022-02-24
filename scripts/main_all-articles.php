<?php

require('../classes/Database.php');
$bdd = Database::connect();
require('../content/content_main.php');

function main() {
    global $bdd;
    if (!array_key_exists('page', $_POST)) {
        echo 'ERROR : invalid POST argument';
        return 0;
    }
    generateTous($bdd, intval($_POST['page']));
}

main();