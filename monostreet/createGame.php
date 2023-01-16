<?php
session_start();
if (!isset($_SESSION['pseudo'])) {
    header('Location: connexion.php');
}


?>

<form method="POST" action="" text-align="center">
    <input type="text" name="pseudo" class="input" value="Votre Pseudo">
    </br>
    <input type="number" name="nbJoueur" class="input" min="2" max="4">
    </br>
    <input type="text" name="mdp" class="input" value="Mot De Passe de la partie :">
    </br>
    <input type="submit" name="envoie">
</form>