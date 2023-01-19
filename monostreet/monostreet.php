<?php
/**
 * @file MonoStreet.php 
 * @brief La page d'acceuil du site MonoStreet
 * @autor Guillaume Arricastre, KOFFI jean-jonathan
 * version 
 * date 12/01/2023
 * 
 * */
session_start();
?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="StyleIndex.css">
	<title>MONOSTREET</title>
</head>
<body>
	<div class="container">
		<header class="header">
		<img src="logo.png"width=45% height=95%>
		<span class="header-logo-text"><a href="#" rel="home">MONOSTREET</a></span>
		<?php
                if(!isset($_SESSION['pseudo'])){
                    echo "<a href='connexion.php?'><button>Se connecter</button></a>";
                }
                else{
					echo "<a href='renvoie.php'><button>Mon Compte</button></a>";
                }
            ?>
</div>
            
		</header>
		<main class="main">
			<article class="content">
				<div class="content-inner">
					<p><strong>MONOSTREET</strong> est un jeu de société où les joueurs doivent acquérir la concurrence des propriétés des rues associées aux adresses réelles jusqu'à obtenir le monopole. <strong>Au travers de cette page web</strong>, vous visualisez le cycle de déroulement de la sélection aléatoire de rues à partir d'une rue entrée par un joueur.</p>
					<strong>Alors ?</strong>
					<h2 class="content-heading">Desirez vous voir ce déroulement ?</h2>
					<p><img decoding="async" class="content-image" alt="" width="700" height="456" srcset="header.png" ></p>
					<a href='createGame.php?'><button id = "jouer">Creer une Partie !</button></a>
					<a href='joinGame.php?'><button id = "jouer">Rejoindre une Partie !</button></a>
					<hr>
					<p><strong>Comme tout autre jeu de société</strong>, Monostreet n&#8217;a jamais été aussi simple ! Si jouer au monopoly en ligne avec d&#8217;autres internautes gratuitement vous intéresse, vous aurez bientot la possibilite de jouer la version complete de notre jeu. Vous pouvez <a href="#" class="content-link">consulter les règles de notre jeu </a> pour jouer dans les règles de l’art ;).</p>
				</div>
			</article>
		</main>
		<footer class="footer">
			<div class="footer-inner">
				<div class="footer-section">
					<div class="footer-section-inner">
						<div id="footer-about" class="footer-section-item">
							<h4 class="footer-section-heading">A propos</h4>
						<div class="footer-section-content">
							<p>Monostreet est un jeu conçue dans le cadre d'un projet universitaire. Nous envisageons d'améliorer ce jeu dans le semestres suivant pour permettre aux utilisateurs de s'épanouir gratuitement.</p>
						</div>
					</div>
				</div>
			</div>
			</div>
		</footer>
	</div>
</body>