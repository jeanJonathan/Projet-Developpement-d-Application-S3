<?php
/**
 * @file CreateGame.php 
 * @brief fichier de parametrage de la partie 
 * @autor Guillaume Arricastre
 * version 
 * date 
 * 
 * */
include("rechercheDeRue/main.php");

session_start();
if (!isset($_SESSION['pseudo'])) {
    header("Location: connexion.php");
}



$lesRues = listeDeRues1("rechercheDeRue/Oloron80.csv");
$listeParNom = [];
foreach ($lesRues as $nomDeRues) {
    $listeParNom[] = $nomDeRues[1];
}
    
?>

<!DOCTYPE html>
<html>
    <style>
        *{
            padding : 0px;
            margin: 0 auto;
            text-align:center;
        }

        h1{
            text-align:center;
            color: black;
        }

        #titre_select{
            text-align: center;
            background-color: black;
            color: white;
            height : 50px;
            width : 12em;
            border-radius: 10px;
            margin : 10px;
            padding : 2px;
        }

        header{
            height: 50vh; /*le header prend 100% de la hauteur (taille verticale) de l'ecran */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            padding: 15px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            text-align: center;
        }

        body>form>input{
            padding : 5px;
            margin : 5px;
        }


        /**Bouton**/
        input {
        width: 10em;
        height: 40px;
        margin : 10px;
        background-color: rgb(122, 122, 122);
        font-weight: bold;
        border: none;
        border-radius : 10px;
        text-align: center;
        cursor: pointer;
        -webkit-transition: all 0.3s ease-out 0s;
        }

        /**Bouton selectionné**/
        input:hover {
        background-color: red;
        }

        #leInput{
            width: 10em;
            height: 20px;
        }
        
    </style>
    <header>
        <h1>Creation de la Partie</h1>
    </header>
    <body>
        <form method="POST" action="" text-align="center">
        Nombre de joueur<input type="number" id="leInput" name="nbJoueur" class="input" min="2" max="4">
        </br>
        <select name="laRue" id="rue_select">
        <option value="">Choisissez une rue</option>
        <?php
            foreach ($listeParNom as $nomDeRue) {
                echo "<option value='$nomDeRue'>$nomDeRue</option>";
            }
        ?>
        </select>
        </br>
        <input type="submit" name="envoie" value="Créer la partie">
        </form>
    </body>

</html>


<?php

if(isset($_POST['laRue'])){
    var_dump($_POST['laRue']); 
    $_SESSION['rueDeDepart'] = $_POST['laRue'];
    if (isset($_POST['nbJoueur'])) {
        echo "<meta http-equiv='refresh' content='0; URL=http://lakartxela.iutbayonne.univ-pau.fr/~garricastres/s3/SAE/gitSAE/Projet-Developpement-d-Application-S3/monostreet/jeu.php'>";
    }
}

?>