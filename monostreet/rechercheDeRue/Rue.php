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
/** Getter */
/**
 * 
 * @brief Renvoie le nom de la Rue 
 * version 
 * 
 * */
    public function getNomRue()
    {
        return $this->_nomRue;
    }
/**
 * 
 * @brief Renvoie les coordonnees de la Rue
 * version 
 * 
 * */
    public function getCoordonnees()
    {
        return $this->_coordonnees;
    }
/** Setter */
/**
 * 
 * @brief fonction metant a jour le nom d'une rue a partir d'un nom entree en parametre
 * version 
 * 
 * */
    public function setNomRue($nom)
    {
        $this->_nomRue = $nom;
    }
/**
 * 
 * @brief fonction mettant a jour la coordornee d'une rue a partir d'une coordornee entree en parametre
 * version 
 * 
 * */
    public function setCoordonnees($coord)
    {
        $this->_coordonnees = $coord;
    }
/**
 * 
 * @brief Affiche la Rue de la forme : Nom(Latitude;Longitude)
 * version 
 * 
 * */
    public function afficherRue()
    {
        echo utf8_encode($this->_nomRue);
        echo "(".$this->_coordonnees->getLatitude().";".$this->_coordonnees->getLongitude().")"."<br/>";
    }

/**
 * 
 * @brief Affiche le nom de la Rue
 * version 
 * 
 * */
public function afficheNom()
{
    echo utf8_encode($this->_nomRue);
}
}

?>