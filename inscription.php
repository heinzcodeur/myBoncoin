<?php
require_once 'header.php';
require_once 'functions.php';
$code_erreur = isset($_GET['error']) ? $_GET['error']: false;
$code_success = isset($_GET['success']) ? $_GET['success']: false;
?>

<!--<h1 style="color:lightblue">Déposez votre annonce</h1>
-->
    <div class="container">

        <?php echo displayMessage($code_erreur,$code_success,$id); ?>
        <form id="test" action="register.php" method="POST">

            <h2>Bienvenue sur l'interface d'inscription</h2>

            <label>Nom:</label>
            <input type="text" <?php if($code_erreur==1):?>
                   style="border: 1px solid red"
                   <?php endif; ?>
                   name="nom" value="<?=$_GET['nom']?>"><br/>
            <label>Prénom:</label>
            <input type="text" <?php if($code_erreur==1):?>
                   style="border: 1px solid red"
                   <?php endif; ?>
                   name="prenom" value="<?=$_GET['pre']?>"><br/>
            <label>Département</label>
            <input <?php if($code_erreur==1):?>
                    style="border: 1px solid red"
                    <?php endif; ?>
                    type="text" name="dpt" value="<?=$_GET['dpt']?>"><br/>
            <label>Email:</label>

            <input <?php if(($code_erreur==3)||($code_erreur==1)||
                ($code_erreur==5)):?>
                style="border: 1px solid red"
            <?php endif; ?>     type="text" name="email"
                   value="<?=$_GET['email']?>"><br/>

            <label>Mot de passe:</label>
            <input <?php if(($code_erreur==2)||($code_erreur==1)):?>
                style="border: 1px solid red" value=""<?php endif; ?>
                    type="password" name="mdp" value="<?=$_GET['mdp']?>"><br/>


            <button>valider</button>
        </form>
    </div> <!-- /fin starter-template -->
        
</body>
