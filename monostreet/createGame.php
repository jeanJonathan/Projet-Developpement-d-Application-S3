<?php
/**
 * @file CreateGame.php 
 * @brief fichier de parametrage de la partie 
 * @autor Guillaume Arricastre
 * version 
 * date 
 * 
 * */
include("rechercheDeRue/main.php");

session_start();
if (!isset($_SESSION['pseudo'])) {
    header("Location: connexion.php");
}



$lesRues = listeDeRues1("rechercheDeRue/Oloron80.csv");
$listeParNom = [];
foreach ($lesRues as $nomDeRues) {
    $listeParNom[] = $nomDeRues[1];
}
    
?>

<form method="POST" action="" text-align="center">
    Nombre de joueur<input type="number" name="nbJoueur" class="input" min="2" max="4">
    </br>
    <select name="laRue" id="rue_select">
    <option value="">Choisissez une rue</option>
    <?php
        foreach ($listeParNom as $nomDeRue) {
            echo "<option value='$nomDeRue'>$nomDeRue</option>";
        }
    ?>
</select>
    <input type="submit" name="envoie" value="Créer la partie">
</form>

<?php

if(isset($_POST['laRue'])){
    $_SESSION['rueDeDepart'] = $_POST['laRue'];
    if (isset($_POST['nbJoueur'])) {
        echo "<meta http-equiv='refresh' content='0; URL=http://lakartxela.iutbayonne.univ-pau.fr/~garricastres/s3/SAE/gitSAE/Projet-Developpement-d-Application-S3/monostreet/jeu.php'>";
    }
}

?>