<?php

try {
    $DB = new PDO('mysql:host=localhost;dbname=annonces', 'root', 'root') ;
}
catch(PDOException $e) {
    echo "Impossible de se connecter!".$e;
}
/*
$req = $DB->query('SELECT * FROM annonce');
while($d = $req->fetch()) {
//die('rHtHKLM');
    echo $d['titre'].'&nbsp->'.$d['prix'].'&nbsp->'.$d['description'].'<br><br>';
}
*/