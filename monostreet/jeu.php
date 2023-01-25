/**
 * @file jeu.php 
 * @brief le fichier du demarrage du deroulement
 * @autor 
 * version 
 * date 
 * 
 * */
<?php
include("rechercheDeRue/main.php");

session_start();
?>
<!DOCTYPE html>
<html>
    <style>
        body{
            display: grid;
            padding-left : 5em;
            grid-template-columns: 26% 74%;
        }

        div{
            padding-top : 12em;
        }
    </style>
    <body>
        <?php
        trouverParcours($_SESSION['rueDeDepart']);

        ?>
    </body>
</html>    
