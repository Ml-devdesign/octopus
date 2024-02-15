<?php 
include $_SERVER["DOCUMENT_ROOT"]."/admin/include/protect.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

// Ajouter un image plus changer les caracteres
function generateFilename($filename,$title) {
   $extension=pathinfo($filename, PATHINFO_EXTENSION);
   $arrayko=[ " ","!", "#", "$", "%", "&", "'", "(", ")", "*", "+", ",", "-", ".", "/", "0", "1", "2", "3",
      "4", "5", "6", "7", "8", "9", ":", ";", "<", "=", ">", "?", "@", "[", "", "]", "^", "_", "`", "{", 
      "|", "}", "~", "À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï", "Ð",
      "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "×", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "Þ", "ß", "à", "á", "â", "ã", "ä",
      "å", "æ", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï", "ð", "ñ", "ò", "ó", "ô", "õ", "ö", "÷", "ø",
      "ù", "ú", "û", "ü", "ý", "þ", "ÿ", "€", "£", "¥", "¢", "§", "©", "®", "™", "°", "µ", "¹", "²", "³",
      "¼", "½", "¾", "¡", "¿", "«", "»", "¯", "±","÷", "¬", "¦"];
   $arrayok=['é' => 'e', 'à' => 'a', 'ç' => 'c', 'è' => 'e', 'ê' => 'e'];
   $title=str_replace($arrayko,$arrayok,$title);
   return date("Ymdhis").".".strtolower($title.".".$extension);
   }

   $destination = $_SERVER['DOCUMENT_ROOT'].'/upload/product/'.generateFilename($_FILES['product_image']['name'],$_POST['product_name'] );
   move_uploaded_file($_FILES['product_image']['tmp_name'], $destination);
  




// Vérifier s'il s'agit d'une mise à jour ou d'un ajout
if(isset($_POST['product_id']) && $_POST['product_id'] > 0){
   //Permet meme si on supprime un champs le formulaire fonctionneras tout de meme 
   //integrer le gestion d'image en integrant des key et des value pour pouvoir mofifier l'ensemble ddes champs en un seul algorithme 
    // Mise à jour d'un produit existant
    $sql = "UPDATE table_product SET 
            product_name = :product_name, 
            product_serie = :product_serie, 
            product_price = :product_price,
            product_cartoonist = :product_cartoonist,
            product_type_id = :product_type_id,
            product_description = :product_description,
            WHERE product_id = :product_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":product_id", $_POST['product_id']);
} else {
    // Ajout d'un nouveau produit
    $sql = "INSERT INTO table_product (
                product_name,
                product_serie,
                product_price,
                product_cartoonist,
                product_type_id,
                product_description
            ) 
            VALUES (
                :product_name,
                :product_serie,
                :product_price,
                :product_cartoonist,
                :product_type_id,
                :product_description
            )";
    $stmt = $db->prepare($sql);
}

// Liaison des valeurs avec le statement PDO
$stmt->bindValue(":product_name", $_POST['product_name']);
$stmt->bindValue(":product_serie", $_POST['product_serie']);
$stmt->bindValue(":product_price", $_POST['product_price']);
$stmt->bindValue(":product_cartoonist", $_POST['product_cartoonist']);
$stmt->bindValue(":product_description", $_POST['product_description']);
$stmt->bindValue(":product_type_id", $_POST['product_type_id'], PDO::PARAM_INT);

// Exécution de la requête
$stmt->execute();

// Redirection vers la page d'accueil
header("Location:index.php");

?>

