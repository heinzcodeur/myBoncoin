<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 31/03/2016
 * Time: 11:14
 */
session_start();
if(!isset($_SESSION['id_utilisateur']) || $_SESSION['id_utilisateur']==""){
    header('Location: connexion2.php');

    die();
}