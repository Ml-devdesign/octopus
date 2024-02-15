<!-- Si ont a un id alors c'est une modif -> alors preremplis et si on a un id alors c'est un ajout  -->
<!-----------------------------------------MODEL------------------------------------------------------------------- -->
<!-- Permet la redirection reecriture sur chaque fichier securisé-->
<?php 
        include $_SERVER["DOCUMENT_ROOT"] . "/admin/include/protect.php";
        //si l' USER n'as acun accés donc on utilise le protect puis 
        require_once $_SERVER["DOCUMENT_ROOT"]. "/admin/include/connect.php";

//----------------------------------------------------------------------------------------------------------

$product_name="";
$product_serie="";
$product_id=0;
$product_description="";
$product_price=0;
$product_type_id=0;

if(isset($_GET['id']) && $_GET['id']>0){
    $sql="SELECT * FROM table_product WHERE product_id=:product_id";
    $stmt=$db->prepare($sql);

    //binvalue permet le calcule de plusieur valeurs //PDO::PARAM_INT pour lui preciser que c'est un entier
    $stmt->bindValue(':product_id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute(); //tout ce qui a etait vue plus haut se retrouve dans le dernier stmtProduct est executé puis 
    
    if($row=$stmt->fetch()){
        $product_name = $row['product_name'];
        $product_serie = $row['product_serie'];
        $product_price=$row['product_price'];
        $product_cartoonist=$row['product_cartoonist'];
        $product_type_id=$row['product_type_id'];
        $product_description=$row['product_description'];
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
        <form action="process.php" method="post"; ?>
            <div class="form-group">
                <label for="product_name">Titre:</label>
                <input type="text" id="product_name" name="product_name"  value="<?= htmlspecialchars($row['product_name'])?>">
            </div><br><br>

            <div class="form-group">
                <label for="product_cartoonist">Cartoonist:</label>
                <input type="text" id="product_cartoonist" name="product_cartoonist" value="<?= htmlspecialchars($row['product_cartoonist'])?>">
            </div><br><br>

            <div class="form-group">
                <label for="product_serie">Série:</label>
                <input type="text" id="product_serie" name="product_serie" value="<?= htmlspecialchars($row['product_serie'])?>">
            </div><br><br>

            <div class="form-group">
                <label for="product_price">Prix:</label>
                <input type="number" id="product_price" name="product_price" step="0.01" value="<?= htmlspecialchars($row['product_price'])?>">
            </div><br><br>

            <div class="form-group">
                <label for="product_description">Descriptif:</label>
                <textarea id="product_description" name="product_description" rows="5"  value="<?= htmlspecialchars($row['product_description'])?>"></textarea>
            </div><br><br>

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
                <?= htmlspecialchars($rowType["type_name"]);?></option>
               <?php } ?>

                </select>
              </div><br><br>

            <button type="submit">Ajouter</button>

        </form>
    </div>
    <!-- jQuery -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <!-- Bootstrap JavaScript -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>  
  </body>
</html>
