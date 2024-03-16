<?php

    // Chemin vers votre image PNG
    $imagePath = './Capture.png';

    // Charger l'image
    $image = imagecreatefrompng($imagePath);

    // Obtenir les dimensions originales de l'image
    $largeur_originale = imagesx($image);
    $hauteur_originale = imagesy($image);

    // Nouvelles dimensions pour l'image redimensionnée
    $nouvelle_largeur = 400;
    $nouvelle_hauteur = 400;

    // Créer une nouvelle image avec les dimensions spécifiées
    $nouvelle_image = imagecreatetruecolor($nouvelle_largeur, $nouvelle_hauteur);

    // Redimensionner l'image en utilisant imagecopyresampled()
    imagecopyresampled($nouvelle_image, $image, 0, 0, 0, 0, $nouvelle_largeur, $nouvelle_hauteur, $largeur_originale, $hauteur_originale);

    // Définir l'en-tête pour indiquer que le contenu est une image PNG
    header('Content-Type: image/png');

    // Afficher l'image redimensionnée
    imagepng($nouvelle_image);

    // Libérer la mémoire en détruisant les ressources d'image
    imagedestroy($image);
    imagedestroy($nouvelle_image);

    // foreach($nouvelle_largeur as $nouvelle_largeur){
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/script.js" defer></script>
    <!-- Au Chargement du JS : defer-> execution du js apres  async-> execution du js en meme temps  -->
    <title>Document</title>
</head>
<body>
    <button id="btn">Click</button>
    <button class="btn-table"></button>
    <div class="form-group">
                <label for="product_image">Image:</label>
                <input type="file" name="product_image" id="product_image">
            </div>
            <br><br>
    <!-- <img src="./le.png" alt="" srcset=""> -->
</body>
</html>
<!-- // function imagecopyresized_custom(
//     $src_image,
//     $dst_x,
//     $dst_y,
//     $src_x,
//     $src_y,
//     $dst_width,
//     $dst_height,
//     $src_width,
//     $src_height
// ): bool {
//     $dst_image = imagecreatetruecolor($dst_width, $dst_height);
//     imagealphablending($dst_image, false);
//     imagesavealpha($dst_image, true);
//     imagecopyresized($dst_image, $src_image, 0, 0, $src_x, $src_y, $dst_width, $dst_height, $src_width, $src_height);
//     imagepng($dst_image, 'output.png'); // Sauvegarde de l'image redimensionnée
//     imagedestroy($dst_image);
//     return true;
// }

// function image() {
//     $imagename = "./le.png"; // Chemin vers l'image source
//     $src_image = imagecreatefrompng($imagename);
//     imagecopyresized_custom($src_image, 300, 200, 200, 50, 50, 10, 100, 100, 100);
//     imagedestroy($src_image);
// }

// // Appel de la fonction
// image(); --> 