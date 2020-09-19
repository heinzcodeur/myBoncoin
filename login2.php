<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 31/03/2016
 * Time: 10:42
 */
//recuperer les valeurs des champs
$email = isset($_POST['email'])?$_POST['email']:'';
$mdp = isset($_POST['mdp'])?$_POST['mdp']:'';
//print_r($_POST);

/*$email=$_POST['email'];
$mdp=$_POST['mdp'];

var_dump($_POST);
die();*/

//ouvrir à une connexion à la bdd
require_once "db_connect.php";

//escaping de caractere
$email_esc = mysqli_real_escape_string($db,$email);
$mdp_esc = mysqli_real_escape_string($db,$mdp);

//requete
$query = "SELECT * FROM UTILISATEUR WHERE email='$email_esc' and mdp='$mdp_esc' ";

//execution requete
$result = mysqli_query($db,$query);

//on verifie si on a 1 seul resultat
if(mysqli_num_rows($result)==1){
    //ici c'est ok
    while($val = mysqli_fetch_array($result)){
        $id_utilisateur = $val['id_utilisateur'];
        $nom = $val['nom'];
        $prenom = $val['prenom'];
        $email = $val['email'];
        $is_admin = $val['is_admin'];
        $dept = $val['departement'];
        $mdp = $val['mdp'];
    }

    //on monte des variables en session
    session_start();
    $_SESSION['id_utilisateur'] = $id_utilisateur;
    $_SESSION['nom'] = $nom;
    $_SESSION['prenom'] = $prenom;
    $_SESSION['email'] = $email;
    $_SESSION['is_admin'] = $is_admin;
    $_SESSION['dept'] = $dept;


    // ajoute 15min au timestamp
//    $_SESSION['timer'] = time() + 120;

    //print_r($_SESSION);die();
    //redirection vers dashboard
    header('Location:dashboard.php');
    //die('welcome');
    //die();
}else{
    //ici pas ok
    header('Location: connexion2.php?error=6');
}

