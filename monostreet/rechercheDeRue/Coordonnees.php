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
    private $_latitude;
    private $_longitude;

    function __construct($lat, $long)
    {
        $this->_latitude = $lat;
        $this->_longitude = $long;
    }

    public function getLatitude()
    {
        return $this->_latitude;
    }

    public function getLongitude()
    {
        return $this->_longitude;
    }

    public function setLatitude($lat = "")
    {
        if ($lat == "")
        {
            return $this->latitude;
        }

        $this->_latitude = $lat;
    }

    public function setLongitude($long = "")
    {
        if ($long == "")
        {
            return $this->_longitude;
        }    

        $this->_longitude = $long;
    }

    public function afficherCoordonnees()
    {
        echo $this->_latitude.";".$this->_longitude;
    }

    public function distance($point)
    {
        return (($this->_latitude - $point->_latitude)**2 + ($this->_longitude - $point->_longitude)**2)**0.5;
    }

    public function pointMoyen($point)
    {
        return new Coordonnees(($this->_latitude + $point->_latitude)/2,($this->_longitude + $point->_longitude)/2);
    }
}

?>