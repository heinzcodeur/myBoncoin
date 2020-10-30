<?php
//print_r($_GET);die();
session_start();
//require_once 'includes/check_session.php';
require_once 'header.php';
require_once 'functions.php';
require_once 'db_connect.php';
require_once 'includes/models/annonces.php';
//var _GET
$code_erreur = isset($_GET['error']) ? $_GET['error']: false;
$code_success = isset($_GET['success']) ? $_GET['success']: false;
$id = isset($_GET['id']) ? $_GET['id']: false;
//var _POST
$filtre = isset($_POST['filtres'])?$_POST['filtres']:false;
$tri = isset($_POST['tri'])?$_POST['tri']:false;
$tri2 = isset($_GET['tri'])?$_GET['tri']:$tri;
$filtre2 = isset($_POST['filtre2'])?$_POST['filtre2']:false;
$filtrepagi = isset($_GET['filtre'])?$_GET['filtre']:$filtre;
$mark = isset($_POST['marque'])?$_POST['marque']:false;
$page=isset($_GET['page'])?$_GET['page']:1;

$bill=null;
$pageCourante=null;

$annonces = findAll();
$nb_annonces = $annonces->num_rows;

$annonceParpage=4;

/*
if($filtre){
    //die('titi');
    $annoncesparpagesss = findbyCategory($filtre);
    $nb_annonces2 = $annoncesparpagesss->num_rows;
    //print_r($nb_annonces2);die();
    $annoncesparpage = findfiltre($filtre, $depart,$annonceParpage);
    $nb_page = ceil($nb_annonces2/$annonceParpage);
}

else if($filtrepagi){
    //die('titi');
    $annoncesparpagesss = findbyCategory($filtrepagi);
    $nb_annonces2 = $annoncesparpagesss->num_rows;
    $annoncesparpage = findfiltre($filtrepagi, $depart,$annonceParpage);
    $nb_page = ceil($nb_annonces2/$annonceParpage);
}
else if($mark){
    $annoncesparpage = findbyMark($mark);
    $nb_annonces2 = $annoncesparpage->num_rows;
}
else if($tri){
    $annoncesparpage = findtri($tri,$depart, $annonceParpage);
    $nb_annonces2 = $nb_annonces;
    $nb_page = ceil($nb_annonces2/$annonceParpage);
}
else{
$annoncesparpage = annoncePagination($depart, $annonceParpage);
//print_r($annoncesparpage);die();
    $nb_annonces2 = $nb_annonces;
    $nb_page = ceil($nb_annonces2/$annonceParpage);
}*/
$annoncesfinales = findingAnnonces($filtre,$mark,$tri,
    $_GET['page'],$filtrepagi,$tri2);

$n_page = ceil($annoncesfinales['nblignes']/$annonceParpage);

/*if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND
    $_GET['page'] <= $n_page) {
    //print_r($_GET['page']);
    //die('r');
    $_GET['page'] = intval($_GET['page']);
    $pageCourante = $_GET['page'];
} else {
    //die('la');
    $pageCourante = 1;
}*/

$cat = getCategorie($db);
$trier = getTriage($db);
$markvoiture = getMarqVoiture($db);
?>
<script>
    $(function(){

        /* $('.filtres').hide();
        $('#wrapper').hide();

        $('#huk').click(function(){*/
        $('#annonce').hide();
        <?php if($mark && $filtre==2):?>
        //alert('no brand');
        filterform();
        <?php else:?>
        $('#filtrer').hide();
        <?php endif; ?>

        /*$('.filtres').show();
        $('#wrapper').show(600);
        });

        $('#addCategory').hide(5000);
        */
    });
</script>

<div class="container">

    <div id="annonce">
        <h1>Bienvenue sur notre site d'annonces</h1>
        <h4>découvrez nos dernières annonces!</h4>

        <?php echo displayMessage($code_erreur,$code_success,$id) ?>
        <button id="huk">OK</button>
    </div>

    <script>

        var timeNow = Math.floor((new Date().getTime())/1000);
        document.querySelector('body').addEventListener('click',
            function () {
                timeNow=Math.floor((new Date().getTime())/1000);
            }
        )
        document.querySelector('body').addEventListener('mouseover',
            function () {
                timeNow=Math.floor((new Date().getTime())/1000);
            }
        )
        document.querySelector('body').addEventListener('doubleclick',
            function () {
                timeNow=Math.floor((new Date().getTime())/1000);
            }
        )
        var time2=function(){
            var timeNow2 = Math.floor((new Date().getTime())/1000);
            var time = timeNow2-timeNow;
            if(time<145){
                console.log(time);
            }else{
                window.location='killsession.php';
            }
        }

        setInterval(time2,1000);

        document.querySelector('body').addEventListener('mouseover',function(){

            var arch=document.querySelector('#arch');
            if (arch.style.display === 'block') {
                arch.style.display = 'none';
            }
        })


        function filtrage(){

        document.querySelector('#filtrer').style.display='block';
        }

        function showHint(str) {
            var xhttp;
            if (str.length == 0) {
                document.getElementById("arch").innerHTML = "";
                return;
            }
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("arch").innerHTML = this.responseText;
                    document.getElementById("arch").style.display='block';
                }
            };
            xhttp.open("GET", "js/ajax.php?q="+str, true);
            xhttp.send();
        }

    </script>

    <?php


    ?>
    <div id="intro" style="display: none;">
        <span><?php if($annoncesfinales['nblignes']<=1){
                echo $annoncesfinales['nblignes'].' annonce ';}
            else{
                echo $annoncesfinales['nblignes'].' annonces';
            }
            ?>
            </span><br>
        <div style="display: inline-block" id="search">
            <form method="post" action="index.php" id="lesfiltres">
            <input type="text" id="ajax" onkeyup="showHint(this.value)">
                <label for="filtres" class="filtres">filtres</label>
                <select name="filtres" class="filtres"
                        onchange="this.form.submit()">
                    <?php
                    while($r=mysqli_fetch_assoc($cat)):?>
                        <option value="<?=$r['id_categorie']
                        ?>" <?php if($filtre==$r['id_categorie'] || $filtrepagi==$r['id_categorie']):?> selected <?php
                        endif?>> <?=$r['libelle_categorie']?></option>
                    <?php endwhile; ?>
                </select>
                <!--/form>
                    <form action="index.php" method="post"-->
                <label for="tri">tri par</label>
                <select name="tri" id="tri" onchange="this.form.submit()">
                    <?php
                    while($t=mysqli_fetch_assoc($trier)):?>
                        <option value="<?=$t['libelle_tri']
                        ?>" <?php if($tri==$t['libelle_tri']):?> selected <?php
                        endif?>> <?=$t['libelle']?></option>
                    <?php endwhile; ?>
                    <!--option value="defaut">defaut</option>
                    <option value="asc">prix croissant</option>
                    <option value="desc">prix décroissant</option-->
                </select>
                <div id="arch" style="    /* display: inline-block; */
    width: 20px;
    margin-top: -11px;
    border: 1px solid;
    margin-left: 15px;
    min-width: 151px;
display: none;
position: absolute;
    background: wheat;
">ui</div>
                <?php if($filtre==2):  ?>
                    <h3 onclick="filterform()" style="cursor: pointer">
                        Affiner votre
                            recherche</h3>
                    <!--/form-->
                <?php
                endif?>
                <?php if($filtre==7):  ?>
                    <br><span>Affiner votre
                recherche</span><br>
                    <!--form action="" method="post"-->
                    <label for="type">type</label>
                    <select name="marque_mode" id=""
                            onchange=""  >
                        <option value="">veste</option>
                        <option value="">chaussures</option>
                        <option value="">chemise</option>
                        <option value="">jeans</option>
                    </select>
                <?php endif;?>
            </form>
            <div id="filtrer">
                <label for="marque" name="filtre2">marque</label>
                <select name="marque" id=""
                        onchange="this.form.submit()"  >
                    <?php
                    while($marc=mysqli_fetch_assoc($markvoiture)):?>
                        <option value="<?=$marc['libelle_marque']
                        ?>" <?php if($mark==$marc['libelle_marque']):?>
                            selected<?php endif; ?> >
                            <?=$marc['libelle_marque']?></option>
                    <?php endwhile; ?>

                </select>

                <label for="annee">annee</label>
                <select name="annee" id="">
                    <option value="">de 1920 à 1960</option>
                    <option value="">de 1961 à 1980</option>
                    <option value="">de 1981 à 1990</option>
                    <option value="">de 1991 à 1999</option>
                    <option value="">de 2000 à 2005</option>
                    <option value="">de 2006 à 2010</option>
                    <option value="">de 2011 à 2020</option>
                </select>
                <br>

                <label for="kilometrage">kilometrage</label>
                <select name="kilometrage" id="">
                    <option value="">de 0 à 10000 KM</option>

                </select>

                <label for="energie">energie</label>
                <select name="energie" id="">
                    <option value="diesel">diesel</option>
                    <option value="essence">essence</option>
                </select>
            </div>

        </div>
    </div>
    <div class="wrapper">

        <?php
        while($anonce = mysqli_fetch_assoc($annoncesfinales['req'])) : ?>
            <!--li style="list-style-type: none"-->
        <div style="border: 1px solid;background: chocolate">
            <!--a href="annoncesplus.php?id_annonce=<?= $anonce['id_annonce'];?>"-->
            <a href="annonces/<?= $anonce['id_annonce'];?>">

                    <p style="width: 180px"><?=
                        $anonce['titre']?></p>
                    <p style="width: 115px"><?= $anonce['prix']?></p>
                        <?php if($anonce['url_photo']=='') :?>                 &nbsp;
                        <?php else :?>
                            <img width="175" height="111"
                                 src="uploads/<?=
                                 $anonce['url_photo'] ?>">
                        <?php endif;?>
            </a>
        </div>
            <!--li align="center">
                                    <a href="annoncesplus
                                    .php?id_annonce=<?php echo $anonce['id_annonce'];?>">voir</a></li-->
            <!--/li-->
        <?php endwhile; ?>
        <!--</tbody>
    </table>-->



    </div>
</div>




    


