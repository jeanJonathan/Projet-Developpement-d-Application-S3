<?php
/**
 * @file deconnexion.php 
 * @brief fichier de deconnexion de la partie
 * @autor Guillaume Arricastre
 * version 
 * date 
 * 
 * */
    session_start();

    $_SESSION = array();
    session_destroy();
    header('Location: index.php');
?>