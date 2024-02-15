<?php 
include $_SERVER["DOCUMENT_ROOT"] . "/admin/include/protect.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/admin/include/connect.php";

$product_name = "";
$product_serie = "";
$product_id = 0;
$product_description = "";
$product_price = 0;
$product_type_id = 0;
$product_author = "";
$product_date = "";
$product_image = "";
$product_cartoonist = "";

if(isset($_GET['id']) && $_GET['id'] > 0){
    $sql = "SELECT * FROM table_product WHERE product_id=:product_id";
    $stmt = $db->prepare($sql);

    // Binds value permet le calcul de plusieurs valeurs //PDO::PARAM_INT pour lui préciser que c'est un entier
    $stmt->bindValue(':product_id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute(); // Tout ce qui a été vu plus haut se retrouve dans le dernier stmtProduct est exécuté puis 

    $row = $stmt->fetch(); // Récupération de la ligne de la base de données

    // Vérifier si $row est défini avant d'accéder à ses éléments
    if($row !== false){
        $product_name = $row['product_name'];
        $product_serie = $row['product_serie'];
        $product_price = $row['product_price'];
        $product_cartoonist = $row['product_cartoonist'];
        $product_type_id = $row['product_type_id'];
        $product_description = $row['product_description'];
        $product_author = $row['product_author'];
        $product_date = $row['product_date'];
        $product_image = $row['product_image'];
    }          
}
?>


<!-- //-----------------------------------------------FORM- view---------------------------------------------------------- -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Console d'Administration - Gestion de Livres</title>
    <link rel="stylesheet" href="/admin/css/style.scss">
</head>
<body>
    <div class="navbar">
        <a href="#">Accueil</a>
        <a href="#">Produits</a>
        <a href="#">Utilisateurs</a>
        <a style="float: right;" href="#">Déconnexion</a>
    </div>

    <div class="container_librairie">
        <h1>Ajout de Livre</h1>
        <!-- Formulaire d'ajout de livre -->
        <form action="process.php" method="post" enctype="multipart/form-data">
            <!-- Champ caché pour l'ID du produit -->
            <input type="hidden" name="product_id" value="<?= isset($row['product_id']) ? $row['product_id'] : '' ?>">

            <div class="product_type_id">
                <label for="product_type_id">Type de Produit</label>
                <select id="product_type_id" name="product_type_id" rows="5" value="<?= htmlspecialchars($row['product_type_id'])?>">

                <option value="0">Selectionne un ...</option>
                    <?php $sqlType ="SELECT * FROM table_type";
                    $stmtType=$db->prepare($sqlType);
                    $stmtType->execute(); //tout ce qui a etait vue plus haut se retrouve dans le dernier stmtProduct est executé puis 
                    $recordsetType= $stmtType->fetchAll();//binvalue permet le calcule de plusieur valeurs //PDO::PARAM_INT pour lui preciser que c'est un entier
                    foreach($recordsetType as $rowType){ ?>

                    <option value="<?= htmlspecialchars($rowType["type_id"]);?>" 
                    <?= htmlspecialchars($rowType["type_id"]==$product_type_id)?"selected":""?>>
                    <?= htmlspecialchars($rowType["type_name"]);?>
                </option>
                <?php } ?>

                </select>
              </div><br><br>

            <div class="form-group">
                <label for="product_name">Titre:</label>
                <input type="text" id="product_name" name="product_name" value="<?= isset($row['product_name']) ? htmlspecialchars($row['product_name']) : '' ?>">
            </div><br><br>

            <div class="form-group">
                <label for="product_author">Auteur:</label>
                <input type="text" id="product_author" name="product_author" value="<?= isset($row['product_author']) ? htmlspecialchars($row['product_author']) : '' ?>">
            </div><br><br>

            <div class="form-group">
                <label for="product_cartoonist">Dessinateur:</label>
                <input type="text" id="product_cartoonist" name="product_cartoonist" value="<?= isset($row['product_cartoonist']) ? htmlspecialchars($row['product_cartoonist']) : '' ?>">
            </div><br><br>

            <div class="form-group">
                <label for="product_serie">Série:</label>
                <input type="text" id="product_serie" name="product_serie" value="<?= isset($row['product_serie']) ? htmlspecialchars($row['product_serie']) : '' ?>">
            </div><br><br>

            <div class="form-group">
                <label for="product_price">Prix:</label>
                <input type="number" id="product_price" name="product_price" step="0.01" value="<?= isset($row['product_price']) ? htmlspecialchars($row['product_price']) : '' ?>">
            </div><br><br>

            <div class="form-group">
                <label for="product_description">Descriptif:</label>
                <textarea id="product_description" name="product_description" rows="5"><?= isset($row['product_description']) ? htmlspecialchars($row['product_description']) : '' ?></textarea>
            </div><br><br>

            <div class="form-group">
                <label for="product_date">Date de publication:</label>
                <input type="date" id="product_date" name="product_date" value="<?= isset($row['product_date']) ? htmlspecialchars($row['product_date']) : '' ?>">
            </div><br><br>


            <div class="form-group">
                <label for="product_image">Image:</label>
                <input type="file" name="product_image" id="product_image">
            </div>
            <br><br>

            <div class="form-group">
                <label for="product_stock">Stock:</label>
                <input type="number" id="product_stock" name="product_stock" value="<?= isset($row['product_stock']) ? htmlspecialchars($row['product_stock']) : '' ?>">
            </div>
            <br><br>

            <div class="form-group">
                <label for="product_volume">Volume:</label>
                <input type="number" id="product_volume" name="product_volume" value="<?= isset($row['product_volume']) ? htmlspecialchars($row['product_volume']) : '' ?>">
            </div>
            <br><br>

            <div class="form-group">
                <label for="product_status">Statut:</label>
                <input type="text" id="product_status" name="product_status" value="<?= isset($row['product_status']) ? htmlspecialchars($row['product_status']) : '' ?>">
            </div>
            <br><br>

            <div class="form-group">
                <label for="product_resume">Résumé:</label>
                <textarea id="product_resume" name="product_resume" rows="5"><?= isset($row['product_resume']) ? htmlspecialchars($row['product_resume']) : '' ?></textarea>
            </div>
            <br><br>

            <div class="form-group">
                <label for="product_publisher">Éditeur:</label>
                <input type="text" id="product_publisher" name="product_publisher" value="<?= isset($row['product_publisher']) ? htmlspecialchars($row['product_publisher']) : '' ?>">
            </div>
            <br><br>

            <button type="submit">Ajouter</button>
        </form>
    </div>
    <!-- jQuery -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <!-- Bootstrap JavaScript -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>  
</body>
</html>

<!-- Navbar: Une barre de navigation contenant des liens vers différentes sections de la console d'administration.

Formulaire d'ajout de livre:
    Les champs du formulaire comprennent :
        Titre du livre (product_name).
        Cartoonist (dessinateur) du livre (product_cartoonist).
        Série du livre (product_serie).
        Prix du livre (product_price).
        Descriptif du livre (product_description).
        Type de produit (product_type_id), sélectionné à partir d'une liste déroulante avec des options chargées dynamiquement à partir d'une requête SQL.
        Image du livre (product_image), sélectionnée à l'aide d'un champ de fichier.
    Le formulaire est envoyé à process.php via la méthode POST dès que l'utilisateur appuie sur le bouton "Ajouter".
    Un champ caché product_id est inclus pour contenir l'identifiant du livre s'il s'agit d'une mise à jour plutôt que d'un ajout.

Scripts JavaScript:
    Il y a un lien vers Bootstrap JavaScript pour l'interactivité et le style.

Globalement, ce formulaire permet d'ajouter un nouveau livre avec des informations détaillées et une image associée, qui seront traitées par le script PHP process.php lorsqu'il est soumis. -->
