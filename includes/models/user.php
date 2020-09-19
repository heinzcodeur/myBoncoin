<?php

require_once __DIR__.'/db.php';


function findUser($email) {
    global $db;
    $sql = "SELECT * FROM utilisateur WHERE email=$email";
    return execute($db,$sql);

}

function findOneUserBy($key,$value) {
    global $db;
    $clean_value = clean_datas_sql($value);
    $sql= "SELECT * FROM utilisateur WHERE $key = $clean_value";
    // SELECT * FROM user WHERE login = 'toto';
    return execute($db,$sql);
}

/**
 * Mettre à jour un utilisateur
 * @param array $datas_form
 * @param $id
 * @return mixed res
 */
function updateUser($datas_form,$id) {
    global $db;
    $clean_values = clean_datas_sql($datas_form);
    $id = clean_datas_sql($id);
//    print_r($clean_values);
//    die();
//    Objectif >> login = 'toto',nom='LE héros'
    $string = null;
    foreach($clean_values as $col => $value) {
        $string .= "$col = $value ,";
    }
//    echo $string;
    $string = rtrim($string,',');
//    die();
    $sql = "UPDATE annonce";
    $sql .=" SET $string";
    $sql .= " WHERE id= $id";
//    echo $sql;
//    die();
    return execute($db,$sql);
}

function deleteAnnonce($id){
    global $db;
    $id = clean_datas_sql($id);
    $sql = "DELETE FROM annonce WHERE id_annonce = $id";
    return execute($db,$sql);
}


function addUser($datas_form) {
    // INSERT INTO user(login,gbf) VALUES ('bibi2000','Moto127');
    $clean_values = clean_datas_sql($datas_form);
//var_dump($clean_values);
//die();
    $values = implode(',',$clean_values);
    echo $values;
//    $keys = "";
//    foreach($datas_form as $k => $v) {
//        $keys.= $k.',';
//    }
//    $keys = rtrim($keys,',');
//    echo $keys;
    $keys  = array_keys($datas_form);
//    print_r($keys);
    $values_keys = implode(',',$keys);
    echo $values_keys;
//    die();
    // Trouver une fonction pour extraire les clés d'un tab assoc.
    // Trouver une fonction pour transformer un tab en chaine.

    /*$sql = " INSERT INTO utilisateur (email, mdp, nom, prenom,
    telephone, departement) VALUES (,$data_form['email'],
    $datas_form['password'], $datas_form['nom'], $datas_form['prenom'],
     $datas_form['telephone'], $datas_form['departement']) ";*/
    global $db;
    //return execute($db,$sql);
}

function doLogin($email,$mdp) {
    global $db;
    $email_clean = clean_datas_sql($email);
    $mdp_clean = clean_datas_sql($mdp,true);
    $sql = "SELECT * FROM utilisateur WHERE email= $email_clean AND password = $mdp_clean";
    /*  echo $sql;*/
    /*  die();*/
    return execute($db,$sql);
}


