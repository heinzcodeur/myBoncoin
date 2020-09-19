<?php
require_once __DIR__.'/db.php';

function findAll() {
    global $db;
    /*$sql = "SELECT a.*, c.libelle_categorie FROM annonce a
            inner join categorie c on a.id_categorie = c.id_categorie";*/

    $sql = "SELECT a.*, c.libelle_categorie FROM annonce a inner join categorie 
    c on a.id_categorie = c.id_categorie ORDER BY a.date_publication DESC";

   return execute($db,$sql);

}

function annoncePagination($depart,$pageCourante){
    global $db;
    $query = "SELECT * FROM annonce ORDER BY date_publication DESC LIMIT $depart,$pageCourante";
    //die($query);
    return execute($db,$query);
}

function findingAnnonces($filtre="", $mark="", $tri="",
                          $page=1, $filtrepagi="",$tri2=""){
    //print_r($tri);die('rt');
    $annonceParpage=4;
    if($filtre & $tri){
        //die('rtyui');
        if($filtre==2 && $mark){
            //die($mark);// die('ry');
            $tab = [];
            $annonce1 = findformark($mark);
            $tab['nblignes'] = mysqli_num_rows($annonce1);
            $starter=paginer($page,$tab['nblignes']);//print_r($starter);die();
            $depart=($starter-1)*$annonceParpage;print_r($depart);
            $annoncesparpage = findfiltre($filtre,$depart,$annonceParpage,
                $tri,$mark);

            $tab['req'] = $annoncesparpage;
            return $tab;
        }
        $tab = [];
        $annonce1=findbyCategory($filtre);
        $tab['nblignes'] = mysqli_num_rows($annonce1);
        $starter=paginer($page,$tab['nblignes']);//print_r($starter);die();
        $depart=($starter-1)*$annonceParpage;//print_r($depart);//die();
        $annoncesparpage = findfiltre($filtre,$depart,$annonceParpage,$tri);
        //echo '<pre>'.print_r($annoncesparpage).'</pre>';die();

        //$nb_page = ceil($nb_annonces2/$annonceParpage);
        $tab['req']= $annoncesparpage;
        return $tab;
    }
    else if($filtrepagi){
        //print_r($tri2);die('titi');
        $tab =[];
        $annoncesparpagesss = findbyCategory($filtrepagi);
        $tab['nblignes'] = mysqli_num_rows($annoncesparpagesss);
        $starter=paginer($page,$tab['nblignes']);//print_r($starter);die();
        $depart=($starter-1)*$annonceParpage;//print_r($depart);die();
        //$nb_annonces2 = $annoncesparpagesss->num_rows;
        $annoncesparpage = findfiltre($filtrepagi, $depart,$annonceParpage,
            $tri2);
        //$nb_page = ceil($nb_annonces2/$annonceParpage);
        $tab['req']= $annoncesparpage;
        return $tab;
    }//die('kk');
    else if($tri){
        die('ichi');
        $annoncesparpage = findtri2($tri);
        //$nb_annonces2 = $nb_annonces;
        //$nb_page = ceil($nb_annonces2/$annonceParpage);
        return $annoncesparpage;
    }
    else{
        $tab = [];
        $annonce1=findAll();

        $tab['nblignes'] = mysqli_num_rows($annonce1);
        $starter=paginer($page,$tab['nblignes']);
        $depart=($starter-1)*$annonceParpage;
        $annoncesparpage =annoncePagination($depart, $annonceParpage);
        //annoncePagination($depart, $annonceParpage);
        /*print_r($annoncesparpage);die();
                $nb_annonces2 = $nb_annonces;
                $nb_page = ceil($nb_annonces2/$annonceParpage);*/
        $tab['req']= $annoncesparpage;
      //  echo '<pre>';print_r($tab);echo '</pre>';die();
        //return $annoncesparpage;
        return $tab;
    }
}

function paginer($page, $n_page){
    //die('tyjkl');
    if(isset($page) AND !empty($page) AND $page> 0 AND
        $page <= $n_page) {
        $page = intval($page);
        $pageCourante = $page;
    } else {
        //die('la');
        $pageCourante = 1;
    }
    return $pageCourante;
}

function markform(){
    return "";
}

function findfiltre($filtre,$depart,$fin,$tri="",$marc=false){
    print_r($tri);
    //die('lala');
    global $db;
    if($filtre!=1) {
        if($marc) {
//            die($marc);
            $tri=($tri=='defaut')?"":$tri;
            $sql = "SELECT * FROM ( SELECT a.*, c.libelle_categorie FROM annonce a inner join
    categorie c on a.id_categorie = c.id_categorie where c.id_categorie = $filtre AND a.titre LIKE '%$marc%' ORDER BY a.date_publication DESC) AS sr ORDER by sr.prix $tri";
            //die($sql);
            return execute($db,$sql);
        }//die('toto');
        $sql = "SELECT * FROM ( SELECT a.*, c.libelle_categorie FROM annonce a inner join
    categorie c on a.id_categorie = c.id_categorie where c.id_categorie = $filtre ORDER BY a.date_publication DESC) AS sr ";

        //die($sql);
        /*else if($marc!="marqueAuto"){

        }*/
        if ($tri != "defaut") {
            $sql .= "ORDER BY sr.prix " . $tri . " LIMIT $depart,$fin";
            //die($sql);
        } else {
            $sql .= " LIMIT $depart,$fin";
        }
        //die($sql);
        return execute($db, $sql);
    }else{
        $sql = "SELECT a.*, c.libelle_categorie FROM annonce a inner join
    categorie c on a.id_categorie = c.id_categorie ";
        if ($tri != "defaut") {
            $sql .= "ORDER BY prix " . $tri . " LIMIT $depart,$fin";
            //die($sql);
        } else {
            $sql .= " LIMIT $depart,$fin";
        }
        //die($sql);
        return execute($db,$sql);
    }
}

function findtri($tri, $depart, $fin){
    global $db;
    $sql = "SELECT * FROM annonce ORDER BY prix $tri";
    //die($sql);
    return execute($db,$sql);
}

function findtri2($tri, $filtre=null,$depart=0,$fin=4){
    //print_r($tri);die();
    $where=isset($filtre)?"where c.id_categorie = $filtre":'';
    $order=($tri==='defaut')?"ORDER BY sr.date_publication
    desc":"ORDER BY sr.prix ". $tri;
    /*if($tri=='defaut'){$order="ORDER BY sr.date_publication desc";
    }else{$order="ORDER BY sr.prix ". $tri;}*/
    //die($order);
    global $db;
    $sql = "SELECT * FROM ( SELECT a.*, c.libelle_categorie FROM annonce a inner join
    categorie c on a.id_categorie = c.id_categorie $where) AS sr $order";
    //die($sql);
    return execute($db,$sql);
}


function findbyCategory($cat){
    global $db;
    if($cat!=1) {
        $sql = "SELECT a.*, c.libelle_categorie FROM annonce a
            inner join categorie c on a.id_categorie = c.id_categorie where c.id_categorie = $cat";
        //die($sql);
        return execute($db, $sql);
    }else{
        $sql = "SELECT a.*, c.libelle_categorie FROM annonce a inner join categorie 
    c on a.id_categorie = c.id_categorie ORDER BY date_publication DESC";        //die($sql);
        return execute($db,$sql);
    }
}

function findbyCategory2($cat, $depart, $fin){
    global $db;
    $sql = "SELECT a.*, c.libelle_categorie FROM annonce a
            inner join categorie c on a.id_categorie = c.id_categorie where c.id_categorie = $cat LIMIT $depart,$fin";
    //die($sql);
    return execute($db, $sql);
}

function findformark($mark){
    global $db;
    $sql="SELECT * FROM annonce WHERE titre LIKE '%$mark%' ORDER BY 
    date_publication";
    return execute($db,$sql);
}

function findbyMark($mark, $tri="", $depart=0, $fin=4){
    global $db;
    if($tri!="defaut"){
    $sql = "SELECT * FROM annonce WHERE titre LIKE '%$mark%' ORDER BY prix $tri LIMIT $depart, $fin";
    }else{
        $sql = "SELECT * FROM annonce WHERE titre LIKE '%$mark%' ORDER BY date_publication LIMIT $depart, $fin";
    }
    die($sql);
    return execute($db,$sql);
}

function findOneAnnonceById($id_annonce) {
    global $db;
    $sql = "SELECT * FROM annonce WHERE id_annonce=$id_annonce";
    return execute($db,$sql);
}

function findOneAnnonceById2($id_annonce) {
    global $db;
    $sql = "SELECT * FROM annonce a JOIN utilisateur u on a.id_utilisateur=u.id_utilisateur WHERE a.id_annonce=$id_annonce
";
    return execute($db,$sql);

}


function findAnnonceByIdUser($id_user){

    global $db;
    $sql = "SELECT a.*, c.libelle_categorie FROM annonce a
            inner join categorie c on a.id_categorie = c.id_categorie
            WHERE a.id_utilisateur = $id_user ORDER BY date_publication DESC";

    return execute($db,$sql);
}

function paginerAnnonceUser($id_user,$depart,$fin){
    global $db;
    $tab=[];
    $nb_annonceUser=mysqli_num_rows(findAnnonceByIdUser($id_user));
    $tab['nbannonceuser']=$nb_annonceUser;
}

