<?php

//var_dump($_GET);die();

require_once 'header.php';
require_once 'db_connect.php';
require_once 'includes/models/annonces.php';
//recuperer l'id de l'annonce

$dateConsult ="UPDATE annonce SET date_last_consultation=NOW()";
mysqli_query($db,$dateConsult);

$id_annonce = null;

if(isset($_GET['id_annonce']) && ctype_digit($_GET['id_annonce'])){
    $id_annonce=$_GET['id_annonce'];
}else{
    header('Location:index.php?error=8');
    exit();
}

$annonce = mysqli_fetch_assoc(findOneAnnonceById2($id_annonce));
//print_r($annonce);die();
print_r($_SESSION['id_utilisateur']);
//die('cc');
?>

    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <table id="table_dashboard" class="table table-bordered table-responsive table-striped">
                <thead>
                <tr>
                    <th><h1><?= $annonce['titre']?></h1></th>
                </tr>
                </thead>
                <td>
                    <h2 align="right" style="color: red">
                        <?php echo $annonce['prix']?> &euro;</h2>
                </td>
                <tr>
                    <td>
                        <h3>postée il y a
                            <?php
                            $a=time();
                            $b=strtotime($annonce['date_publication']);
                            $c=$a-$b;
                            $tempo=array(
                                        'an'        => 31104000,
                                        'mois'      =>2592000,
                                        'jours'     =>86400,
                                        'heures'    =>3600,
                                        'minutes'   =>60
                                );
                            echo $a.'/'.$b.'/'.$c;
                            //if($c>=60){
                                foreach($tempo as $temps=>$item){
                                //    echo $item.'/';
                                if($c>=$item){
                                    $d=floor($c/$item);
                                    echo $d.' '.$temps;
                                    break;
                                    }
                               }
                           // }else{
                                //echo 'quelques instants';
                                //echo $a.'<br><br>';
                            //}

                            ?>
                        </h3>
                    </td>
                <tr>
                    <td><?=$annonce['nom'].' '.$annonce['prenom']?></td>
                </tr>
                </tr>
                <tr>
                    <td>
                        <img width="400" src="uploads/<?= $annonce['url_photo'] ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                    <?php echo $annonce['description']?>
                    <!--br/><br/-->
                    </td>
                    <?php if($_SESSION['id_utilisateur']==$annonce['id_utilisateur'] || $_SESSION['is_admin']==1):  ?>
                    <td><a href="modifier.php?id_annonce=<?php
                        echo $annonce['id_annonce']?>">modifier
                        cette
                            annonce</a>
                    </td>
                    <?php endif; ?>
                </tr>
                <tr>

                </tr>
            </table>
        </div>
    </div>
    </div>

