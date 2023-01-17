<?php
include("rechercheDeRue/main.php");
//$_SESSION['rueDeDepart'] = new Rue ("Rue des chemins de Compostelles", new Coordonnees (43.1783052, -0.6171157));

session_start();

trouverParcours($_SESSION['rueDeDepart'],true);
?>