<?php
require_once('inc/init.inc.php');

// debug($_SESSION);
// echo '<pre>'; print_r($_SESSION); echo '</pre>';
// debug($_SESSION['membre']);

// Traitement pour rediriger l'utilisateur s'il n'est pas connecté
if(!userConnecte()){
    header('location:connexion.php');
}

$page = 'Profil';
extract($_SESSION['membre']);
require_once('inc/header.inc.php');
require_once('inc/nav.inc.php');
?>
<!-- Contenu HTML -->
<h1>Profil</h1>
<div class="profil">
    <p class="profil_bienvenue"> Bienvenue, <?= $pseudo ?></p><br>

    <div class="profil_img">
        <img src="<?= RACINE_SITE ?>img/default.jpg">
    </div>

    <div class="profil_infos">
        <ul>
            <li>Pseudo : <b><?= $pseudo ?></b></li>
            <li>Prénom : <b><?= $prenom ?></b></li>
            <li>Nom : <b><?= $nom ?></b></li>
            <li>Email : <b><?= $email ?></b></li>
            <li>Téléphone : <b><?= $telephone ?></b></li>
        </ul>
    </div>
</div>




<?php
require_once('inc/footer.inc.php');
?>
