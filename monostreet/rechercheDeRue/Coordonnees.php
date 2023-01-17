<?php

/** Classe Coordonnees */
class Coordonnees
{
    /** Attributs définissant une Coordonnee */
    private $_latitude; //latitude de la coordonne
    private $_longitude; // longitude de la coordonnee

    /** Constructeur de Coordonnees */
    function __construct($lat, $long)
    {
        $this->_latitude = $lat;
        $this->_longitude = $long;
    }

    /** Getter */
    //Renvoie la latitude de la coordonnee
    public function getLatitude()
    {
        return $this->_latitude;
    }

    // Renvoie la longitude de la coordonnee
    public function getLongitude()
    {
        return $this->_longitude;
    }

    /** Setter */
    // Remplace la latitude de la coordonnee par $lat
    public function setLatitude($lat)
    {
        $this->_latitude = $lat;
    }

    // Remplace la longitude de la coordonnee par $long
    public function setLongitude($long)
    {
        $this->_longitude = $long;
    }

    // Affiche la coordonnee de la forme : Latitude;Longitude
    public function afficherCoordonnees()
    {
        echo $this->_latitude.";".$this->_longitude;
    }

    // Renvoie la distance entre deux coordonnees
    public function distance($point)
    {
        return (($this->_latitude - $point->_latitude)**2 + ($this->_longitude - $point->_longitude)**2)**0.5;
    }

    // Renvoie une coordonnee contenant les coordonnees du point se situant entre le point "this" et $point
    public function pointMoyen($point)
    {
        return new Coordonnees(($this->_latitude + $point->_latitude)/2,($this->_longitude + $point->_longitude)/2);
    }
}

?>