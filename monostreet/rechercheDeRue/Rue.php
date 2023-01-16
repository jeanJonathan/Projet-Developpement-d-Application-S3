<?php

include("Coordonnees.php");

class Rue
{
    private $_nomRue;
    private $_coordonnees;

    function __construct($nom, $coord)
    {
        $this->_nomRue = $nom;
        $this->_coordonnees = $coord;
    }

    public function getNomRue()
    {
        return $this->_nomRue;
    }

    public function getCoordonnees()
    {
        return $this->_coordonnees;
    }

    public function setNomRue($nom = "")
    {
        if ($nom == "")
        {
            return $this->_nomRue;
        }

        $this->_nomRue = $nom;
    }

    public function setCoordonnees($coord = "")
    {
        if ($coord == "")
        {
            return $this->_coordonnees;
        }    

        $this->_coordonnees = $coord;
    }

    public function afficherRue()
    {
        echo $this->_nomRue."(".$this->_coordonnees->getLatitude().";".$this->_coordonnees->getLongitude().")"."<br/>";
    }
}

?>