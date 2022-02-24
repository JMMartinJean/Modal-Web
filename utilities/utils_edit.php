<?php

function runBefore() {
    
    
}

function runCore() {
    $auth = checkAuth_edit();
    if ($auth[0]) {
        display_edit($auth[1], $auth[2]);
    }
    else {
        display_error();
    }
}

