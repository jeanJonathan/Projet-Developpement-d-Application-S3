<html>
<style>
*{
	padding: 0px;
	margin: 0px;
}

header{
    height : 10em;
    
}

main{
    color: white;
	height: 100vh; /*le header prend 100% de la hauteur (taille verticale) de l'ecran */
	align-items: left;
	background-image: linear-gradient(to bottom, rgba(40,54,55,0.603),rgba(0,0,128,0.5)),url(affiche2.jpg);
	background-size: cover;
	background-repeat: no-repeat;
	background-position: center center;
	font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
	text-align: center;
    text-size-adjust: 100px;
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


</style>
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>REJOINDRE</title>
</head>
<main>
    <header>

    <form method="post">
                <div class="connexion">
                    <div class="info-connexion">
                        <h2>Rejoindre une partie</h2>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" name="pseudo" id="login" placeholder="Pseudo">
                            </div>
                            <button type="submit" name="envoie">Rejoindre</button>

                        </form>
                    </div>
                </div>
            </div>
    </header>
    <body>
    <form method="post">
        <div class="form-group">
        <input type="password" class="form-control" name="mdp" id="password" placeholder="Code de la partie">
        </div>
    </form>

    </body>

</main>
</html>

