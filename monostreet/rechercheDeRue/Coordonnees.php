<?php
/**
 * @file Coordornees.php 
 * @brief Classe Cordornees implementant les differentes coordornees de chaque rue 
 * @autor Guillaume Arricastre
 * version 
 * date 12/01/2023
 * 
 * */
class Coordonnees
{
    /**
 * 
 * @brief variable designant la latitude d'une rue 
 * version 
 * 
 * */
    private $_latitude;
/**
 * 
 * @brief variable designant la longitude d'une rue 
 * version 
 * 
 * */
    private $_longitude;
/**
 * 
 * @brief fonction mettant a jour les coordornees d'une rue par sa lattitude et sa longitude
 * version 
 * 
 * */
    function __construct($lat, $long)
    {
        $this->_latitude = $lat;
        $this->_longitude = $long;
    }
/**
 * 
 * @brief Renvoie la latitude de la coordonnee
 * version 
 * 
 * */
    public function getLatitude()
    {
        return $this->_latitude;
    }
/**
 * 
 * @brief Renvoie la longitude de la coordonnee  
 * version 
 * 
 * */
    public function getLongitude()
    {
        return $this->_longitude;
    }
/** Setter */
/**
 * 
 * @brief Mettant a jour la latitude d'une rue par une latitude entree en parametre
 * version 
 * 
 * */
    public function setLatitude($lat)
    {
        $this->_latitude = $lat;
    }
/**
 * 
 * @brief Mettant a jour la longitude d'une rue par une longitude entree en parametre
 * version 
 * 
 * */
    public function setLongitude($long)
    {
        $this->_longitude = $long;
    }
/**
 * 
 * @brief Affiche la coordonnee de la forme : Latitude;Longitude 
 * version 
 * 
 * */
    public function afficherCoordonnees()
    {
        echo $this->_latitude.";".$this->_longitude;
    }
/**
 * 
 * @brief Renvoie la distance entre deux coordonnees
 * version 
 * 
 * */
    public function distance($point)
    {
        return (($this->_latitude - $point->_latitude)**2 + ($this->_longitude - $point->_longitude)**2)**0.5;
    }
/**
 * 
 * @brief Renvoie une coordonnee contenant les coordonnees du point se situant entre le point "this" et $point
 * version 
 * 
 * */
    public function pointMoyen($point)
    {
        return new Coordonnees(($this->_latitude + $point->_latitude)/2,($this->_longitude + $point->_longitude)/2);
    }
}

?>