<?php

require_once 'header.php';
require_once 'functions.php';
$code_erreur = isset($_GET['error']) ? $_GET['error']: false;
$code_success = isset($_GET['success']) ? $_GET['success']: false;

?>




<body>

<div class="container">
    <div class="wrapper">
    <h1 id="welcome">Bienvenue</h1>
    <?php echo displayMessage($code_erreur,$code_success, $id)?>
    <form action="login2.php" method="POST">

        <label>Email:</label>
        <input type="text" name="email"><br/>
        <label>Mot de passe:</label>
        <input type="password" name="mdp"><br/>

        <button>Se connecter</button>
    </form>
    </div>
</div>


</body>