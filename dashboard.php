<?php
session_start();
require_once 'check_session.php'; //securise la page
require_once 'header.php';
require_once 'functions.php';
require_once 'db_connect.php';
// Récupérer le fichier model user
require_once 'includes/models/annonces.php';
$code_erreur = isset($_GET['error']) ? $_GET['error']: false;
$code_success = isset($_GET['success']) ? $_GET['success']: false;
$id = isset($_GET['id']) ? $_GET['id']: false;
$annonceperpage=4;
//liste les annonces de l'utilisateur
//findAnnonceByIdUser($id_user) => $_SESSION['id_utilisateur']
//$nb_page = fin
$annonces = findAnnonceByIdUser($_SESSION['id_utilisateur'], 0,4);

?>

    <div class="container">
<?php echo displayMessage($code_erreur,$code_success,$id) ?>
        <h3><a href="depoannonce.php"> Déposer une annonce</a></h3>
        <h3><a href="moncompte.php">Modifier mes informations</a></h3>

        <?php if(mysqli_num_rows($annonces)>0): ?>
                    <table>
                        <thead>
                        <tr>

                            <th>Titre</th>
                            <th>Date de publication</th>
                            <th>Prix</th>
                            <th>Categorie</th>
                            <th>Interaction</th>
                            <th>Gérer</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        while($annonce = mysqli_fetch_assoc($annonces)) : ?>
                            <tr>
                                <td><?=$annonce['titre'];?></td>
                                <td><?=$annonce['date_publication'];?></td>
                                <td><?=$annonce['prix'];?></td>
                                <td><?=$annonce['libelle_categorie'];?></td>
                                <td></td>
                                 <td><a href="modifier.php?id_annonce=<?=
                                     $annonce['id_annonce'];?>">Modifier</a>
                                    <a href="delete.php?id_annonce=<?=
                                    $annonce['id_annonce'];?>">Supprimer</a>
                                     <!--a href="dashboard.php?id_annonce=<?=
                                     $annonce['id_annonce'];?>">Desactiver</a>
                                     <a href="dashboard.php?id_annonce=<?=
                                      $annonce['id_annonce'];
                                     ?>">activer</a-->
                                 </td>
                            </tr>
                        <?php endwhile;
                        ?>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>


    </body>
</html>