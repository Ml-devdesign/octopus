<!-- login.php : fichier qui est responsable du processus de connexion des utilisateurs à la partie d'administration du site. -->

<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/include/connect.php";
if (isset($_POST['login']) && isset($_POST['password'])){
    // echo "1";
    // Si elles existent, on a défini le login et le mot de passe
    $sql = "SELECT * FROM table_admin WHERE admin_login=:login"; // Requête préparée
    $stmt = $db->prepare($sql); // Préparation de la requête
    $stmt->execute([':login' => $_POST["login"]]); // Exécution de la requête
    // Si on a bien des utilisateurs avec ce login 
    if ($row = $stmt->fetch()){
        // echo "2";
        // Un utilisateur a bien ce login 
        if (password_verify($_POST['password'], $row['admin_password'])){
            // echo "3";
            // Vérifie que ce mot de passe correspond à ce login, le mot de passe sera comparé malgré le fait qu'il soit chiffré 
            session_start();
            // Active la variable de session 
            $_SESSION['user_connected'] = "ok";
            // Création d'une variable de session 
            header("Location:/admin/index.php");
            // Redirection vers la page 
            exit();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="/admin/css/style.css">

</head>
<body>
    
<!-- L'attribut action du formulaire spécifie l'URL vers laquelle les données du formulaire seront soumises
    lors de la soumission. Assurez-vous que l'URL spécifiée (login.php dans ce cas) est correcte et pointe vers le script PHP 
    qui traite les données du formulaire de connexion. -->
   
    <!-- L'attribut method du formulaire spécifie la méthode HTTP à utiliser lors de la soumission des données du formulaire. 
        Dans ce cas, la méthode est POST, ce qui signifie que les données seront envoyées de manière sécurisée et invisible à l'utilisateur. -->
<!--ring div starts here-->
<div class="ring">
  <i style="--clr:#2e00ff;"></i>
  <i style="--clr:#ff0057;"></i>
  <i style="--clr:#fffd44;"></i>

    <div class="login">
        <h2>Login</h2> 

        <form action="login.php" method="POST">

            <div class="inputBx">
                <label for="ok1">label</label>
                <input type="text" placeholder="Username" name="login" id="ok1">
                <!-- (login et password) correspondent exactement aux clés utilisées dans votre script PHP pour récupérer les données postées. -->
            </div><br>

            <div class="inputBx">
                <label for="ok2"></label>
                <input type="password"  placeholder="Password" name="password" id="ok2">
                <!-- Les attributs id des champs de formulaire (ok1 et ok2) sont utilisés pour lier les étiquettes aux champs de formulaire.  -->
            </div><br>

            <div class="inputBx">
                <input type="submit" value="ok">
            </div><br>

            <div class="links">
                <a href="#">Forget Password</a>
                <a href="#">Signup</a>
            </div>
        </form>
    </div>
</div>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>  
        <!--ring div ends here-->
    <!-- <script>alert("Hacked")</script> possibilit� de hacking => ecrit dans le champ nom faille xss cette faille fait simplement un affichage 
    = une injection de javascript   -->

</body>
</html>
<!-- require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php"; pas besoin de try catch permet disoler certaine portion de code et modifier sur un seul fichier la db  -->
<!-- vue require require_once -->


 <!-- C'est une balise d'ouverture PHP, indiquant que le code PHP commence ici. -->

<!-- require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";: 
Cette ligne inclut le fichier connect.php situé dans le répertoire /admin/include/ 
à partir du répertoire racine du serveur ($_SERVER["DOCUMENT_ROOT"]). 
La fonction require_once garantit que le fichier est inclus une seule fois dans le script, même si cette ligne est rencontrée plusieurs fois. -->

<!-- if (isset($_POST['login']) && isset($POST['pwd'])){: 
    Cette condition vérifie si les données du formulaire avec les noms login et pwd ont été envoyées via la méthode POST.
     Cependant, il y a une erreur de syntaxe ici. isset($POST['pwd']) devrait être isset($_POST['pwd']). -->

<!-- Le commentaire si il existe on a definit le log et le pwd est une indication de ce qui est censé être exécuté 
si les variables login et pwd existent dans les données POST. -->

<!-- }: Fermeture de la structure conditionnelle. -->

<!-- : C'est une balise de fermeture PHP, indiquant que le code PHP se termine ici. -->




<!--file:///C:/wamp64/www/php/bdd-livres/admin/book/index.php-->