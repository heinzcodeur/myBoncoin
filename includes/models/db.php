<?php
/**
 * @param mixed $db
 * @param string $sql
 * @return boolean|int
 */
function execute($db,$sql,$count = false) {
    // Récupération de la connexion à la DB existante dans le fichier /includes/db_connect.php
    global $db;

    // Récupérer un résultat ...
    $res_req = mysqli_query($db,$sql) ;
    // Veut-on compter un résultat ?
    if($count == true) {
        $res_req = mysqli_num_rows($res_req);
        //die($res_req);
    }
    return $res_req;
}

/**
 * objectif => sécuriser les données envoyées à la DB
 * @param mixed $datas
 * @return mixed $clean_datas
 */
function clean_datas_sql($datas,$crypt = false) {
    $clean_datas = null;
    global $db;
    // Les données sous forme de tableau ?
    if(is_array($datas)) {
        // Soon...
                foreach($datas as $key => $data) {
                    if($key == "password") {
          $clean_datas[$key] = "'".sha1(mysqli_escape_string($db,$data))."'";
                    }
                    else if(is_numeric($data) || is_int($data)) {
                        $clean_datas[$key] = mysqli_escape_string($db,$data);
                    }
                    else {
           $clean_datas[$key] = "'".mysqli_escape_string($db,$data)."'";
                    }
                }
    }
    else if(is_string($datas) && $crypt == true) {
            // Function échappement de cars.
            $clean_datas = "'".sha1(mysqli_escape_string($db,$datas))."'";
            // Objectif > escape_cars > l'autre devient 'l\'autre'
    }
    else if(is_numeric($datas) || is_int($datas)) {
                $clean_datas = mysqli_escape_string($db,$datas);
    }
    else if(is_string($datas)) {
                $clean_datas = "'".mysqli_escape_string($db,$datas)."'";
    }
    return $clean_datas;
}