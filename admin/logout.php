<!-- logout.php : Ce fichier semble être responsable du processus de déconnexion des utilisateurs de la partie d'administration du site. -->


<?php 
    session_start();
    $_SESSION["user_connected"] = "";
    session_destroy();
    header("Location:/admin/login.php");
// détruit la variable de session créée avec le fichier login.php

// le code détruit la variable de session user_connected, 
// détruit ensuite la session en appelant session_destroy(), 


// puis redirige l'utilisateur vers la page de connexion.
?>
