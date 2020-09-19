<?php
// -> 1 Connexion DB
require_once 'db_connect.php';
// -> 2 Récupérer les données du form login
require_once 'functions.php';
require_once 'models/annonces.php';
$datas_form = extract_datas_form($_POST);
// -> 3 Vérifier que tous les champs sont renseignés
        // -> si non, retour au formulaire de login avec msg erreur
if(in_array(NULL,$datas_form)) {
    header('Location: ../includes/connexion.php?error=1');
} else {
// -> 4 Identification & autorisation du user
    $user_tab = [];
    $user = doLogin($datas_form['email'],$datas_form['mdp']);
    if($user = mysqli_fetch_assoc($user)) {
        $user_tab[] = $user;
        $nb_user = count($user_tab);
    } else {
        $nb_user =0;
    }
    // -> Est-il dans la DB > identification
    // Si le comptage de user == 0,
    // alors le user n'existe pas dans la DB donc > impossible de l'identifier
    // -> si utilisateur introuvable dans la db
    // -> retour au formulaire de login avec msg erreur
    if($nb_user == 0 ){
        header('Location: ../includes/connexion.php?error=6');
    }
    else {
        // -> A t'il les droits admin > autorisation
//        print_r($user);
        /*if($user['is_admin'] == 1 && $user['is_actif'] == 1) {
            //   -> si oui, création d'une session et redirection vers la home du backend
            session_start();
            $_SESSION['login'] = $datas_form['login'];
            $_SESSION['is_logged'] = true;
            $_SESSION['is_admin'] = true;*/
            header('Location: ../includes/dashboard.php');
        } /*else {
            //   -> si non, retour au formulaire de login avec msg erreur
            header('Location: ../includes/connexion.php?error=7');
        }*/
   // }
}
?>


