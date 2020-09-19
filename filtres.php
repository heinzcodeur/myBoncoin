<?php

require_once 'db_connect.php';

$filtres=$_POST['filtres'];
echo $filtres;


$req="SELECT * FROM annonce WHERE id_categorie=$filtres
";
die($req);
$result=mysqli_query($db,$req);


/*while ($bim=mysqli_fetch_assoc($result)){

    echo '<pre>';
print_r($bim);
echo '</pre>';
}*/

header('Location:index.php?req=$req');exit();