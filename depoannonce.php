<?php
require_once 'header.php';
require_once 'db_connect.php';
require_once 'functions.php';
$code_erreur = isset($_GET['error']) ? $_GET['error']: false;
$code_success = isset($_GET['success']) ? $_GET['success']: false;
$toi=getCategorie($db);
//print_r(mysqli_fetch_assoc($toi));//die('ok');
?>

<!--<h1 style="color:lightblue">Déposez votre annonce</h1>
-->
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <title>Document</title>
        <style>
            .centered{
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
<div class="container ">
<div class="row">
    <!--div class="col-md-8 col-md-offset-1 well"-->
        <div class="col-4 mx-auto ">
            <div class="starter-template">
<?php echo displayMessage($code_erreur,$code_success,$id) ?>
<?php if ($code_success == false) :?>

                <form action="annonce.register.php" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="titre">titre de votre annonce</label>
                        <input type="text" class="form-control" id="titre" name="titre">
                    </div>

                <div class="form-group">
                    <label for="titre">categorie</label>
                    <select class="form-control" name="categorie" >
                        <?php while($val = mysqli_fetch_assoc($toi)) : ?>
                        <option value="<?=$val['id_categorie']?>"
                        ><?=$val['libelle_categorie']?></option>
                        <!--option value="3" >Mobile</option>
                        <option value="1" >Immobilier</option-->
                        <?php endwhile;?>
                    </select>
                </div>


        <div class="form-group">
                        <label for="prix">prix</label>
                        <input type="text" class="form-control" id="prix" name="prix">
                    </div>

                <div class="form-group">
                    <label for="description">descriptif</label>
                    <textarea class="form-control" name="description" rows ="5"></textarea>
                </div>


                    <div class="form-group">
                        <label for="url_photo">Uploadez une photo</label>
                        <input type="file" name="photo" id="photo">
                        <p class="help-block">Maxi 2Mo, (jpg,gif,png seulement)</p>
                    </div>

                <input type="submit" class="btn btn-primary pull-right">
            </form> <?php endif ?>
</div> <!-- /fin starter-template -->
    </div> <!-- /fin col-md-8 col-md-offset-2 well -->
</div> <!-- / fin row -->

</div><!-- /.container -->
<?php// require_once 'views/footer_admin.php'; ?>