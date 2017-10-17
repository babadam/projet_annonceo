<?php
require('../inc/init.inc.php');


// Attention à personnaliser pour chaque page

$resultat = $pdo -> query("SELECT * FROM commentaire");
$gestion_commentaire = $resultat -> fetch(PDO::FETCH_ASSOC);

echo '<pre>';
print_r($gestion_commentaire);
echo '</pre>';

include('../inc/header.inc.php');
include('../inc/nav.inc.php');

$contenu ='';
$contenu .= 'Nombre de résultats : '.$resultat -> rowCount(). '<br><hr>';

$contenu .= '<table class="table table-bordered">'; // création du tableau HTML
$contenu .= '<tr>'; // création de la ligne de titre

for($i = 0; $i < $resultat -> columnCount(); $i++){
    $colonne = $resultat -> getColumnMeta($i);
    $contenu .= '<th>'.$colonne['name'].'</th>';
}
$contenu .= '<th colspan="2">Actions</th>';
$contenu .= '</tr>'; // fin de ligne de titre

foreach($gestion_commentaire as $valeur){ // parcourt tous les enregistrements

    $contenu .= '<tr>'; // ligne pour chaque enregistrement

        foreach ($gestion_commentaire as $indice => $valeur2) { // parcourt toutes les infos de chaque enregistrement
            if($indice == 'photo'){
                $contenu .= '<td><img src="' . RACINE_SITE . 'photo/' . $valeur2 . '"height="90"></td>';
            }
            else{
                $contenu .= '<td>' . $valeur2 . '</td>';
            }
        }
        $contenu .= '<td><a href=""><img src="../img/edit.png">Editer</a></td>';
        $contenu .= '<td><a href="supprimer_produit.php?id='.$gestion_commentaire['id_commentaire'].'">Supprimer<img src="../img/delete.png"></a></td>';
    $contenu .= '</tr>';
}

$contenu .= '</table>';

?>

<h1>Gestion des commentaires</h1>

<?php echo $contenu; ?>



        <!-- Contenu de la page -->

<?php include('../inc/footer.inc.php'); ?>
