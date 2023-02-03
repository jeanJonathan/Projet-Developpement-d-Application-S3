<?php
/**
 * @file CreateGame.php 
 * @brief fichier de parametrage de la partie 
 * @autor Guillaume Arricastre
 * version 
 * date 
 * 
 * */
$connection = mysqli_connect("lakartxela","garricastres_bd","garricastres_bd","garricastres_bd");

$asciiA = 65;
$asciiZ = 90;
$numAscii;
$code = "";

for ($i=0; $i < 4; $i++) { 
    $numAscii = rand($asciiA, $asciiZ);
    $code = $code.chr($numAscii);
}

$sql = "INSERT INTO Partie VALUES ('3', '4', '400', 'bonjour', '4', '$code')";

mysqli_query($connection, $sql);

header("Location: jeu.php?code=$code");


?>