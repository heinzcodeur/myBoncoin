<?php

require_once 'header.php';
//die('titi');
require_once 'db_connect.php';
require_once 'functions.php';
session_start();
$code_erreur = isset($_GET['error']) ? $_GET['error']: false;
$code_success = isset($_GET['success']) ? $_GET['success']: false;
$id=null;
$id=$_SESSION['id_utilisateur'];
//print_r($_POST);die();

if (!empty($_POST)) {
    //echo 'vide';
    $f = array();
    foreach ($_POST as $item) {
        if (empty($item)) {
            $f[] = $item;
        }
    }

    if (count($f) > 0) {
        //die('toto');
        header('Location:moncompte.php?error=1&dpt=' . $dpt_esc . '&nom='
            . $nom_esc . '&pre=' . $prenom_esc . '&email=' . $email_esc . '&mdp=' . $mdp_esc);
        exit();
    }

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

        //print_r($email_esc);
        //die();


        $queryMail = "SELECT * FROM utilisateur WHERE email='$email_esc'";
//$req = $DB->query("SELECT * FROM utilisateur WHERE email='$email_esc'");
//print_r($queryMail);
        $result3 = mysqli_query($db, $queryMail);

//echo $req->rowCount();die('rty');

        if(!ctype_digit($dpt_esc)){
            //|| count($dpt_esc)>2 || count($dpt_esc)<2){
            header('Location:moncompte.php?error=7&dpt=' . $dpt_esc . '&nom='
                . $nom_esc . '&pre=' . $prenom_esc . '&email=' . $email_esc . '&mdp=' . $mdp);
            exit();

        }

        else if (!preg_match("/^['a-zA-Z0-9_']+@['a-z0-9\.']+\.['a-z']{2,6}$/",
            $email_esc)) {
            //die('ok');
            header('Location:moncompte.php?error=3&dpt=' . $dpt_esc . '&nom='
                . $nom_esc . '&pre=' . $prenom_esc . '&email=' . $email_esc . '&mdp=' . $mdp);
            exit();
        }

         else if (mysqli_num_rows($result3) > 0) {
            //die('ici');
            header('Location:moncompte.php?error=5&dpt=' . $dpt_esc . '&nom='
                . $nom_esc . '&pre=' . $prenom_esc . '&email=' . $email_esc . '&mdp=' . $mdp);
            exit();
        }

//echo strlen($mdp_esc).'ok';
        else if (strlen($mdp_esc) < 7) {
            //die('ok');
            header('Location:moncompte.php?error=2&dpt=' . $dpt_esc . '&nom='
                . $nom_esc . '&pre=' . $prenom_esc . '&email=' . $email_esc . '&mdp=' . $mdp);
            exit();
        }

        $update_query="UPDATE utilisateur set nom='$nom_esc', prenom='$prenom_esc', departement=$dpt_esc, mdp='$mdp_esc', email='$email_esc' WHERE id_utilisateur = $id";

        //print_r($update_query);die();
        mysqli_query($db, $update_query);

        #$check_query = "SELECT * FROM utilisateur WHERE email='$email_esc'";
        #$check_query2 = mysqli_query($db,$check_query);

    $queryMail2 = "SELECT * FROM utilisateur WHERE email='$email_esc'";
    //print_r($email_esc);//die('ty');
    $res=mysqli_query($db,$queryMail2);
    $res2=mysqli_fetch_assoc($res);//die();

    #print_r($res2   );die();
    if($res->num_rows==1){
        $_SESSION['nom']=$res2['nom'];
        $_SESSION['prenom']=$res2['prenom'];
        $_SESSION['email']=$res2['email'];
        $_SESSION['mdp']=$res2['mdp'];
        $_SESSION['dept']=$res2['departement'];
    }
    //$res2=mysqli_fetch_assoc($res);

    #echo '<br>';die('ok');
    //print_r(mysqli_fetch_assoc($res));die('ok');
    print_r($res2['email']);//die('ret');



        header('Location:moncompte.php?success=4'); exit();





}

//die('titi');

?>

<div class="container">

    <?php echo displayMessage($code_erreur,$code_success,$id) ?>

    <?= strtoupper($_SESSION['nom']).' '.ucfirst($_SESSION['prenom']);?>
    <?php

    ?>

    <form method="post" action="">

        <label>Nom:</label>
        <input type="text" <?php if($code_erreur==1):?>
            style="border: 1px solid red"
        <?php endif; ?>
               name="nom" value="<?=$_SESSION['nom']?>"><br/>
        <label>Prénom:</label>
        <input type="text" <?php if($code_erreur==1):?>
            style="border: 1px solid red"
        <?php endif; ?>
               name="prenom" value="<?=$_SESSION['prenom']?>"><br/>
        <label>Département</label>
        <input <?php if($code_erreur==1):?>
            style="border: 1px solid red"
        <?php endif; ?>
            type="text" name="dpt" value="<?=$_SESSION['dept']?>"><br/>
        <label>Email:</label>

        <input <?php if(($code_erreur==3)||($code_erreur==1)||
            ($code_erreur==5)):?>
            style="border: 1px solid red"
        <?php endif; ?>     type="text" name="email"
                            value="<?=$_SESSION['email']?>"><br/>

        <label>Mot de passe:</label>
        <input <?php if(($code_erreur==2)||($code_erreur==1)):?>
            style="border: 1px solid red" value=""<?php endif; ?>
            type="password" name="mdp" value="<?=$_SESSION['mdp']?>"><br/>


        <button>valider</button>



    </form>




</div>

