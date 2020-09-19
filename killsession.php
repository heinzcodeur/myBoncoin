<?php
 session_start();
 unset($_SESSION['id_utilisateur']);
header('Location: index.php');
exit();

