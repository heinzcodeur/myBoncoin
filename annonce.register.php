<?php
require_once 'check_session.php'; //securise la page
// 1--> Connexion à la DB
require_once 'db_connect.php';
// 2--> Récupérer les données du form
require_once 'functions.php';
require_once 'includes/models/annonces.php';

if(checkForm($_POST)>0){
    header('Location:depoannonce.php?error=1');
    exit();
}

//recuperer les valeurs des champs
$titre = isset($_POST['titre'])?$_POST['titre']:'';
$categorie = isset($_POST['categorie'])?$_POST['categorie']:'';
$prix = isset($_POST['prix'])?$_POST['prix']:'';
$description = isset($_POST['description'])?$_POST['description']:'';
$url_photo = null;
$tmp_file = isset($_FILES['photo']['tmp_name'])?$_FILES['photo']['tmp_name']:'';
$tofname = isset($_FILES['photo']['name'])?$_FILES['photo']['name']:'';

if(is_uploaded_file($tmp_file)){
    //die($tofname);
    move_uploaded_file($tmp_file,'uploads/'.$tofname);
    $url_photo = $_FILES['photo']['name'];

}
//else{die('r');}

//traitement de la photo
/*
if(isset($_FILES['photo']) && $_FILES['photo']['error']==0){
    //ici on a envoyé un fichier et tout s'est bien passé

    //TODO verifier taille et type
    echo '<pre>';
    print_r( $_FILES['photo']);
    echo '</pre>';
    //die();
    //deplacer le fichier du rep temp vers notre rep upload
    move_uploaded_file($_FILES['photo']['tmp_name'],'uploads/'.$_FILES['photo']['name']);
    $url_photo = $_FILES['photo']['name'];

}else{
    //ici soit pas d'image, soit ca a planté
}*/


//escaping de caractere
$titre_esc = mysqli_real_escape_string($db,$titre);
$categorie_esc = mysqli_real_escape_string($db,$categorie);
$prix_esc = mysqli_real_escape_string($db,$prix);
$description_esc = mysqli_real_escape_string($db,$description);

if(isset($url_photo)){
    $url_photo_esc = "'".mysqli_real_escape_string($db,$url_photo)."'";
}else{
    $url_photo_esc = "null";
}

/**//*var_dump($_POST);*/



//requete
$query = "INSERT  INTO annonce(titre,
                               description,
                               url_photo,
                               prix,
                               id_categorie,
                               id_utilisateur,
                               date_publication,
                               active
                               )
                              VALUES 
                              ('$titre_esc',
                              '$description_esc',
                              $url_photo_esc,
                               $prix_esc,
                               $categorie_esc,
                               ".$_SESSION['id_utilisateur'].",
                               now(),
                               1) ";

//print_r($query);die();

//execution requete
$result = mysqli_query($db,$query);

header('Location:index.php');