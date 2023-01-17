<?php

include("Coordonnees.php");

/** Classe Rue */
class Rue
{
    /** Attributs définissant une Rue */
    private $_nomRue; // Nom de la Rue
    private $_coordonnees; // Coordonnees de la Rue

    /** Constructeur de Coordonnees */
    function __construct($nom, $coord)
    {
        $this->_nomRue = $nom;
        $this->_coordonnees = $coord;
    }

    /** Getter */
    // Renvoie le nom de la Rue
    public function getNomRue()
    {
        return $this->_nomRue;
    }

    // Renvoie les coordonnees de la Rue
    public function getCoordonnees()
    {
        return $this->_coordonnees;
    }

    /** Setter */
    // Remplace le nom de la Rue par $nom
    public function setNomRue($nom)
    {
        $this->_nomRue = $nom;
    }

    // Remplace les coordonnees de la Rue par $coord
    public function setCoordonnees($coord)
    {
        $this->_coordonnees = $coord;
    }

    // Affiche la Rue de la forme : Nom(Latitude;Longitude)
    public function afficherRue()
    {
        echo $this->_nomRue."(".$this->_coordonnees->getLatitude().";".$this->_coordonnees->getLongitude().")"."<br/>";
    }
}

?>