<?php

function runBefore() {
    
}

function runCore() {
    $id = 0;
    if (array_key_exists('id', $_GET)) {
        $id = $_GET['id'];
    }
    reviewArticle($id);
}
