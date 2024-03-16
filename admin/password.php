<!-- password.php : fichier  responsable de la gestion des mots de passe des utilisateurs, probablement pour la réinitialisation ou la modification des mots de passe. -->

<!-- fichier qui seras modifier pour que ce soit automatiser pour repondre a la majorite des utilisateur   -->
<?php 
echo password_hash("1", PASSWORD_DEFAULT);
//fichier qui n'est utile qu'une fois pour le hachage des password de la base de donnee (a suppr)
//Copier le code genere puis le coller dans le admin_login pour prendre en compte le hachage 
?>