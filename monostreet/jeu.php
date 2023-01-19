<?php
include("rechercheDeRue/main.php");

session_start();
?>
<!DOCTYPE html>
<html>
    <style>
        body{
            display: grid;
            padding-left : 6em;
            grid-template-columns: 30% 70%;
        }

        div{
            padding-top : 18em;
        }
    </style>
    <body>
        <?php
        trouverParcours($_SESSION['rueDeDepart']);

        ?>
    </body>
</html>    
