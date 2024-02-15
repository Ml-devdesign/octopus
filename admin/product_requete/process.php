<?php
include $_SERVER["DOCUMENT_ROOT"] . "/admin/include/protect.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/include/connect.php";


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
   

// Initialisation d'un tableau associatif pour stocker les données du formulaire
$data = array();

// Parcours des données du formulaire
foreach ($_POST as $key => $value) {
    // Ignorer les valeurs vides et la clé 'product_id'
    if ($value !== '' && $key !== 'product_id') {
        // Ajout de la clé et de la valeur au tableau $data
        $data[$key] = $value;
    }
}

// Vérifier si des données ont été soumises
if (!empty($data)) {
    // Vérifier si la clé 'product_id' est définie dans les données POST
    if(isset($_POST['product_id']) && !empty($_POST['product_id'])) {
        // Mise à jour d'un produit existant

        // Construction de la partie SET de la requête UPDATE
        $setSql = "";
        foreach ($data as $key => $value) {
            $setSql .= "$key = :$key, "; // Construction de la clause SET
        }
        // Suppression de la virgule finale
        $setSql = rtrim($setSql, ", ");

        // Construction de la requête SQL
        $sql = "UPDATE table_product SET 
                $setSql
                WHERE product_id = :product_id";
    } else {
        // Ajout d'un nouveau produit
        $sql = "INSERT INTO table_product (";
        $valuesSql = "";
        $updateSql = "";

        // Construction des parties de la requête SQL
        foreach ($data as $key => $value) {
            $sql .= "$key, "; // Colonnes à insérer
            $valuesSql .= ":$key, "; // Valeurs à insérer
            $updateSql .= "$key = VALUES($key), "; // Mise à jour des colonnes en cas de doublon
        }

        // Suppression de la virgule finale des chaînes dans la requête SQL
        $sql = rtrim($sql, ", ") . ") VALUES (" . rtrim($valuesSql, ", ") . ")
                ON DUPLICATE KEY UPDATE " . rtrim($updateSql, ", ") . ";";
    }

    // Préparation de la requête SQL
    $stmt = $db->prepare($sql);

    // Liaison des valeurs avec le statement PDO
    foreach ($data as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }

    // Si c'est une mise à jour, lier également le product_id
    if(isset($_POST['product_id']) && !empty($_POST['product_id'])) {
        $stmt->bindValue(":product_id", $_POST['product_id']);
    }

    // Exécution de la requête SQL
    $stmt->execute();
}

// Redirection vers la page d'accueil
header("Location:index.php");
exit(); // Assurez-vous de terminer le script
?>
