<?php
// 1--> Connexion à la DB
require_once 'db_connect.php';
// 2--> Récupérer les données du form
//require_once 'testpdo.php';
require_once 'functions.php';
require_once 'includes/models/annonces.php';
require_once 'header.php';
//die('bli');
?>

<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
    <head>
        <title>mess_inscription</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="utf-8">
        <script src="js/jquery.js"></script>
        <script src="js/annonces.js"></script>
    </head>
    <body>


<?php


if (empty($_POST)){
    echo 'vide';
}
$f=array();
foreach ($_POST as $item){
    if(empty($item)){
        $f[]=$item;
    }
}
//echo '<pre>';print_r($_POST);echo '</pre>';echo count($f);//die('e');

    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $departement = isset($_POST['dpt']) ? $_POST['dpt'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';

    //var_dump($_POST);die('r');
    //escaping de caractere
    $email_esc = mysqli_real_escape_string($db, $email);
    $mdp_esc = mysqli_real_escape_string($db, $mdp);
    $prenom_esc = mysqli_real_escape_string($db, $prenom);
    $nom_esc = mysqli_real_escape_string($db, $nom);
    $dpt_esc = mysqli_real_escape_string($db, $departement);

    //$p=$_POST;
   // echo '<pre>';print_r($p);'</pre>';//die('ttuyy');

if(count($f)>0){header('Location:inscription.php?error=1&dpt='.$dpt_esc.'&nom='
        .$nom_esc.'&pre='.$prenom_esc.'&email='.$email_esc.'&mdp='.$mdp_esc);
exit();}

if(!preg_match("/^['a-zA-Z0-9_']+@['a-z0-9\.']+\.['a-z']{2,6}$/",
    $_POST['email'])){
    header('Location:inscription.php?error=3&dpt='.$dpt_esc.'&nom='
        .$nom_esc.'&pre='.$prenom_esc.'&email='.$email_esc.'&mdp='.$mdp);exit();
}

$queryMail="SELECT * FROM utilisateur WHERE email='$email_esc'";
//$req = $DB->query("SELECT * FROM utilisateur WHERE email='$email_esc'");

$result3 = mysqli_query($db, $queryMail);

//echo $req->rowCount();die('rty');
if(mysqli_num_rows($result3)>0){
    //die('ici');
        header('Location:inscription.php?error=5&dpt='.$dpt_esc.'&nom='
        .$nom_esc.'&pre='.$prenom_esc.'&email='.$email_esc.'&mdp='.$mdp);exit();
}
//echo strlen($mdp_esc).'ok';
if(strlen($mdp_esc)<7){
    //die('ok');
    header('Location:inscription.php?error=2&dpt='.$dpt_esc.'&nom='
        .$nom_esc.'&pre='.$prenom_esc.'&email='.$email_esc.'&mdp='.$mdp);
    exit();}

//recuperer les valeurs des champs

$query = "INSERT  INTO utilisateur(nom,prenom,departement,email,mdp) VALUES('$nom_esc','$prenom_esc','$dpt_esc','$email_esc','$mdp_esc')";
//execution requete
    $result = mysqli_query($db, $query);
//die('i');

    $q = "SELECT * FROM utilisateur where nom ='$nom_esc'";
    $result2 = mysqli_query($db, $q);

    if(mysqli_num_rows($result2)==1):
        session_start();
    while($a = mysqli_fetch_assoc($result2)) :
    $_SESSION['id_utilisateur'] = $a['id_utilisateur'];
        $_SESSION['nom'] = $a['nom'];
        $_SESSION['prenom'] = $a['prenom'];
        $_SESSION['email'] = $a['email'];
        $_SESSION['mdp'] = $a['mdp'];
        $_SESSION['is_admin'] = $a['is_admin'];
        $_SESSION['dept'] = $a['departement'];
    //die($a['id']);
    endwhile;
    header('Location:dashboard.php?success=1');die();
    else:
        //die('makossa');
        header('Location:inscription.php');exit();
    endif;

function addAnnonce($datas_form)
{
$clean_values = clean_datas_sql($datas_form);
//    print_r($clean_values);
//    die();
$values = implode(',', $clean_values);
    echo $values;
//    $keys = "";
//    foreach($datas_form as $k => $v) {
//        $keys.= $k.',';
//    }
//    $keys = rtrim($keys,',');
//    echo $keys;
$keys = array_keys($datas_form);
//    print_r($keys);
$values_keys = implode(',', $keys);
    echo $values_keys;
//    die();
// Trouver une fonction pour extraire les clés d'un tab assoc.
// Trouver une fonction pour transformer un tab en chaine.
$sql = "INSERT INTO annonce INNER JOIN utilisateur on annonce.id_utilisateur = utilisateur.id_annonce($values_keys) VALUES ($values)";
    global $db;
    return execute($db, $sql);
}

if(mysqli_num_rows($result2)):
?>

<div class="container">
    <h1>Inscription réussie!<?=$_SESSION['id'] ?></h1>

    <h3>Vous pouvez déposez une annonce <a href="connexion.php">ici</a></h3>

</div>
<?php
else:header('Location:inscription.php');
endif;
