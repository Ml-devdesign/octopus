
<!-----------------------------------------MODEL------------------------------------------------------------------- -->
<!-- Permet la redirection reecriture sur chaque fichier index -->
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

//Requete Preparer pour un pagination         
    // Nombre d'éléments par page
    $nbParPage = 4;

    // Numéro de la page actuelle //methode $_GUET  pour transmettre l'information 
    $page = isset($_GET['page']) ? $_GET['page'] : 1;//La première ligne initialise une variable appelée $page en utilisant l’opérateur ternaire. Elle vérifie si le paramètre $_GET['page'] existe dans l’URL. Si c’est le cas, la valeur de $_GET['page'] est assignée à $page. Sinon, elle prend la valeur par défaut de 1
    if (!is_numeric($page) || $page < 1) {
        $page = 1;
    }//if valide la valeur de $page. Si elle n’est pas numérique ou si elle est inférieure à 1, la valeur de $page est définie à 1

    // Requête pour obtenir le nombre total de produits reutilise a partir du if dans la pagination au niveau du html 
    // Requête pour obtenir le nombre total de produits on est pas obliger le "prepare" et le "execute" ce n'est pas nessecaire mais sur du long terme c'est mieux car 
    $sqlCount = 'SELECT COUNT(product_id) AS total_product FROM table_product';
    $stmtCount = $db->prepare($sqlCount);
    $stmtCount->execute();
    $total_product = $stmtCount->fetchColumn();

    // Calcul du nombre total de pages
    $total_pages = ceil($total_product / $nbParPage);//ceil -> arrondit au nombre supperieur variable integrer dans la requete sql

    // Calcul de l'offset
    $offset = ($page - 1) * $nbParPage;

    // Requête pour récupérer les produits de la page actuelle(obliger de la faire car sans ca la page renvoie une erreur car un calcule est effectuer donc on le collecte)
    $sqlProducts = 'SELECT * FROM table_product ORDER BY product_id DESC LIMIT :limit OFFSET :offset';//offset le decallage le nombre delemeent a ignorer ex LIMIT 50 OFFSET 100 ON IGNORE 50 LE OFFSET ET UNE VARIABLE ENREGISTRER AVEC UN CALCULE DONC /la page -
    $stmtProducts = $db->prepare($sqlProducts);//le :limit et le :offset sont des trou les : permet de donnee des noms   evite les injection sql /
    $stmtProducts->bindValue(':limit', $nbParPage, PDO::PARAM_INT);//binvalue permet le calcule de plusieur valeurs //PDO::PARAM_INT pour lui preciser que c'est un entier
    $stmtProducts->bindValue(':offset', $offset, PDO::PARAM_INT);// le  // Calcul de l'offset $offset = ($page - 1) * $nbParPage;// pourrait directement etre integrer dans les () a la place de la variable $offset evite la creation de variable 
    $stmtProducts->execute(); //tout ce qui a etait vue plus haut se retrouve dans le dernier stmtProduct est executé puis 
    $recordset = $stmtProducts->fetchAll();//tout est stocker daans le recordset
?>
<!-- //Requete Préparer affiche la table
        $sql='SELECT * FROM table_product LIMIT 4';
        $stmt=$db->prepare($sql);
        $stmt->execute();
        $recordset=$stmt->fetchAll();
        // fetchAll() est appelée sur cet objet pour récupérer
        // toutes les lignes de résultat de la requête sous forme
        //  d'un tableau associatif multidimensionnel.
        // et chaque élément est lui-même un tableau associatif 
        // contenant les valeurs de chaque colonne de cette ligne
        // $recordset contiendra toutes les lignes 
        // de résultat de la requête exécutée par $stmt -->

        <!--  //Requete Preparer pour un pagination 
         //Requete Préparer 
         // Définir le nombre de résultats par page

        //  $sql="SELECT * FROM table_product LIMIT 10 , OFFSET 20";
        // $stmt=$db->prepare($sql);
        // $stmt->execute([":limit"=>$nbParPage,"offset"=>($page-1)*"nbParPage"]);
        // $recordset=$stmt->fetchAll();

        // //Requete Préparer avec des filtre 
        // $sql="SELECT * FROM table_book ORDER BY book_titles ASC WHERE  book_title LIKE "%toto%" AND book_category_id=3;
        // $stmt=$db->prepare($sql);
        // $stmt->execute();
        // $recordset=$stmt->fetchAll();


        // //Requete Préparer avec MOTEUR DE RECHERCHE DE MOT CLEF
        //$array=[]
        // $sql="SELECT * FROM table_book ORDER BY book_titles ASC WHERE  book_title AND book_category_id=3;
        // if (!isset($_POST["keword"]) && $_POST["keword"] != "") { // on suppose que l'input a le keyword 
        //$sql .= "AND book_title LIKE "%". $_POST['keyword].%";
        //$array[":keyword => $_POST["keword"]];
        //}
        // $stmt=$db->prepare($sql);
        // $stmt->execute($array);
        // $recordset=$stmt->fetchAll(); -->

<!-----------------------------------------VIEW------------------------------------------------------------------- -->



<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title Page</title>
    <link rel="stylesheet" href="/admin/css/style.css">
    <!-- Bootstrap CSS -->
  </head>
 

  <body> 

  <section class=" ">
  <div class="ring ring_librairie">
    <i style="--clr:#2e00ff;"></i>
    <i style="--clr:#ff0057;"></i>
    <i style="--clr:#fffd44;"></i>
   

  <section id="our-program" class="our-programs-page">        
    <div class="text-center">
        <h1 style="color:#ffffff">OUR PROGRAMS</h1>
    </div>
   
    <div class="container ">
      <div class="row">
        <div class="col-md-6 offset-md-3 mt-4 text-center mb-4 text-center">
          <form action="" method="post">
            <label for="critere"></label>
            <input type="text" name="critere">
            <select name="type" ">
              <option value="prix">Prix</option>
              <option value="nom">Nom</option>
            </select>
            <button type="submit">Recherche</button>
          </form>
        </div>
      </div>
     </div>
  

    <div class="container">
      <div class="row card-deck">
      <!-- row pour englober les colonnes -->
        <?php foreach($recordset as $row){?>
         <!-- boucle foreach dans une div avec la classe row pour obtenir le comportement de la grille correct.-->
        <div class="col-md-3 mb-3">
          <!-- col-md-4 pour définir la largeur de chaque carte  -->
          <div class="card text-center">
            <?php if($row['product_image']!=''){ ?>
            <img src="<?="/upload/product/xs_".($row['product_image']);?>" class="card-img-top" 
            alt="...<?= htmlspecialchars($row['product_name']); ?>width=50">
            <?php }?>
            <!-- posibilite de mettre un else pour un affichage d'une image par defaut en cas de manquement dans la bd -->
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($row['product_name']); ?></h5>
              <h6 class="card-text"><?= htmlspecialchars($row['product_serie']); ?></h6>
              
              <a href="#"><h6 class="btn btn-lg btn-outline-warning "><?= htmlspecialchars($row['product_price']); ?></h6></a>


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
                  <span class="text">Suprimer</span>
              </a>

            </div>
          </div>
        </div>
        <?php } ?> 
      </div>
    </div>
          
    <ul class="pagination justify-content-center mt-3">
    <?php 
    // 1 Afficher le bouton "Précédent"
    $prev_page = max(1, $page - 1);//initialise une variable appelée $prev_page en utilisant la fonction max(). 
    //Elle calcule la valeur maximale entre 1 et la différence entre $page et 1. 
    //Ensuite, elle génère un lien de pagination pour la page précédente avec le symbole « (chevron gauche) 
    echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $prev_page . '">&laquo;</a></li>';

    // Afficher les liens de pagination par tranches de 15 pages
    $tranche = 20; // Nombre de pages par tranche
    $start_page = max(1, $page - floor($tranche / 2)); // Page de départ de la tranche
    $end_page = min($total_pages, $start_page + $tranche - 1); // Page de fin de la tranche

    // Afficher les liens de pagination pour la tranche actuelle
    for ($i = $start_page; $i <= $end_page; $i++) {
        echo '<li class="page-item';
        if ($i == $page) echo ' active'; // Mettre en surbrillance la page actuelle
        echo '"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
       //a voir la phot prise 
    }

    // Afficher le bouton "Suivant"
    $next_page = min($total_pages, $page + 1);
    echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $next_page . '">&raquo;</a></li>';
    ?>
    </ul>
  </section>
</section>

    <!-- jQuery -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <!-- Bootstrap JavaScript -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>  
  </body>
</html>
