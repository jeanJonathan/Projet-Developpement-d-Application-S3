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
    Votre pseudo:<input type="text" name="pseudo" class="input">
    </br>
    Nombre de joueur<input type="number" name="nbJoueur" class="input" min="2" max="4">
    </br>
    <input type="submit" name="envoie">
</form>