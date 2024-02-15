<?php 
include $_SERVER["DOCUMENT_ROOT"]."/admin/include/protect.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/admin/include/connect.php";

// Vérifier s'il s'agit d'une mise à jour ou d'un ajout
if(isset($_POST['product_id']) && $_POST['product_id'] > 0){
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
exit(); // Assurez-vous de terminer le script après la redirection de l'en-tête


// rechercher 
if(isset($_POST['search']) && $_POST['search'] > 0){
   // recherche d'un produit existant
   $sql = "SELECT * FROM table_product WHERE product_name=:product_name";
   $stmt = $db->prepare($sql);
   $stmt->bindValue(":product_name", $_POST["search"]);
   $stmt->execute();
   $result = $stmt->fetchAll();
}

?>

