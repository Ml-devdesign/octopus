<!-----------------------------------------MODEL------------------------------------------------------------------- -->
<!-- Permet la redirection reecriture sur chaque fichier securisé-->
<?php 
        include $_SERVER["DOCUMENT_ROOT"] . "/admin/include/protect.php";
        //si l' USER n'as acun accés donc on utilise le protect puis 
        require_once $_SERVER["DOCUMENT_ROOT"]. "/admin/include/connect.php";

//----------------------------------------------------------------------------------------------------------
//
//
//
//
//----------------------------------------------------------------------------------------------------------
 //possibilite de condition propre au besoin de l'entreprise

 if(isset($_POST['product_id'])&& $_POST['product_id']>0){
   $sql="UPDATE table_product SET product_name=:product_name, product_serie=:product_serie, product_price=:product_price WHERE product_id=:product_id";
   $stmt=$db->prepare($sql);
   $stmt->bindValue(":product_id",$_POST['product_id']);
   
 }else{

   $sql="INSERT INTO table_product(product_name , product_serie, product_price, product_id) VALUES(:product_name, :product_serie,product_price, :product_id )";//nom du champ plus valeur du formulaire
      $stmt=$db->prepare($sql);
 }{
      $stmt->bindValue(":product_name",$_POST['product_name']);
      $stmt->bindValue(":product_serie",$_POST['product_serie']);
      $stmt->bindValue(":product_price",$_POST['product_price']);
      $stmt->execute();
      header("Location:index.php");
}

?>




















//-------------------------------------------------------------------------- Faille XXS-------------------------------------------------------------------------
// require_once "C:\wamp64\www\bdshop\admin\include\connect.php";
//
//�viter les requ�tes SQL non s�curis�es:**
//- Utilisez des requ�tes pr�par�es pour emp�cher les injections SQL.
//  Exemple:
   
   // $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
   // $stmt->bindParam(':username', $username);
   // $stmt->execute();

//---------------------------------------------------------------------------------------------------------------------------------------------------

  
//htmlspecialchars

//------------------------------------------------------------------ Requete pr�parer ---------------------------------------------------------------------------------


//------------------------------------------------------------------ Fonctions de hachage s�curis�es ---------------------------------------------------------------------------------

//Cours : 
// echo password_hash($password, PASSWORD_DEFAULT);

// 


//**Utilisation de fonctions de hachage s�curis�es:**
//- Utilisez `password_hash` pour stocker les mots de passe de mani�re s�curis�e.
  // Exemple: 

   //$hashedPassword = password_hash($password, PASSWORD_BCRYPT);


//-------------------------------------------------------------------------------- Session -------------------------------------------------------------------

   //Variable de session plus securis� : duree dans le temps assez court un quart d'heure et une demi heure d'innactivit� 
   //possibilit� de modifier puis supprimer  les variable de session en laissent la possibilit� a l'USER de se deconnecter '

//Protection contre les attaques CSRF (Cross-Site Request Forgery):**
// Utilisez des jetons CSRF pour v�rifier que les demandes proviennent bien de votre application.
 //Exemple:
  
   // G�n�ration du jeton CSRF
   //$csrfToken = bin2hex(random_bytes(32));
   //$_SESSION['csrf_token'] = $csrfToken;



//-------------------------------------------------------------------------------- Cookies -------------------------------------------------------------------


   // : Modification des valeur 	pa de deconnection 

?>