<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

function runBefore() {
    $_SESSION['loggedIn'] = false;
    if (isset($_SESSION['username'])) {
        unset($_SESSION['username']);
    }
    if (isset($_SESSION['usertype'])) {
        unset($_SESSION['usertype']);
    }
    if (isset($_SESSION['userid'])) {
        unset($_SESSION['userid']);
    }
    addAlert('Déconnecté avec succès', 'success');
}

function runCore() {
    generateForm_login('');
}
