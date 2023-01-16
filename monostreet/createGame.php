<?php
/**
 * @file CreateGame.php 
 * @brief fichier de parametrage de la partie 
 * @autor Guillaume Arricastre
 * version 
 * date 
 * 
 * */
session_start();
if (!isset($_SESSION['pseudo'])) {
    header('Location: connexion.php');
}
?>

<form method="POST" action="" text-align="center">
    Nombre de joueur<input type="number" name="nbJoueur" class="input" min="2" max="4">
    </br>
    Votre Rue<input type="text" name="laRue" class="input" placeholder="la rue">
    </br>
    <input type="submit" name="envoie" value="Créer la partie">
</form>

<?php

if(!isset($_POST['laRue'])){
    $_SESSION['rueDeDepart'] = $_POST['laRue'];
    if (!isset($_POST['nbJoueur'])) {
        header('Location : jeu.php');
    }
}


/*nan mais allo quoi*/
?>