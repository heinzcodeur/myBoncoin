<?php
require_once 'db_connect.php';

/**
 * Ecrire un message d'erreur dans la session
 * @param array | string $messages
 * @param string $type
 */
function setFlash($messages, $type ="danger") {
    // Vérifier que le user a une session
    if(isset($_SESSION) == false) {
        // si pas de session, on en démarre une
        session_start();
        $_SESSION['flash'] = array(
            'messages'=>$messages,
            'type'=>$type
        );
    }
}



function getCategorie($db){
    $requi="SELECT * FROM categorie";
    $requise=mysqli_query($db,$requi);
    return $requise;
}
function getTriage($db){
    $requi="SELECT * FROM triage";
    $requise=mysqli_query($db,$requi);
    return $requise;
}

function getMarqVoiture($db){
    $requi="SELECT * FROM markvoiture";
    $requise=mysqli_query($db,$requi);
    return $requise;
}

function checkForm($post){
    $f=array();
    foreach ($post as $item){
        if(empty($item)){
            $f[]=$item;
        }
    }
    return count($f);
}


function getFlash() {
    session_start();
    if(isset($_SESSION['flash'])) {
        echo "<div class='alert alert-danger'>";
        foreach($_SESSION['flash']['messages'] as $message) {
            echo $message.'<br/>';
        }
        echo "</div>";
    }
    // destruction des messages dans la session, dès qu'ils ont été affiché
    unset($_SESSION['flash']);
}


/**
 * Extraire les données d'un formulaire
 * @param array $datas_form > données du formulaire
 * @return array $datas > données nettoyées
 */
function extract_datas_form($datas_form){
    $datas = [];
    foreach($datas_form as $name =>$value) {
        if(!empty($datas_form[$name])) {$datas[$name] = trim($value);
            if($name !="password") {
                $datas[$name] = strtolower(trim($value));
            }
        } else {
            $datas[$name] = NULL;
        }
    }
    // Return des données du formulaire
    return $datas;
}
//
//
//function extract_datas_form($_POST){
//    $datas = [];
//    foreach($_POST as "prenom" =>"marie") {
//        if(!empty($datas_form["prenom"])) {
//            $datas['prenom'] = strtolower(trim("marie"));
//        } else {
//            $datas[$name] = NULL;
//        }
//    }
//    // Return des données du formulaire
//    return $datas;
//}

/**
 * @param $password
 * @return bool $is_valid ?
 */
/*function checkPassword($password) {
    $is_valid = false;
    if(strlen($password) >=7) {
        $is_valid = true;
    }
    return $is_valid;
}

function checkEmail($email) {
    $is_valid = false;
    // Vérif du format d'email
// Methode 1
    $is_valid = filter_var($email, FILTER_VALIDATE_EMAIL);
//    // Methode 2 > utiliser une Expression régulière
//    $is_valid= preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-])+$/",$email);
    // Vérif du service MX du domaine de l'email
//    toto@gmail.com
    $email = explode("@",$email);
    if(count($email) == 2) {
        //    print_r($email);
        //    die();
        $domaine = $email[1];
        if(checkdnsrr($domaine,'MX')) {
            $is_valid = true;
        } else {
            $is_valid = false;
        }
    }
    return $is_valid;
}*/

function displayMessage($code_erreur= false, $code_success = false, $id) {
    if($code_erreur == true) {

        $message = '<div class="alert alert-danger">';
        switch ($code_erreur) {
            case 1:
                $message .='tous les champs sont obligatoires';
                break;
            case 2 :
                $message .="Le mot de passe doit contenir au moins 7 caractères";
                break;
            case 3 :
                $message .="adresse mail invalide";
                break;
            case 4 :
                $message .="Un utilisateur utilise déjà ce login";
                break;
            case 5 :
                $message .="Un utilisateur utilise déjà cette adresse email";
                break;
            case 6 :
                $message .="Impossible de vous identifier";
                break;
            case 7 :
                $message .="le département ne doit contenir que 2 chiffres";
                break;
            case 8:
                $message.="n'écrivez rien dans la barre d'adresse!";
                break;

        }
        $message .='</div>';
    }
    else if($code_success == true) {

        $message = '<div class="alert-success">';
        switch ($code_success) {
            case 1 :
                $message .= 'Inscription réussie!';
                break;
            case 2 :
                $message .= 'L\'annonce '.$id.' a bien été supprimée!';
                break;
            case 3 :
                $message .= 'L\'annonce '.$id.' a bien été modifiée!';
                break;
            case 4 :
                $message .= 'Vos informations ont bien été modifiées!';
                break;
        }
        $message .='</div>';
    }
    else {
        //die('yeezy');
        $message =null;
    }

    return $message;
}


 /* Prise en charge de l'upload d'un fichier et gestion des erreurs
 * @param array $upload_datas
 * @return array
 */
function doUpload($upload_datas) {
    // Initialisation de variables permettant de traiter l'upload
    // En tout fin de script >> contient le res de l'upload + eventuels messages d'erreur
    $infos_upload = array();

    // Par défaut, pas de problème jusqu'à preuve du contraire
    $erreur_upload = false;
    $messages =[];

    // 1> Verif du code erreur de l'upload si !=0
    if($upload_datas['file']['error'] != 0) {
        $erreur_upload = true;
        $messages[] = "Fichier invalide";
    }
    // 2 > Vérif des extensions autorisées
    $extensions_autorisees = $upload_datas['extensions'];
    $extension_fichier = explode('.',$upload_datas['file']['name']);
//    $extension_fichier = explode('.',"toto.bim");
    // Récupérer la dernière valeure d'un tableau
    $extension_fichier = strtolower(end($extension_fichier));
//    echo $extension_fichier;
//    die();
    if(in_array($extension_fichier,$extensions_autorisees) == false) {
        $erreur_upload = true;
        $extensions_autorisees_str = implode(',',$extensions_autorisees);
        $messages[] = "Votre fichier doit être dans le format $extensions_autorisees_str";
    }

    // 3 > Vérif du poid du fichier
    if($upload_datas['file']['size']> $upload_datas['weight']) {
        $erreur_upload = true;
        $weight_mega = substr($upload_datas['weight'],0,1);
        $messages[] = "Votre fichier doit être inférieur à $weight_mega Mo";
    }

    // 4 > Vérif qu'un fichier avec le même nom n'existe pas déjà dans notre repertoire uploads

    $file_name = $upload_datas['file']['name'];
    $file_full_path = '../'.$upload_datas['upload_directory'].'/'.$file_name;
    $directory_upload_path = '../'.$upload_datas['upload_directory'];
    // Si fichier existe déjà
    // Si ../uploads/koala.jpg
    $already_downloaded = false;
    if(file_exists($file_full_path)) {
        // $erreur_upload = true;
        $already_downloaded = true;
        $messages[] = "Votre fichier est déjà téléchargé";
    }
    // Si première fois qu'on upload alors le répertoire n'existe pas, donc on le crée
    else if(is_dir($directory_upload_path) == false) {
        mkdir($directory_upload_path.'/',0777);
    }
    // 5 > Si tout est ok > on déplace le fichier vers notre répertoire final "/uploads"
    if($erreur_upload == false && $already_downloaded == false) {
        $messages['success'] = "fichier téléchargé avec succès";
        move_uploaded_file($upload_datas['file']['tmp_name'],$file_full_path);
    }
    // 6 On passe les vars $erreur_upload et $messages au tableau $info_upload > c'est ce tableau qui est return par la fonction et qui nous donnes les infos sur le déroulé de l'opération
    $infos_upload = array(
        'erreur_upload'=>$erreur_upload,
        'messages'=>$messages
    );
    return $infos_upload;
}

function existMail($mail,$mail2, $exist=false){
if($mail==$mail2){
    $exist=true;
}
return $exist;
}

function titi(){
    return 'toto';
}