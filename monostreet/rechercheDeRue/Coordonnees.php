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
 * @brief retourne la latitude d'une rue 
 * version 
 * 
 * */
    public function getLatitude()
    {
        return $this->_latitude;
    }
/**
 * 
 * @brief retourne la longitude d'une rue  
 * version 
 * 
 * */
    public function getLongitude()
    {
        return $this->_longitude;
    }
/**
 * 
 * @brief Mettant a jour la latitude d'une rue par une latitude entree en parametre
 * version 
 * 
 * */
    public function setLatitude($lat = "")
    {
        if ($lat == "")
        {
            return $this->latitude;
        }

        $this->_latitude = $lat;
    }
/**
 * 
 * @brief Mettant a jour la longitude d'une rue par une longitude entree en parametre
 * version 
 * 
 * */
    public function setLongitude($long = "")
    {
        if ($long == "")
        {
            return $this->_longitude;
        }    

        $this->_longitude = $long;
    }
/**
 * 
 * @brief fonction affichant les coordornees d'une rue 
 * version 
 * 
 * */
    public function afficherCoordonnees()
    {
        echo $this->_latitude.";".$this->_longitude;
    }
/**
 * 
 * @brief fonction definissant la distance a partir d'une rue implementant sa latitude et sa longitude 
 * version 
 * 
 * */
    public function distance($point)
    {
        return (($this->_latitude - $point->_latitude)**2 + ($this->_longitude - $point->_longitude)**2)**0.5;
    }
/**
 * 
 * @brief fontion definisant le point moyen a partir d'un points donnees
 * version 
 * 
 * */
    public function pointMoyen($point)
    {
        return new Coordonnees(($this->_latitude + $point->_latitude)/2,($this->_longitude + $point->_longitude)/2);
    }
}

?>