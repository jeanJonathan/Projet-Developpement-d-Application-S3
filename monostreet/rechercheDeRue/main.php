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

// Définir le chemin d'accès au fichier CSV
//$csv = 'Oloron80.csv';



//---------------CREATION DE LA LISTE-----------------
/**
 * 
 * @brief La fonction listeDeRues pour lister les rue voisines a partir du nom d'une rue entree en parametre
 * version 
 * 
 * */

/** Fonction qui renvoie une liste de liste contenant les caractéristique de cette liste */
function listeDeRues1($nomcsv){

    // Ouverture de fichier csv et ajout des lignes dans la liste $listeDesRuesBrut
    // $listeDesRuesBrut de la forme : $listeDesRuesBrut[0] = [debutLigne1,finLigne1], $listeDesRuesBrut[1] = [debutLigne2,finLigne2] ...
    $lesRues = fopen($nomcsv, 'r');
    while (!feof($lesRues) ) {
        $listeDesRuesBrut[] = fgetcsv($lesRues, 1024);
    }
    fclose($lesRues);

    // Creation de la liste $listeBienIndexee de la forme : $listeBienIndexee[0] = Ligne1, $listeDesRuesBrut[1] = Ligne2 ...
    $listeBienIndexee = [];
    for ($i=0; $i < count($listeDesRuesBrut); $i++) {
        if ($listeDesRuesBrut[$i]!="" && count($listeDesRuesBrut[$i])==2) {
            $listeBienIndexee[] = $listeDesRuesBrut[$i][0].";".$listeDesRuesBrut[$i][1];
        }
    }

    // Creation de la liste $vraiListe de la forme : $vraiListe[0] = ligne1                         $vraiListe[1] = ligne2                       ...
    //                                                   $vraiListe[0][0] = ligne1/Colonne1             $vraiListe[1][0] = ligne2/Colonne1
    //                                                   $vraiListe[0][1] = ligne1/Colonne2             $vraiListe[1][1] = ligne2/Colonne2
    //                                                   $vraiListe[0][...] = ligne1/Colonne...         $vraiListe[1][...] = ligne2/Colonne...
    //                                                   $vraiListe[0][12] = ligne1/Colonne13           $vraiListe[1][12] = ligne2/Colonne13
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

    // Creation de la liste $listeFinale de la forme : $vraiListe[0] = ligne1                          $vraiListe[1] = ligne2                       ...
    //                                                   $vraiListe[0][0] = ligne1/TypeDeVoie              $vraiListe[1][0] = ligne2/TypeDeVoie
    //                                                   $vraiListe[0][1] = ligne1/NomDeLaVoie             $vraiListe[1][1] = ligne2/NomDeLaVoie
    //                                                   $vraiListe[0][2] = ligne1/Ville                   $vraiListe[1][2] = ligne2/Ville
    //                                                   $vraiListe[0][3] = ligne1/Latitude                $vraiListe[1][3] = ligne2/Latitude
    //                                                   $vraiListe[0][4] = ligne1/Longitude               $vraiListe[1][4] = ligne2/Longitude
    $listeFinale = [];
    for ($j=0; $j < count($vrailiste); $j++) { 
        $listeFinale[] = [$vraiListe[$j][9],$vraiListe[$j][7],$vraiListe[$j][3],$vraiListe[$j][10],$vraiListe[$j][11]];
    }

    $listeFinaleSansApostrophe = enleverApostrophe($listeFinale);
    return $listeFinaleSansApostrophe;
}

/**
 * 
 * @brief Fonction prenant en parametre une liste comprenant les differentes caracteristiques d'une rue et qui renvoie cette meme liste mais en enlever les apostrophes qu'il y a dans les noms des rues
 * version 
 * 
 * */
function enleverApostrophe($listeAvecApostrophe){
    $compteur = 0;
    $listeARenvoyer = $listeAvecApostrophe;
    foreach ($listeAvecApostrophe as $rue) {
        $nouvNom = "";
        for ($i=0; $i < strlen($rue[1]); $i++) { 
            if ($rue[1][$i] == "'") {
                $nouvNom = $nouvNom." ";
            }
            else {
                $nouvNom = $nouvNom.$rue[1][$i];
            }
        }
        $listeARenvoyer[$compteur][1] = $nouvNom;
        $compteur += 1;
    }
    return $listeARenvoyer;
}

/** Fonction qui renvoie une liste de Rue */
function listeDeRues2($nomcsv){
    $listeFinale = listeDeRues1($nomcsv);

    // Creation de la liste $listeFinalePointToutes de la forme : $listeFinalePointToutes[0] = Rue1(typedeVoie + nomDeLaVoie, Coordonnees(Latitude, Longitude))
    //                                                            $listeFinalePointToutes[1] = Rue2(typedeVoie + nomDeLaVoie, Coordonnees(Latitude, Longitude)) ...
    $listeFinalePointToutes = [];
    for ($i=0; $i < count($listeFinale); $i++) { 
        $listeFinalePointToutes[] = new Rue($listeFinale[$i][0].$listeFinale[$i][1],new Coordonnees(floatval($listeFinale[$i][3]),floatval($listeFinale[$i][4])));
    }
    return $listeFinalePointToutes;
}



/**
 * 
 * @brief Fonction qui renvoie un tableau contenant les 50 rues les plus proches de $laRue, qui sont dans la liste $listeDeRues, celon ses coordonnees
 * version 
 * 
 * */
function ruesPlusProches50($listeDeRues, $laRue){
    $diametre = 0.1;
    $listeDes50Rues = [];

    // Tant qu'on a pas trouvé plus de 50 rues
    while (true) {
        // Pour toutes les rues de la liste
        foreach ($listeDeRues as $rue) {
            // si la rue fait parti du diametre autour de $laRue
            if ($laRue->getCoordonnees()->distance($rue->getCoordonnees())<$diametre){
                $listeDes50Rues[] = $rue;
            }
        }
        // Si il y a moins de 50 rues
        if (count($listeDes50Rues)<50) {
            $diametre += 1;
            $listeDes50Rues = [];
        }
        // si il y a plus de 50 rues
        else {
            // tant qu'il n'y a pas axactement 50 rues dans la liste
            while (count($listeDes50Rues) != 50) {
                $max = $laRue->getCoordonnees()->distance($listeDes50Rues[0]->getCoordonnees());
                $rueASupprimer = $listeDes50Rues[0];
                // pour toutes les rues de la liste
                foreach ($listeDes50Rues as $rue) {
                    // si la rue est plus eloignée que la rue $max
                    if ($laRue->getCoordonnees()->distance($rue->getCoordonnees())>$max) {
                        $max = $laRue->getCoordonnees()->distance($rue->getCoordonnees());
                        $rueASupprimer = $rue;
                    }
                }
                // suppression de la rue la plus eloignée
                unset($listeDes50Rues[array_search($rue, $listeDes50Rues)]);

                sort($listeDes50Rues); // Trie un tableau

            }
            break;
        }
    }
    return $listeDes50Rues;
}

/** RECHERCHE DU PARCOURS */
/**
 * 
 * @brief Fonction qui cherche les coordonnees de $rue dans la liste $listeDesRuesPourCoordonnees et qui les renvoie sous forme de Rue
 * version 
 * 
 * */

function rechercheCoordonnees($rue,$listeDesRuesPourCoordonnees){
    foreach ($listeDesRuesPourCoordonnees as $uneRue) {
        if ($rue == $uneRue[1]) {
            $rueARenvoyer = new Rue ($rue, new Coordonnees (floatval($uneRue[3]), floatval($uneRue[4])));
            return $rueARenvoyer;
        }
    }
}


/** --------------------- RECHERCHE DU PARCOURS --------------------- */

/** Fonction qui affiche la liste des 22 rues les plus proches de $laRue afin que cela crée un parcours cyclique et fermé */
function trouverParcours($laRue){
    $listeDesRuesPourCoordonnees = listeDeRues1("rechercheDeRue/Oloron80.csv");

    $listeFinalePointToutes = listeDeRues2("rechercheDeRue/Oloron80.csv");
    // recherche des coordonnees de la rue donnée
    $rue = rechercheCoordonnees($laRue,$listeDesRuesPourCoordonnees);
    foreach ($listeFinalePointToutes as $rueElement) {
        if ($rueElement->getCoordonnees() == $rue->getCoordonnees()) {
            unset($listeFinalePointToutes[array_search($rueElement, $listeFinalePointToutes)]);

            sort($listeFinalePointToutes); // Trie un tableau
        }
    }

    $listeFinalePoint = ruesPlusProches50($listeFinalePointToutes, $rue);

    // Creation de la liste finale contenant les 22 rues
    $listeFin = [];
    for ($i=0; $i < 22; $i++) { 
        $listeFin[] = null;
    }

    // creation de $oppose qui est le point le plus éloigné de $laRue celon la Latitude
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

    // Recherche du point le plus a l'est et du point le plus a l'ouest
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

        // definir le plus proche depFin
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
?>