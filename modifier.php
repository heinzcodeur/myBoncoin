<?php
require_once 'check_session.php';
require_once 'header.php';
require_once 'functions.php';
require_once 'db_connect.php';
require_once 'includes/models/annonces.php';
$code_erreur = isset($_GET['error']) ? $_GET['error']: false;
$code_success = isset($_GET['success'])? $_GET['success']:
        false;
$id_annonce = null;

if(isset($_GET['id_annonce']) && ctype_digit($_GET['id_annonce'])){
    $id_annonce=$_GET['id_annonce'];
    }else{
    header('Location:dashboard.php?error=8');
    exit();
}


$request = "SELECT * FROM annonce WHERE id_annonce=$id_annonce";
$requete = mysqli_query($db,$request);
//echo mysqli_num_rows($requete);die('tm');
//$annonce = findOneAnnonceById($id_annonce);

?>

<!--<h1 style="color:lightblue">Déposez votre annonce</h1>
-->
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            .titi{
                text-align: center;
                margin-left: 1.8%;
                width: 50px;
                background-color: orangered;
                border-radius: 7px;
                border: 1px solid darkorange;
                color: white;
            }
        </style>

    </head>
    <body>



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 well">
            <div class="starter-template">
                <?php //echo displayMessage($code_erreur,$code_success) ?>

                    <?php
                    while($annonce2 = mysqli_fetch_assoc($requete)) : ?>
                        <form action="annonce_update.php"   method="POST"
                              enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="titre">titre de votre annonce</label><br>
                            <input type="text" value="<?=$annonce2[
'titre'] ?>"
                                   id="titre"
                                   name="titre">
                        </div>

                        <div class="form-group">
                            <label for="titre">categorie</label><br>
                            <select class="form-control" name="categorie" >

                                <?php
                                $requi="SELECT * FROM categorie";
                                $requise=mysqli_query($db,$requi);
                                while ($requi2=mysqli_fetch_assoc($requise)):
                                ?>

                                <option value="<?=$requi2['id_categorie'] ?>"
                                        <?php if
                                        ($annonce2['id_categorie']==$requi2['id_categorie']): ?>
                                        selected
                                        <?php endif;?>

                                ><?=$requi2['libelle_categorie'] ?></option>

                                <?php endwhile;?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="prix">prix</label><br>
                            <input type="text" class="form-control" id="prix"
                                   value="<?=$annonce2['prix'] ?>" name="prix">
                        </div>

                        <div style="display: none">
                            <label for="id_annonce">id_ann</label><br>
                            <input type="password" readonly id="prix"
                                   value="<?=$id_annonce ?>" name=id_annonce>
                        </div>


                        <div class="form-group">
                            <label for="description">descriptif</label><br>
                            <textarea class="form-control"
                                      value=""
                                      name="description" rows ="5"><?=$annonce2['description'] ?></textarea>
                        </div>
                            <?php //if($annonce2['url_photo']) :?>
                            <div id="img_annonce" style="display: block">
                                <!--label for="img_modif">cliquer sur l'image
                                pour
                                    modifier
                                    </label--><br>
                                <img width="100" height="50"
                                     src="uploads/<?=$annonce2['url_photo']
                                ?>"
                                     alt="image_annonce">
                                <input type="text" value="<?=$annonce2['url_photo']
                                ?>" name="url_photo" style="display: none">
                            </div>
                            <?php //else: ?>
                            <div>
                                <label for="url_photo">Ajoutez une nouvelle
                                    photo</label>
                                <input type="file" name="photo" id="photo"
                                       value="toto">
                                <p class="help-block">Maxi 2Mo, (jpg,gif,png seulement)</p>
                            </div>

                        <!--div id="img2" class="form-group" style="display:
                        none;">
                            <label for="url_photo">Uploadez une photo</label>
                            <input type="file" name="photo2" id="photo2"
                                   value="toto">
                            <p class="help-block">Maxi 2Mo, (jpg,gif,png seulement)</p>
                        </div-->

                            <?php //endif;?>
                        <input type="submit" class="btn btn-primary pull-right">
                            <input type="reset" value="annuler" onclick="function () {
                              header('Location:dashboard.php');
                            }">

                    </form>
                <?php endwhile ?>
                <button class="titi"
                        onclick="location.href='dashboard.php'" ;
                >revenir</button>

            </div> <!-- /fin starter-template -->
        </div> <!-- /fin col-md-8 col-md-offset-2 well -->
    </div> <!-- / fin row -->



</div>
