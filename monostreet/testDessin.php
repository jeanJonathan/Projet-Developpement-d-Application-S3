<?php
/**
 * @file testDessin.php 
 * @brief de test des dessins simulant le parcours des rues generer a partir du choix de la rue de l'utilisateur
 * @autor Guillaume Arricastre
 * version 
 * date 
 * 
 * */
header ("Content-type: image/png");

/**
 * @brief Variables image de tage 1000*1000 px
 * version 
 * date 
 * 
 * */
$image = imagecreate(1000,1000);
 
//Alouement des variables au beosin des couleurs qu'elle doivent repondrent
$orange = imagecolorallocate($image, 0, 0, 0);

$bleu = imagecolorallocate($image, 0, 0, 255);

$bleuclair = imagecolorallocate($image, 156, 227, 254);

$noir = imagecolorallocate($image, 0, 0, 0);

$blanc = imagecolorallocate($image, 255, 255, 255);

imagestring($image, 4, 35, 15, "Salut les Zéros !", $blanc);

 

imagepng($image);

?>
