<?php
require_once 'header.php';


session_start();
if(isset($_SESSION['is_logged']) ) {
    header('Location: dashboard.php');
}
?>

<div class="container">

        <h1 id="welcome">Bienvenue</h1>
            <?php /*echo displayMessage($code_erreur,$code_success)*/ ?>
            <form action="login2.php" method="POST">

                <label>Email:</label>
                <input type="text" name="email" required><br/>
                <label>Mot de passe:</label>
                <input type="password" name="mdp" required><br/>

                <button>Se connecter</button>
            </form>
        </div>


</body>
</html>
