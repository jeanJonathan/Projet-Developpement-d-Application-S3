<?php
/**
 * @file main.php 
 * @brief La fonction principale qui permert de retrouver les 24 rues
 * @autor Guillaume Arricastre
 * version 
 * date 12/01/2023
 * 
 * */
include("Rue.php");

/**$maCoord = new Coordonnees(2,3);

echo $maCoord->getLatitude()."<br/>";

$maRue = new Rue("Pau",$maCoord);

$maRue->afficherRue();**/


/*function read($csv){
    $file = fopen($csv, 'r');
    while (!feof($file) ) {
        $line[] = fgetcsv($file, 1024);
    }
    fclose($file);
    return $line;
}*/
// Définir le chemin d'accès au fichier CSV
$csv = 'Oloron80.csv';



//---------------CREATION DE LA LISTE-----------------

function listeDeRues($nomcsv){

    $lesRues = fopen($nomcsv, 'r');
    while (!feof($lesRues) ) {
        $listeDesRuesBrut[] = fgetcsv($lesRues, 1024);
    }
    fclose($lesRues);
   
    $listeBienIndexee = [];
    for ($i=0; $i < count($listeDesRuesBrut); $i++) {
        if ($listeDesRuesBrut[$i]!="" && count($listeDesRuesBrut[$i])==2) {
            $listeBienIndexee[] = $listeDesRuesBrut[$i][0].";".$listeDesRuesBrut[$i][1];
        }
    }

    $vraiListe = [];
    $mot = "";
    for ($j=0; $j < count($listeBienIndexee); $j++) { 
        $vrailiste[] = [];
        foreach (str_split($listeBienIndexee[$j]) as  $car) {
            if ($car == ";") {
                $vraiListe[$j][] = $mot;
                $mot = "";
            }
            else {
                $mot = $mot.$car;
            }
        }
    }

    $listeFinale = [];
    for ($j=0; $j < count($vrailiste); $j++) { 
        $listeFinale[] = [$vraiListe[$j][9],$vraiListe[$j][7],$vraiListe[$j][3],$vraiListe[$j][10],$vraiListe[$j][11]];
    }

    $listeFinalePointToutes = [];
    for ($i=0; $i < count($listeFinale); $i++) { 
        $listeFinalePointToutes[] = new Rue($listeFinale[$i][0].$listeFinale[$i][1],new Coordonnees(floatval($listeFinale[$i][3]),floatval($listeFinale[$i][4])));
    }

    return $listeFinalePointToutes;

    
}


/**echo '<pre>';
print_r($liste);
echo '</pre>';*/



function ruesPlusProches50($listeDeRues, $laRue){
    $diametre = 0.1;
    $listeDes50Rues = [];

    while (true) {
        foreach ($listeDeRues as $rue) {
            if ($laRue->getCoordonnees()->distance($rue->getCoordonnees())<$diametre){
                $listeDes50Rues[] = $rue;
            }
        }
        echo count($listeDes50Rues);
        if (count($listeDes50Rues)<50) {
            $diametre += 1;
            $listeDes50Rues = [];
        }
        else {
            while (count($listeDes50Rues) != 50) {
                $max = $laRue->getCoordonnees()->distance($listeDes50Rues[0]->getCoordonnees());
                $rueASupprimer = $listeDes50Rues[0];
                foreach ($listeDes50Rues as $rue) {
                    if ($laRue->getCoordonnees()->distance($rue->getCoordonnees())>$max) {
                        $max = $laRue->getCoordonnees()->distance($rue->getCoordonnees());
                        $rueASupprimer = $rue;
                    }
                }
                unset($listeDes50Rues[array_search($rue, $listeDes50Rues)]);

                sort($listeDes50Rues); // Trie un tableau

            }
            break;
        }
    }

    return $listeDes50Rues;
}

/** RECHERCHE DU PARCOURS */
function trouverParcours($rue, $afficher){
    
    
    $listeFinalePointToutes = listeDeRues("Oloron80.csv");

    foreach ($listeFinalePointToutes as $rueElement) {
        if ($rueElement->getCoordonnees() == $rue->getCoordonnees()) {
            unset($listeFinalePointToutes[array_search($rueElement, $listeFinalePointToutes)]);

            sort($listeFinalePointToutes); // Trie un tableau
        }
    }

    $listeFinalePoint = ruesPlusProches50($listeFinalePointToutes, $rue);

    $listeDesLat = [];
    foreach ($listeFinalePoint as $Rue) {
        $listeDesLat[] = $Rue->getCoordonnees()->getLatitude();
    }

    $latMax = max($listeDesLat);
    $latMin = min($listeDesLat);

    $listeDesLong = [];
    foreach ($listeFinalePoint as $Rue) {
        $listeDesLong[] = $Rue->getCoordonnees()->getLongitude();
    }

    $longMax = max($listeDesLong);
    $longMin = min($listeDesLong);

    $listeFin = [];
    for ($i=0; $i < 22; $i++) { 
        $listeFin[] = null;
    }

    $oppose = $listeFinalePoint[0];
    $placeOpp = 0;
    for ($i=0; $i < count($listeFinalePoint); $i++) { 
        if ((abs($listeFinalePoint[$i]->getCoordonnees()->getLatitude() - $rue->getCoordonnees()->getLatitude()))>abs($oppose->getCoordonnees()->getLatitude() - $rue->getCoordonnees()->getLatitude())) {
            $oppose = $listeFinalePoint[$i];
            $placeOpp = $i;
        }
    }

    $listeFinalePoint[$placeOpp] = null;

    //definir Est ou Ouest
    $compteur = 0;
    while ($listeFinalePoint[$compteur] == null) {
        $compteur += 1;
    }
    $est = $listeFinalePoint[$compteur];
    $placeEst = $compteur;

    $ouest = $listeFinalePoint[$compteur];
    $placeOuest = $compteur;

    for ($i=0; $i < count($listeFinalePoint); $i++) { 
        if ($listeFinalePoint[$i] != null) {
            if ($est->getCoordonnees()->getLongitude() < $listeFinalePoint[$i]->getCoordonnees()->getLongitude()) {
                $est = $listeFinalePoint[$i];
                $placeEst = $i;
            }
            if ($ouest->getCoordonnees()->getLongitude() > $listeFinalePoint[$i]->getCoordonnees()->getLongitude()) {
                $ouest = $listeFinalePoint[$i];
                $placeOuest = $i;
            }
        }
    }

    $listeFinalePoint[$placeEst] = null;
    $listeFinalePoint[$placeOuest] = null;

    // Trouver les 18 rues
    //Initialisation
    $depFin = $rue;
    $oppFin = $oppose;
    $estFin = $est;
    $ouestFin = $ouest;

    //Compteur
    $compteur = 0;

    //ajouter rues
    //ajouter 4 premières rues
    //[1,,,,,,7,,,,,12,,,,,18,,,]
    $listeFin[0] = $rue;
    $listeFin[6] = $est;
    $listeFin[11] = $oppose;
    $listeFin[17] = $ouest;

    //ajouter les 14rues suivantes
    while (true) {
        $compteur += 1;

        //definir le plus proche depFin
        // definir rue temp
        for ($i=0; $i < count($listeFinalePoint); $i++) { 
            if ($listeFinalePoint[$i] != null) {
                $rueTemporaire = $listeFinalePoint[$i];
                $place = $i;
                break;
            }
        }

        for ($i=0; $i < count($listeFinalePoint); $i++) { 
            if ($listeFinalePoint[$i] != null) {
                if ($depFin->getCoordonnees()->distance($listeFinalePoint[$i]->getCoordonnees()) < $depFin->getCoordonnees()->distance($rueTemporaire->getCoordonnees())) {
                    $rueTemporaire = $listeFinalePoint[$i];
                    $place = $i;
                }
            }
        }

        $depFin = $rueTemporaire;
        $listeFinalePoint[$place] = null;

        $listeFin[0 + $compteur] = $depFin;


        //definir le plus proche de oppFin
        for ($i=0; $i < count($listeFinalePoint); $i++) { 
            if ($listeFinalePoint[$i] != null) {
                $rueTemporaire = $listeFinalePoint[$i];
                $place = $i;
                break;
            }
        }

        for ($i=0; $i < count($listeFinalePoint); $i++) { 
            if ($listeFinalePoint[$i] != null) {
                if ($oppFin->getCoordonnees()->distance($listeFinalePoint[$i]->getCoordonnees()) < $oppFin->getCoordonnees()->distance($rueTemporaire->getCoordonnees())) {
                    $rueTemporaire = $listeFinalePoint[$i];
                    $place = $i;
                }
            }
        }

        $oppFin = $rueTemporaire;
        $listeFinalePoint[$place] = null;

        $listeFin[11 + $compteur] = $oppFin;


        //fin de boucle
        if ($compteur == 4) {
            break;
        }

        //definir plus proche de ouestFin
        for ($i=0; $i < count($listeFinalePoint); $i++) { 
            if ($listeFinalePoint[$i] != null) {
                $rueTemporaire = $listeFinalePoint[$i];
                $place = $i;
                break;
            }
        }

        for ($i=0; $i < count($listeFinalePoint); $i++) { 
            if ($listeFinalePoint[$i] != null) {
                if ($ouestFin->getCoordonnees()->distance($listeFinalePoint[$i]->getCoordonnees()) < $ouestFin->getCoordonnees()->distance($rueTemporaire->getCoordonnees())) {
                    $rueTemporaire = $listeFinalePoint[$i];
                    $place = $i;
                }
            }
        }

        $ouestFin = $rueTemporaire;
        $listeFinalePoint[$place] = null;

        $listeFin[17 + $compteur] = $ouestFin;

        //definir le plus proche de estFin
        for ($i=0; $i < count($listeFinalePoint); $i++) { 
            if ($listeFinalePoint[$i] != null) {
                $rueTemporaire = $listeFinalePoint[$i];
                $place = $i;
                break;
            }
        }

        for ($i=0; $i < count($listeFinalePoint); $i++) { 
            if ($listeFinalePoint[$i] != null) {
                if ($estFin->getCoordonnees()->distance($listeFinalePoint[$i]->getCoordonnees()) < $estFin->getCoordonnees()->distance($rueTemporaire->getCoordonnees())) {
                    $rueTemporaire = $listeFinalePoint[$i];
                    $place = $i;
                }
            }
        }

        $estFin = $rueTemporaire;
        $listeFinalePoint[$place] = null;

        $listeFin[6 + $compteur] = $estFin;
    }

    //PAUSE

    //determiner les coordonnees moyennes
    $depFinEst = $depFin->getCoordonnees()->pointMoyen($est->getCoordonnees());
    $estFinOpp = $estFin->getCoordonnees()->pointMoyen($oppose->getCoordonnees());
    $oppFinOuest = $oppFin->getCoordonnees()->pointMoyen($ouest->getCoordonnees());
    $ouestFinDep = $ouestFin->getCoordonnees()->pointMoyen($rue->getCoordonnees());

    //trouver les points moyens
    //depFinEst
    for ($i=0; $i < count($listeFinalePoint); $i++) { 
        if ($listeFinalePoint[$i] != null) {
            $rueTemporaire = $listeFinalePoint[$i];
            break;
        }
    }

    for ($i=0; $i < count($listeFinalePoint); $i++) { 
        if ($listeFinalePoint[$i] != null) {
            if ($depFinEst->distance($listeFinalePoint[$i]->getCoordonnees()) < $depFinEst->distance($rueTemporaire->getCoordonnees())) {
                $rueTemporaire = $listeFinalePoint[$i];
                $place = $i;
            }
        }
    }
    $depFinEstDeb = $rueTemporaire;
    $listeFinalePoint[$place] = null;

    $listeFin[5] = $depFinEstDeb;

    //estFinOpp
    for ($i=0; $i < count($listeFinalePoint); $i++) { 
        if ($listeFinalePoint[$i] != null) {
            $rueTemporaire = $listeFinalePoint[$i];
            break;
        }
    }

    for ($i=0; $i < count($listeFinalePoint); $i++) { 
        if ($listeFinalePoint[$i] != null) {
            if ($estFinOpp->distance($listeFinalePoint[$i]->getCoordonnees()) < $estFinOpp->distance($rueTemporaire->getCoordonnees())) {
                $rueTemporaire = $listeFinalePoint[$i];
                $place = $i;
            }
        }
    }
    $estFinOppDeb = $rueTemporaire;
    $listeFinalePoint[$place] = null;

    $listeFin[10] = $estFinOppDeb;

    //oppFinOuest
    for ($i=0; $i < count($listeFinalePoint); $i++) { 
        if ($listeFinalePoint[$i] != null) {
            $rueTemporaire = $listeFinalePoint[$i];
            break;
        }
    }

    for ($i=0; $i < count($listeFinalePoint); $i++) { 
        if ($listeFinalePoint[$i] != null) {
            if ($oppFinOuest->distance($listeFinalePoint[$i]->getCoordonnees()) < $oppFinOuest->distance($rueTemporaire->getCoordonnees())) {
                $rueTemporaire = $listeFinalePoint[$i];
                $place = $i;
            }
        }
    }
    $oppFinOuestDeb = $rueTemporaire;
    $listeFinalePoint[$place] = null;

    $listeFin[16] = $oppFinOuestDeb;

    //ouestFinDep
    for ($i=0; $i < count($listeFinalePoint); $i++) { 
        if ($listeFinalePoint[$i] != null) {
            $rueTemporaire = $listeFinalePoint[$i];
            break;
        }
    }

    for ($i=0; $i < count($listeFinalePoint); $i++) { 
        if ($listeFinalePoint[$i] != null) {
            if ($ouestFinDep->distance($listeFinalePoint[$i]->getCoordonnees()) < $ouestFinDep->distance($rueTemporaire->getCoordonnees())) {
                $rueTemporaire = $listeFinalePoint[$i];
                $place = $i;
            }
        }
    }
    $ouestFinDepDeb = $rueTemporaire;
    $listeFinalePoint[$place] = null;

    $listeFin[21] = $ouestFinDepDeb;



    //affichage final
    for ($i=0; $i < count($listeFin); $i++) { 
        if ($listeFin[$i] != null) {
            $listeFin[$i]->afficherRue();
        }
        else {
            echo "None";
        }
    }


}

//$rue = new Rue ("Rue des chemins de Compostelles", new Coordonnees (43.1783052, -0.6171157));
//$afficher = true;
//$bien = trouverParcours($rue, $afficher);

/**echo '<pre>';
print_r($bien);
echo '</pre>';**/



?>