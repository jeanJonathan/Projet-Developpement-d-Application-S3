<?php
include("rechercheDeRue/main.php");

session_start();
trouverParcours($_SESSION['rueDeDepart']);
?>