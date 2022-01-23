<?php

function runBefore() {
    
}

function runCore() {
    if ($_SESSION['usertype'] != 'admin') {
        printUpgrade();
    }
    if ($_SESSION['usertype'] != 'visitor') {
        printArticles();
    }
}
