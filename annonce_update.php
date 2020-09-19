<?php

require_once 'db_connect.php';

echo '<pre>';
print_r($_FILES);
echo '</pre>';//die();



$titre = isset($_POST['titre'])?$_POST['titre']:'';
$categorie = isset($_POST['categorie'])?$_POST['categorie']:'';
$prix = isset($_POST['prix'])?$_POST['prix']:'';
$description = isset($_POST['description'])?$_POST['description']:'';
$id_annonce = isset($_POST['id_annonce'])?$_POST['id_annonce']:'';
$url_photo = isset($_POST['url_photo'])?$_POST['url_photo']:'';
$tmp_file = isset($_FILES['photo']['tmp_name'])?$_FILES['photo']['tmp_name']:'';
$tofname = isset($_FILES['photo']['name'])?$_FILES['photo']['name']:'';

//die($tofname);
if(is_uploaded_file($tmp_file)){
    move_uploaded_file($tmp_file,'uploads/'.$tofname);
    $url_photo = $_FILES['photo']['name'];

}
//$url_photo = isset($_POST['url_photo'])?$_POST['url_photo']:'';

$titre_esc = mysqli_real_escape_string($db,$titre);
$categorie_esc = mysqli_real_escape_string($db,$categorie);
$prix_esc = mysqli_real_escape_string($db,$prix);
$description_esc = mysqli_real_escape_string($db,$description);
$id_annonce_esc = mysqli_real_escape_string($db,$id_annonce);

$query = "UPDATE annonce SET titre='$titre_esc',
                               description= '$description_esc',
                               prix = '$prix_esc',
                               id_categorie = '$categorie_esc',
                               date_publication = NOW(),
                               url_photo='$url_photo'
                            WHERE id_annonce  = '$id_annonce_esc'";

//print_r($query);die();


//execution requete
$result = mysqli_query($db,$query);

header('Location:index.php?success');
