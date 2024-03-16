<?php
// Initialisation de la connexion PDO
// try {
//     $db = new PDO("mysql:host=localhost;dbname=nom_de_la_base_de_donnees", "nom_utilisateur", "mot_de_passe");
//     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch(PDOException $e) {
//     logError("Erreur de connexion à la base de données: " . $e->getMessage());
// }
include $_SERVER["DOCUMENT_ROOT"] . "/admin/include/protect.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/include/connect.php";

////////////////////////////////Fonctions
// Validation d'image et de gestion des erreurs
function isValidImage($file) {
    return getimagesize($file['tmp_name']);
}

//////////////// Initialisation 
// Des tailles d'images
$images = [
    ['prefix' => 'xl', 'width' => 1600, 'height' => 900 ],
    ['prefix' => 'lg', 'width' => 800, 'height' => 600],
    ['prefix' => 'md', 'width' => 400, 'height' => 400],
    ['prefix' => 'xs', 'width' => 150, 'height' => 150]
];

//////////////// Fonction 
//Garantir Que le nom de fichier généré est sécurisé et valide.
function generateFilename($fileName, $title) {
    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    $sanitizedTitle = preg_replace('/[^a-zA-Z0-9_\-\.]+/', '', $title); // Supprime tous les caractères spéciaux
    return date("Ymdhis") . "_" . strtolower($sanitizedTitle) . "." . $extension;
}
 
//////////////// Initialisation
// D'un tableau associatif pour stocker les données du formulaire
$data = array_filter($_POST); // Supprime les valeurs vides
if (!empty($data)) {
    try {
        $sql = "";
        if(isset($data['product_id']) && !empty($data['product_id'])) {
            $sql = "UPDATE table_product SET ";
            foreach ($data as $key => $value) {
                if ($key !== 'product_id') {
                    $sql .= "$key = :$key, ";
                }
            }
            $sql = rtrim($sql, ", ");
            $sql .= " WHERE product_id = :product_id";
        } else {
            $sql = "INSERT INTO table_product (";
            $valuesSql = "";
            $updateSql = "";
            foreach ($data as $key => $value) {
                $sql .= "$key, ";
                $valuesSql .= ":$key, ";
                $updateSql .= "$key = VALUES($key), ";
            }
            $sql = rtrim($sql, ", ") . ") VALUES (" . rtrim($valuesSql, ", ") . ")
                    ON DUPLICATE KEY UPDATE " . rtrim($updateSql, ", ") . ";";
        }

        $stmt = $db->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        if(isset($data['product_id']) && !empty($data['product_id'])) {
            $stmt->bindValue(":product_id", $data['product_id']);
        }
        $stmt->execute();
    } catch(PDOException $e) {
        logError("Erreur lors de l'exécution de la requête SQL: " . $e->getMessage());
    }
}

//////////////// Function Upload
// Fonction pour redimensionner et enregistrer une image
// Fonction pour redimensionner et recadrer une image
function resizeAndCropImage($sourcePath, $destinationPath, $width, $height) {
    // Obtenir les dimensions de l'image source
    list($sourceWidth, $sourceHeight) = getimagesize($sourcePath);

    // Calculer les ratios de largeur et de hauteur entre l'image source et l'image cible
    $sourceRatio = $sourceWidth / $sourceHeight;
    $targetRatio = $width / $height;

    // Déterminer les dimensions de la zone de recadrage
    if ($sourceRatio > $targetRatio) {
        // L'image source est plus large que l'image cible
        $cropWidth = $sourceHeight * $targetRatio;
        $cropHeight = $sourceHeight;
    } else {
        // L'image source est plus haute que l'image cible
        $cropWidth = $sourceWidth;
        $cropHeight = $sourceWidth / $targetRatio;
    }

    // Calculer les coordonnées de la zone à recadrer pour centrer l'image
    $cropX = intval(($sourceWidth - $cropWidth) / 2);
    $cropY = intval(($sourceHeight - $cropHeight) / 2);

    // Créer une nouvelle image de destination avec les dimensions spécifiées
    $destinationImage = imagecreatetruecolor($width, $height);

    // Créer l'image source à partir du fichier en fonction de son extension
    $extension = pathinfo($sourcePath, PATHINFO_EXTENSION);
    switch ($extension) {
        case 'jpg':
        case 'jpeg':
            $sourceImage = imagecreatefromjpeg($sourcePath);
            break;
        case 'gif':
            $sourceImage = imagecreatefromgif($sourcePath);
            break;
        case 'png':
            $sourceImage = imagecreatefrompng($sourcePath);
            break;
        default:
            logError("Extension de fichier non prise en charge : $extension");
            return false;
    }

    // Redimensionner et recadrer l'image source vers l'image de destination
    $success = imagecopyresampled($destinationImage, $sourceImage, 0, 0, $cropX, $cropY, $width, $height, (int)$cropWidth, (int)$cropHeight);
    // Enregistrer l'image de destination dans le répertoire spécifié
    if ($success) {
        switch ($extension) {
            case 'jpg':
            case 'jpeg':
                $result = imagejpeg($destinationImage, $destinationPath, 97);
                break;
            case 'gif':
                $result = imagegif($destinationImage, $destinationPath);
                break;
            case 'png':
                $result = imagepng($destinationImage, $destinationPath, 5);
                break;
            default:
                logError("Extension de fichier non prise en charge : $extension");
                break;
        }

        // Libérer la mémoire
        imagedestroy($sourceImage);
        imagedestroy($destinationImage);

        if (!$result) {
            logError("Échec de l'enregistrement de l'image redimensionnée et recadrée.");
            return false;
        }
        return true;
    } else {
        logError("Impossible de redimensionner et recadrer l'image.");
        return false;
    }
}
function logError($message) {
    error_log("Erreur: $message", 0);
    // Cette fonction prend un message en paramètre et l'enregistre dans le journal
    // des erreurs du serveur en utilisant la fonction error_log. 
    //Vous pouvez ajuster cette fonction selon vos besoins en matière de gestion
    // des erreurs, par exemple en enregistrant les erreurs dans un fichier de journal
    // dédié ou en envoyant des notifications par e-mail.
}

// Traitement de l'image téléchargée
if (isset($_FILES['product_image']) && $_FILES['product_image']['name'] != "" && $_FILES['product_image']['error'] == 0)  {   
    try {
        // Obtenir les informations sur le fichier téléchargé
        $imageInfo = getimagesize($_FILES['product_image']['tmp_name']);
        
        // Vérifier si le fichier est une image
        if ($imageInfo !== false) {
            // Créer le nom de fichier sécurisé
            $destination = generateFilename($_FILES['product_image']['name'], $_POST['product_name']);

            // Définir le chemin du répertoire de destination
            $path = $_SERVER['DOCUMENT_ROOT'] . '/upload/product/';

            // Définir le chemin complet de destination pour le fichier principal
            $destinationPath = $path . $destination;

            // Déplacer le fichier téléchargé vers le répertoire de destination
            move_uploaded_file($_FILES['product_image']['tmp_name'], $destinationPath);

            // Créer des copies redimensionnées et recadrées de l'image dans différentes tailles
            foreach ($images as $image) {
                $prefix = $image['prefix'];
                $width = $image['width'];
                $height = $image['height'];
                $destinationFile = $path . $prefix . "_" . $destination;
                
                // Redimensionner et recadrer l'image dans différentes tailles
                $success = resizeAndCropImage($destinationPath, $destinationFile, $width, $height);
                
                if (!$success) {
                    logError("Erreur lors de la création de l'image redimensionnée et recadrée pour le format $prefix.");
                }
            }

            // Mettre à jour la base de données avec le chemin de l'image principale
            $sql = "UPDATE table_product SET product_image = :product_image WHERE product_id = :product_id";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":product_image", $destination);
            $stmt->bindValue(":product_id", ($_POST["product_id"] > 0 ? $_POST["product_id"] : $db->lastInsertId()));
            $stmt->execute();

            // Redirection vers la page d'accueil
            header("Location:index.php");
            exit();
        } else {
            logError("Le fichier téléchargé n'est pas une image valide.");
        }
    } catch(PDOException $e) {
        logError("Erreur lors du traitement de l'image: " . $e->getMessage());
    }
    // Fonction pour journaliser les erreurs

}