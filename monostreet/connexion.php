<?php
session_start();
if(isset($_POST['envoie'])){
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){
        $pseudo = $_POST['pseudo'];
        $mdp = $_POST['mdp'];

        //$query = "SELECT * FROM compte WHERE nom ='$pseudo' AND mdp = '$mdp'";
        //$result = $connection->query($query);

        if ($pseudo=="root" && $mdp=="root"){//$result->num_rows > 0) {
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['mdp'] = $mdp;
            //$query = "SELECT id FROM compte WHERE nom ='$pseudo' AND mdp = '$mdp'";
            //$result = $connection->query($query);
            //$_SESSION['id'] = $result;
            header('Location: monostreet.php');
        }
        else{
            echo "Mot de passe ou pseudo incorrect;";
        }
                        
    }
    else{
        echo "Veuillez completer tous les champs ...";
    }
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
        
    </style>
    <header>
        <h1>Page de connexion</h1>
    </header>
    <body>
        <form method="POST" action="" align="center">
            <input type="text" name="pseudo" class="input">
            </br>
            <input type="text" name="mdp" class="input">
            </br>
            <input type="submit" name="envoie">
        </form>
    </body>

</html>