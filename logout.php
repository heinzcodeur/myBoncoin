<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 31/03/2016
 * Time: 11:18
 */
session_start();
//$_SESSION = null;
session_destroy();
//header('Location: connexion.php?error=8');
header('Location: index.php');
die();