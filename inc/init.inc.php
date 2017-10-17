<?php

// connexion BDD
$hote='localhost';
$bdd='projet_annonceo';
$utilisateur='root';
$passe='';

$pdo = new PDO('mysql:host='.$hote.';dbname='.$bdd, $utilisateur, $passe);
$pdo -> exec("SET NAMES utf8");

// constante pour les chemins
define('RACINE_SITE', '/projet_annonceo/');

// déclaration variable msg pour afficher msg d'erreur
$msg='';

require('fonctions.inc.php');
