<?php

session_start();
?>
<html>
<style>
*{
	padding: 0px;
	margin: 0px;
}

header{
    height : 10em;
}

header>h1{
    padding : 1em;
}

main{
    color: white;
	height: 100vh; /*le header prend 100% de la hauteur (taille verticale) de l'ecran */
	background-image: linear-gradient(to bottom, rgba(40,54,55,0.603),rgba(0,0,128,0.5)),url(affiche2.jpg);
	background-size: cover;
	background-repeat: no-repeat;
	background-position: center center;
	font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
	text-align: center;
    text-size-adjust: 100px;
}

#trait{
    border : solid;
    border-color : red;
}

#CreateGame{
    display: grid;
    grid-template-columns: 1fr 1fr;
    padding-top : 4em;
    padding-bottom : 4em;
}

#JoinPrivate{   
    display: grid;
    grid-template-columns: 1fr 1fr;
}

#CreatePrivateGame{
    border-left : solid;
}

div{
    text-align : center;
}

#JoinPublicGame{
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: auto;
}

/**Bouton**/
button {
	width: 13em;
	height: 40px;
	margin : 10px;
	background-color: rgb(122, 122, 122);
	color: white;
	font-weight: bold;
	border: none;
	border-radius : 10px;
	text-align: center;
	cursor: pointer;
	-webkit-transition: all 0.3s ease-out 0s;
  
  }
  
  /**Bouton selectionné**/
  button:hover {
	background-color: yellow;
	color: black;
  }

  /**Input**/
input {
	width: 10em;
	height: 35px;
	margin : 10px;
	background-color: rgb(193, 192, 192);
	color: white;
	font-weight: bold;
	border: none;
	border-radius : 10px;
	text-align: center;
	cursor: pointer;
	-webkit-transition: all 0.3s ease-out 0s;
  
  }
  
  /**Input selectionné**/
  input:hover {
	background-color: yellow;
	color: black;
  }

  #rue_select{
	width: 12em;
	height: 35px;
	margin : 10px;
	background-color: rgb(193, 192, 192);
	color: white;
	font-weight: bold;
	border: none;
	border-radius : 10px;
	text-align: center;
	cursor: pointer;
	-webkit-transition: all 0.3s ease-out 0s;
  
  }
  
  /**Input selectionné**/
  #rue_select:hover {
	background-color: yellow;
	color: black;
  }


</style>

<?php
include("rechercheDeRue/main.php");
$lesRues = listeDeRues1("rechercheDeRue/Oloron80.csv");
$listeParNom = [];
foreach ($lesRues as $nomDeRues) {
    $listeParNom[] = $nomDeRues[1];
    }
?>


<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>REJOINDRE</title>
</head>
<main>
    <header>
        <h1>MONOSTREET</h1>
        <hr class="trait">
    </header>
    <body>
        <div id="JoinPrivate">
            <div id="Pseudo">
                <p>Pseudo : </p>
                <?php
                    if(!isset($_SESSION['pseudo'])){
                        echo "<form method='post'>
                        <div class='form-group'>
                        <input type='pseudoInv' class='form-control' name='pseudoInv' id='pseudoInv' placeholder='Votre Pseudo'>
                        </div>
                        </form>";
                    }
                    else{
                        echo $_SESSION['pseudo'];
                    }
                ?>
            </div>

            <div id="JoinPrivateGame">
                Code de la partie : 
                <form method="post">
                    <div class="form-group">
                    <input type="text" class="form-control" name="codePartie" id="codePartie" placeholder="Code de la partie">
                    </div>
                    </br>
                    <button type="submit" name="rejoindrePriv">Rejoindre</button>
                </form>
            </div>
        </div>
        
        <div id="CreateGame">
            
            <div id="CreatePublicGame">
                <form method="POST" action="" text-align="center">
                    Nombre de joueur
                        <input type="number" id="leInput" name="nbJoueurPubl" class="input" min="2" max="4">
                    
                    </br>
                    Choix de la rue de départ
                    <select name="laRuePubl" id="rue_select">
                    <option value="">Choisissez une rue</option>
                    <?php
                        foreach ($listeParNom as $nomDeRue) {
                            echo "<option value='$nomDeRue'>$nomDeRue</option>";
                        }
                    ?>
                    </select>
                    </br>
                    <button type="submit" name="envoie">Creer la partie</button>
                </form>
            </div>
            <div id="CreatePrivateGame">
                <form method="POST" action="" text-align="center">
                    Nombre de joueur
                        <input type="number" id="leInput" name="nbJoueurPriv" class="input" min="2" max="4">
                    
                    </br>
                    Choix de la rue de départ
                    <select name="laRuePriv" id="rue_select">
                    <option value="">Choisissez une rue</option>
                    <?php
                        foreach ($listeParNom as $nomDeRue) {
                            echo "<option value='$nomDeRue'>$nomDeRue</option>";
                        }
                    ?>
                    </select>
                    </br>
                    <button type="submit" name="envoie">Creer la partie</button>
                </form>
            </div>
        </div>

        <div id="JoinPublicGame">
            <?php
            $connection = mysqli_connect("lakartxela","garricastres_bd","garricastres_bd","garricastres_bd");
            $query = 'SELECT * FROM Partie';
            $result = $connection->query($query);
            foreach ($result as $row) {
                echo "<section id='$row[idPartie]'>";
                echo "$row[idPartie]"."<br/>";
                echo "$row[codePartie]";
                echo "</section>";
                
            }
            ?>

    </body>

    <?php
        if(isset($_POST['codePartie'])){
            echo "<script type='text/javascript'>document.location.replace('jeu.php?code=$_POST[codePartie]');</script>";
        }


        if(isset($_POST['laRuePriv'])){
            $_SESSION['rueDeDepart'] = $_POST['laRuePriv'];
            if (isset($_POST['nbJoueurPriv'])) {
                echo "<script type='text/javascript'>document.location.replace('createGame.php');</script>";
            }
        }

        if(isset($_POST['laRuePubl'])){
            $_SESSION['rueDeDepart'] = $_POST['laRuePriv'];
            if (isset($_POST['nbJoueurPubl'])) {
                echo "<script type='text/javascript'>document.location.replace('createGame.php');</script>";
            }
        }
    ?>

</main>
</html>

