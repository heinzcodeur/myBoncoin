<?php
// Parmètres de connexion à la DB
define('DB_NAME','annonces');
define('DB_USER','root');
define('DB_PASSWORD','root');
define('DB_HOST','localhost');
// connexion à la DB
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
or die("Error" .mysqli_connect_error($db));

//if($db == true) {
//    echo "connexion DB ok";
//} else {
//    echo "connexion impossible";
//}