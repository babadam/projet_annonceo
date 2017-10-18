<?php
require('../inc/init.inc.php');


// Attention à personnaliser pour chaque page

if($_POST){
    $resultat = $pdo -> exec("UPDATE annonce set titre = '$_POST[titre]', description_courte = '$_POST[description_courte]', description_longue = '$_POST[description_longue]', prix = '$_POST[prix]', photo = '$_POST[photo]', pays = '$_POST[pays]', ville = '$_POST[ville]', adresse = '$_POST[adresse]', cp = '$_POST[cp]' WHERE id_annonce = '$_GET[id_annonce]'");


    header('location:' . URL . 'backoffice/gestion_annonces.php');
    $msg .= '<div class="alert alert-success" > L\'annonce a bien été modifié </div>';
}

$resultat = $pdo -> query("SELECT * FROM annonce");

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

    while($gestion_annonce = $resultat -> fetch(PDO::FETCH_ASSOC)){
        $contenu .= '<tr>';
        foreach($gestion_annonce as $indices => $informations){
                $contenu .= '<td>' . $informations . '</td>';
        }

    $contenu .= '<td class = "modif"><a href="?action=modification&id_annonce=' . $gestion_annonce['id_annonce']  . '"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></button></a></td>';

    $contenu .= '<td class = "modif"><a href="modif_membres.php"><button type="button" class="btn btn-info"><span class="glyphicon glyphicon-plus" aria-hidden="true"></button></a></td>';

    $contenu .= '<td class="supr"><a href="supprim_annonces.php?id='. $gestion_annonce['id_annonce'] .'"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a></td>';

    $contenu .= '</tr>';
    }


    $contenu .= '<table/>';
    $contenu .= '</div>';


?>

<h1>Gestion des annonces</h1>



<?php
    echo $contenu;
if(isset($_GET['action']) && $_GET['action'] == 'modification')
{
    if(isset($_GET['id_annonce']))
    {
        $resultat = $pdo->query("SELECT * FROM annonce WHERE id_annonce = '$_GET[id_annonce]'");
        $annonce_actuel = $resultat->fetch(PDO::FETCH_ASSOC);
    }

    $id_annonce = (isset($annonce_actuel)) ? $annonce_actuel['id_annonce'] : '';
    $titre = (isset($annonce_actuel)) ? $annonce_actuel['titre'] : ''; // meme finalité que le if/else du dessus mais de manière simplifiée
    $description_courte = (isset($annonce_actuel)) ? $annonce_actuel['description_courte'] : '';
    $description_longue = (isset($annonce_actuel)) ? $annonce_actuel['description_longue'] : '';
    $prix = (isset($annonce_actuel)) ? $annonce_actuel['prix'] : '';
    $photo = (isset($annonce_actuel)) ? $annonce_actuel['photo'] : '';
    $pays = (isset($annonce_actuel)) ? $annonce_actuel['pays'] : '';
    $ville = (isset($annonce_actuel)) ? $annonce_actuel['ville'] : '';
    $adresse = (isset($annonce_actuel)) ? $annonce_actuel['adresse'] : '';
    $cp = (isset($annonce_actuel)) ? $annonce_actuel['cp'] : '';



?>
<?= $msg ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 order-md-0">
                <form class="form-horizontal" action="" method="post">

                        <input type="hidden" class="form-control" name="id_annonce" id ="id_annonce" value="<?= $id_annonce ?>">


                    <div class="form-group">
                        <label for="titre">Titre </label>
                        <input type="text" class="form-control" name="titre" id ="titre" value="<?= $titre ?>">
                    </div>

                    <div class="form-group">
                        <label for="description_courte">Description courte</label>
                        <input type="text" class="form-control" name="description_courte" id ="description_courte" value="<?= $description_courte ?>">
                    </div>

                    <div class="form-group">
                        <label for="description_longue">Description longue</label>
                        <input type="text" class="form-control" name="description_longue" id ="description_longue" value="<?= $description_longue ?>">
                    </div>

                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" class="form-control" name="prix" id ="prix" value="<?= $prix ?>">
                    </div>
                    <div class="form-group">
                        <label>Photo</label>
    		             <input id="photo" name="photo" type="file" class="file form-control" data-show-preview="false">
    		        </div>
                    <img src="<?= RACINE_SITE ?>photo/<?= $photo ?>" height="100px"/>
                    <input type="hidden" name="photo_actuelle" value="" />
            </div>
            <div class="col-md-6 ">
                <div class="form-group">
                    <label for="pays">Pays</label>
                    <input type="text" class="form-control" name="pays" id ="pays" value="<?= $pays ?>">
                </div>

                <div class="form-group">
                    <label for="ville">Ville</label>
                    <input type="text" class="form-control" name="ville" id ="ville" value="<?= $ville ?>">
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <input type="text" class="form-control" name="adresse" id ="adresse" value="<?= $adresse ?>">
                </div>
                <div class="form-group">
                    <label for="cp">Code postal</label>
                    <input type="text" class="form-control" name="cp" id ="cp" value="<?= $cp ?>">
                </div>


            </div>
            <input type="submit" class="form-control" name=""  value="Modifier">
        </form>
    </div>
<?php
}

 include('../inc/footer.inc.php');
