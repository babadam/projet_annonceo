<?php
require('../inc/init.inc.php');


// Attention à personnaliser pour chaque page

$resultat = $pdo -> query("SELECT * FROM commentaire");

// echo '<pre>';
// print_r($gestion_commentaire);
// echo '</pre>';

include('../inc/header.inc.php');
include('../inc/nav.inc.php');

$contenu ='';
$contenu .= 'Nombre de résultats : '.$resultat -> rowCount(). '<br><hr>';

$contenu .= '<div class="container">';
$contenu .= '<table class="table table-bordered">'; // création du tableau HTML
$contenu .= '<tr>'; // création de la ligne de titre

    for($i = 0; $i < $resultat -> columnCount(); $i++){
        $colonne = $resultat -> getColumnMeta($i);
             if($colonne['name'] != 'mdp')
               {
                  $contenu .= '<th>'. $colonne['name'] . '</th>';
               }
    }
    $contenu .= '<th colspan="3">Actions</th>';
    $contenu .= '</tr>';

    while($gestion_commentaire = $resultat -> fetch(PDO::FETCH_ASSOC)){
        $contenu .= '<tr>';
        foreach($gestion_commentaire as $indices => $informations){
            if($indices != 'mdp'){
                $contenu .= '<td>' . $informations . '</td>';
            }
        }

    $contenu .= '<td class = "modif"><a href="modif_membres.php"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></button></a></td>';

    $contenu .= '<td class = "modif"><a href="modif_membres.php"><button type="button" class="btn btn-info"><span class="glyphicon glyphicon-user" aria-hidden="true"></button></a></td>';

    $contenu .= '<td class="supr"><a href="gestion_membres.php"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a></td>';

    $contenu .= '</tr>';
    }


    $contenu .= '<table/>';
    $contenu .= '</div>';
?>

<h1>Gestion des commentaires</h1>

<?php echo $contenu; ?>



        <!-- Contenu de la page -->

<?php include('../inc/footer.inc.php'); ?>
