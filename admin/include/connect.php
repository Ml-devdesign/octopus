<!-- Fichier dans un include pour les fichier reutilisable   -->

<?php
try {
     // Tente de créer une nouvelle instance de PDO pour se connecter à la base de données
    $db = new PDO("mysql:host=localhost;dbname=bdshop;charset=utf8", 
      "root", 
        ""
    );
  }  
  catch(PDOException $e) {// Si une exception PDOException est levée lors de la connexion à la base de données
    echo $e->getMessage();// Affiche le message d'erreur associé à l'exception
    die("Erreur de base de donnees");// Arrête l'exécution du script et affiche un message d'erreur
  };
 
?>