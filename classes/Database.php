<?php

class Database {

    public static function connect() {
        $dsn = 'mysql:host=localhost;dbname=projetmodalweb;charset=utf8';
        $user = 'root';
        $password = '';
        $dbh = null;
        try {
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
            exit(0);
        }
        return $dbh;
    }

}


/*
class Database {
    try {
    $bdd = new PDO('mysql:host=localhost;dbname=projetmodalweb;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
}
*/