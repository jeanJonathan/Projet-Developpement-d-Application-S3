<?php
session_start();
/**
 * @file connexion.php 
 * @brief Page implementant la connexion des utilisateurs
 * @autor Guillaume Arricastre
 * version 
 * date 
 * 
 * */

$login_valide_admin = "root";
$pwd_valide_admin = "root";


//si le bouton "Connexion" est cliqué
if(isset($_POST['connexion'])){
    // on vérifie que le champ "Pseudo" n'est pas vide
    // empty vérifie à la fois si le champ est vide et si le champ existe belle et bien
    if(empty($_POST['pseudo'])){
        echo "Le champ Pseudo est vide.";
    } else {
        // on vérifie maintenant si le champ "Mot de passe" n'est pas vide"
        if(empty($_POST['mdp'])){
            echo "Le champ Mot de passe est vide.";
        } else {
            
            $Pseudo =($_POST['pseudo']); 
            $MotDePasse =($_POST['mdp']);
            //on se connecte à la base de données:

            //on vérifie que la connexion s'effectue correctement:
            //on fait maintenant la requête dans la base de données pour rechercher si ces données existent et correspondent:
                
                if ($login_valide_admin == $_POST['pseudo'] && $pwd_valide_admin == $_POST['mdp']) {

                 $_SESSION['pseudo'] = $_POST['pseudo'];
                 $_SESSION['mdp'] = $_POST['mdp'];
                 $CONNEXION=true;

              
                header ('location: index.php');
         
                    
            }
            else {
                echo "Mauvais identifiants fournies";
            }
        }
    }
}

?>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="cssGeneral.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CONNEXION</title>
</head>

<header>

<form action="connexion.php" method="post">
        <div class="container">
            <div class="connexion">
                <div class="info-connexion">
                    <h2>Connexion</h2>
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" name="pseudo" id="login" placeholder="Login">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="mdp" id="password" placeholder="Mot de passe">
                        </div>
                        
                        <button type="submit" name="connexion">Connexion</button>

                    </form>
                </div>
            </div>
        </div>
</header>


<?php
$connection = mysqli_connect("lakartxela","garricastres_bd","garricastres_bd","garricastres_bd");
$query = 'SELECT nom FROM compte';
$result = $connection->query($query);
foreach ($result as $row) {
    echo "<section id='$row[idPartie]'>";
    echo "$row[idPartie]"."<br/>";
    echo "$row[codePartie]";
    echo "</section>";
    
}
?>

</html>

