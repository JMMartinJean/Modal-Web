<?php
/*/*Login de tests:
 * aminassian - tructruk  (admin)
 * projet.modal - pasdemdp (journaliste)
 * randomX - 01234567 (visiteur)
 */
session_start();

require('classes/Database.php');
require('utilities/utils.php');
require('utilities/exceptions_pages.php');

$bdd = Database::connect();

$askedPage = 'main';
if (array_key_exists('page', $_GET)) {
    $askedPage = $_GET['page'];
}

if (pageExists($askedPage)) {
    $donnees = getDonnees($askedPage);
    require('utilities/utils_' . $askedPage . '.php');
    require('content/content_' . $askedPage . '.php');
    
    if (!checkAuthorization($donnees['auth'])) {
        generateUnauthPage();
    } else {
        runBefore();    //CETTE LIGNE CORRESPOND AU TRAITEMENT DE "$_GET['todo']" DANS LE COURS
                        //Pour chaque nom de page valide pour askedPage, il existe un fichier utilities/utils_xxx qui contient au moins deux fonctions: runBefore et runCore
        
        // On passe à l'affichage du code HTML et autre
        generateHTMLHeader($donnees['title'], 'css/stylesperso.css');
        generateNavbar();
        displayAlerts();
        runCore();
        if (array_key_exists('script', $donnees)) {
            generateScripts($donnees['script']);
        }
        generateHTMLFooter();
    }
} else {
    generateUnknownPage();
}



/* TODO
 *      FONCTIONALITES
 * Espace compte (modifier mdp & nom d'utilisateur)
 * Page pour modifier ses articles
 * 
 *      CHANGEMENTS MINEURS
 * Bouton de navigation pour afficher les articles suivants (main)
 *  */



/* CHANGEMENTS RECENTS
 * Espace commentaire sous les articles (read)
 * Ajouter une photo à ses articles (write-article)
 * Espace visiteur/journalistes (voir ses likes, ses articles, les modifier) (my-space)
 * Système de like (read)
 * Bouton de navigation pour les commentaires (read)
 */
