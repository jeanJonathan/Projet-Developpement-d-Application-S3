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


$query = 'SELECT * FROM CD';
                    $result = $connection->query($query);
                    foreach ($result as $row) {
                        echo "<section id='$row[id]'>";
                        echo "<a href='cdAffiche.php?id=$row[id]'><button type='submit'><img src=".$row['vignette']."></button></a>"."<br/>";
                        echo "$row[titre]"."<br/>";
                        echo "$row[auteur]";
                        echo "</section>";
                    }

$sql = "INSERT INTO Partie VALUES ('1', '4', '400', 'bonjour', '4', '$code')";

//header("Location: jeu.php?code=$code");


?>