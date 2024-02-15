<?php 
include $_SERVER["DOCUMENT_ROOT"] . "/admin/include/protect.php";
require_once $_SERVER["DOCUMENT_ROOT"]. "/admin/include/connect.php";

// Vérification de la connexion de l'utilisateur
// Code de vérification de la session ou du cookie, par exemple
// Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion

$nbParPage = 14;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
if (!is_numeric($page) || $page < 1) {
    $page = 1;
}

$sqlCount = 'SELECT COUNT(product_id) AS total_product FROM table_product';
$stmtCount = $db->prepare($sqlCount);
$stmtCount->execute();
$total_product = $stmtCount->fetchColumn();

$total_pages = ceil($total_product / $nbParPage);
$offset = ($page - 1) * $nbParPage;

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
            <form action="process.php" method="post">
                <input type="text" name="search" placeholder="Entrez un critère de recherche">
                <select name="type">
                    <option value="type">Type</option>
                    <option value="nom">Nom</option>
                </select>
                <button type="submit">Recherche</button>
            </form>
           
            <div class="my-2"></div> 
            

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
                        <a href="form.php?id=<?= htmlspecialchars($row['product_id']); ?>" class="btn btn-warning btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-exclamation-triangle"></i>
                            </span>
                            <span class="text">Modifier</span>
                        </a>
                        
                        <div class="my-2"></div>
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
    </div>

        <ul class="pagination">
            <?php 
            $prev_page = max(1, $page - 1);
            echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $prev_page . '">&laquo;</a></li>';

            $tranche = 5;
            $start_page = max(1, $page - floor($tranche / 2));
            $end_page = min($total_pages, $start_page + $tranche - 1);

            for ($i = $start_page; $i <= $end_page; $i++) {
                echo '<li class="page-item';
                if ($i == $page) echo ' active';
                echo '"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
            }

            $next_page = min($total_pages, $page + 1);
            echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $next_page . '">&raquo;</a></li>';
            ?>
        </ul>
    </div>
</body>
</html>