<?php 
// Inclusion des fichiers de protection et de connexion à la base de données
include $_SERVER["DOCUMENT_ROOT"] . "/admin/include/protect.php";
require_once $_SERVER["DOCUMENT_ROOT"]. "/admin/include/connect.php";

// Définition du nombre d'éléments à afficher par page
$nbParPage = 14;

// Récupération du numéro de la page à afficher depuis les paramètres GET
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Vérification et correction du numéro de page
if (!is_numeric($page) || $page < 1) {
    $page = 1;
}

// Requête SQL pour compter le nombre total de produits
$sqlCount = 'SELECT COUNT(product_id) AS total_product FROM table_product';
$stmtCount = $db->prepare($sqlCount);
$stmtCount->execute();
$total_product = $stmtCount->fetchColumn();

// Calcul du nombre total de pages
$total_pages = ceil($total_product / $nbParPage);

// Calcul de l'offset pour la pagination
$offset = ($page - 1) * $nbParPage;

// Requête SQL pour récupérer les produits de la page actuelle
$sqlProducts = 'SELECT * FROM table_product ORDER BY product_id DESC LIMIT :limit OFFSET :offset';
$stmtProducts = $db->prepare($sqlProducts);
$stmtProducts->bindValue(':limit', $nbParPage, PDO::PARAM_INT);
$stmtProducts->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmtProducts->execute();
$recordset = $stmtProducts->fetchAll();
?>

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
        <h1>Gestion des Livres</h1>
        <!-- Formulaire de recherche -->
        <form action="process.php" method="post">
            <input type="text" name="search" placeholder="Entrez un critère de recherche">
            <select name="type">
                <option value="type">Type</option>
                <option value="nom">Nom</option>
            </select>
            <button type="submit">Recherche</button>
        </form>
       
        <div class="my-2"></div> 

        <!-- Affichage des produits -->
        <div class="card-container">
            <?php foreach($recordset as $row){ ?>
            <div class="card">
                <?php if($row['product_image'] != ''){ ?>
                <img src="<?="/upload/product/xs_".($row['product_image']);?>" class="card-img-top" alt="<?= htmlspecialchars($row['product_name']); ?>">
                <?php } ?>
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($row['product_name']); ?></h5>
                    <h6 class="card-text"><?= htmlspecialchars($row['product_serie']); ?></h6>
                    <a href="#"><h6 class="btn btn-lg btn-outline-warning"><?= htmlspecialchars($row['product_price']); ?></h6></a>
                    <div class="my-2"></div>
                    <!-- Bouton de modification -->
                    <a href="form.php?id=<?= htmlspecialchars($row['product_id']); ?>" class="btn btn-warning btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                        <span class="text">Modifier</span>
                    </a>
                    
                    <div class="my-2"></div>
                    <!-- Bouton de suppression -->
                    <a href="delete.php?id=<?= htmlspecialchars($row['product_id']); ?>" class="btn btn-danger btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text">Supprimer</span>
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <!-- Pagination -->
    <ul class="pagination">
        <?php 
        // Lien vers la page précédente
        $prev_page = max(1, $page - 1);
        echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $prev_page . '">&laquo;</a></li>';

        // Tranche de pagination
        $tranche = 5;
        $start_page = max(1, $page - floor($tranche / 2));
        $end_page = min($total_pages, $start_page + $tranche - 1);

        // Affichage des liens de pagination
        for ($i = $start_page; $i <= $end_page; $i++) {
            echo '<li class="page-item';
            if ($i == $page) echo ' active';
            echo '"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
        }

        // Lien vers la page suivante
        $next_page = min($total_pages, $page + 1);
        echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $next_page . '">&raquo;</a></li>';
        ?>
    </ul>
</body>
</html>
