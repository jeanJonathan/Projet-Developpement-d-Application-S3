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

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="cssGeneral.css"> 
    <header>
        <h1>Creation de la Partie</h1>
        <form method="POST" action="" text-align="center">
        Nombre de joueur
            <input type="number" id="leInput" name="nbJoueur" class="input" min="2" max="4">
        
        </br>
        Choix de la rue de départ
        <select name="laRue" id="rue_select">
        <option value="">Choisissez une rue</option>
        <?php
            foreach ($listeParNom as $nomDeRue) {
                echo "<option value='$nomDeRue'>$nomDeRue</option>";
            }
        ?>
        </select>
        </br>
        <button type="submit" name="envoie">Creer la partie</button>
        </form>
    </header>
    <body>
        
    </body>

</html>


<?php

if(isset($_POST['laRue'])){

    $_SESSION['rueDeDepart'] = $_POST['laRue'];
    if (isset($_POST['nbJoueur'])) {
        echo "<script type='text/javascript'>document.location.replace('jeu.php');</script>";
    }
}

?>