<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 01/04/2016
 * Time: 12:10
 */
// Connexion DB
require_once 'check_session.php';
require_once 'db_connect.php';
require_once 'includes/models/annonces.php';
//require_once '../includes/models/user.php';
$id = isset($_GET['id_annonce']) ? $_GET['id_annonce'] : null;
//die($id);
//$user = findOneUserBy("id",$id);
//$user = mysqli_fetch_assoc($user);
deleteAnnonce($id);//die('ert');
/*$img_to_delete = $user['avatar_path'];
unlink('../uploads/'.$img_to_delete);*/
header('Location: dashboard.php?success=2&id='.$id);