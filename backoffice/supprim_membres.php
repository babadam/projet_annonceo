<?php
require_once('../inc/init.inc.php');

// pas besoin de dedign (header, footer, contenu) sur cette page, car elle a seulement vocation à nous faire un traitement puis à nous rediriger vers l'affiche de tous les produits

// On vérifie qu'il a bien un id dans l'url et que c'est un chiffre
// On récupère les infos du produit
// On vérifie que le produit existe-t-il
// On supprime la photo si elle esiste est que c'est pas default.jpg
// On supprime le produit de la BDD
// On regirige vers l'affichage des produits (gestion_produit.php)

if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
    $resultat = $pdo -> prepare("SELECT * FROM membre WHERE id_membre = :id");
    $resultat -> bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $resultat -> execute();

    if($resultat -> rowCount() > 0){ // Signifie que le produit existe
        $membre = $resultat -> fetch(PDO::FETCH_ASSOC);
        debug($membre);


        // supprimer le produit de la BD

        $resultat = $pdo -> exec("DELETE FROM membre WHERE id_membre = $membre[id_membre]");

        if($resultat){
            header('location:gestion_membres.php?msg=suppr&id_membre='.$membre['id_membre']);
        }
    }// fin du if $resultat -> rowCount()
}// fin du if (isset($_GET etc ...
