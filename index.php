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

$bdd->close();

/*switch ($askedPage) {
    case 'admin': require('utilities/utils_admin.php'); runAdmin(); break;
    case 'login': require('utilities/utils_login.php');runLogin(); break;
    case 'main': require('utilities/utils_main.php'); runMain(); break;
    case 'new-account': require('utilities/utils_new-account.php');runNewAccount; break;
    case 'read': require('utilities/utils_read.php');runRead(); break;
    case 'unlog': require('utilities/utils_unlog.php');runUnlog(); break;
    case 'write-article': require('utilities/utils_write-article.php');runWriteArticle(); break;
    default: runUnknown(); break;
}*/

/* TODO
 *      FONCTIONALITES
 * Espace visiteur/journalistes (voir ses likes, ses articles, les modifier (my-space)
 * Espace compte (modifier mdp & nom d'utilisateur)
 * Système de like (read)
 * 
 *      CHANGEMENTS MINEURS
 * Bouton de navigation pour afficher les articles suivants (main)
 * Bouton de navigation pour les commentaires (read)
 * 
 *      CHANGEMENTS RECENTS
 * Espace commentaire sous les articles (read)
 * Ajouter une photo à ses articles (write-article)
 *  */
