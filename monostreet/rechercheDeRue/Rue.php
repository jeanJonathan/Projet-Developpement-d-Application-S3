<?php
/**
 * @file MonoStreet.php 
 * @brief La page d'acceuil du site MonoStreet
 * @autor Guillaume Arricastre
 * version 
 * date 
 * 
 * */
include("Coordonnees.php");

/**
 * @file MonoStreet.php 
 * @brief La classe Rue implemente les coordornees de chaque rue
 * @autor Guillaume Arricastre
 * version 
 * 
 * */
class Rue
{
    /**
 * 
 * @brief La variable desisgnant le nom des rues 
 * version 
 * 
 * */
    private $_nomRue;
    /**
 * 
 * @brief La variable designant les coordornees de chaque rue 
 * version 
 * 
 * */
    private $_coordonnees;
/**
 * 
 * @brief fonction construction 
 * version 
 * 
 * */
    function __construct($nom, $coord)
    {
        $this->_nomRue = $nom;
        $this->_coordonnees = $coord;
    }
/**
 * 
 * @brief fonction retournant le nom d'une rue 
 * version 
 * 
 * */
    public function getNomRue()
    {
        return $this->_nomRue;
    }
/**
 * 
 * @brief fonction retournant la coordornee d'une rue 
 * version 
 * 
 * */
    public function getCoordonnees()
    {
        return $this->_coordonnees;
    }
/**
 * 
 * @brief fonction metant a jour le nom d'une rue a partir d'un nom entree en parametre
 * version 
 * 
 * */
    public function setNomRue($nom = "")
    {
        if ($nom == "")
        {
            return $this->_nomRue;
        }

        $this->_nomRue = $nom;
    }
/**
 * 
 * @brief fonction mettant a jour la coordornee d'une rue a partir d'une coordornee entree en parametre
 * version 
 * 
 * */
    public function setCoordonnees($coord = "")
    {
        if ($coord == "")
        {
            return $this->_coordonnees;
        }    

        $this->_coordonnees = $coord;
    }
/**
 * 
 * @brief fonction affichant une rue par sa coordornee latitude et longitude 
 * version 
 * 
 * */
    public function afficherRue()
    {
        echo $this->_nomRue."(".$this->_coordonnees->getLatitude().";".$this->_coordonnees->getLongitude().")"."<br/>";
    }
}

?>