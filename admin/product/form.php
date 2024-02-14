<!-- Si ont a un id alors c'est une modif -> alors preremplis et si on a un id alors c'est un ajout  -->
<!-----------------------------------------MODEL------------------------------------------------------------------- -->
<!-- Permet la redirection reecriture sur chaque fichier securisé-->
<?php 
        include $_SERVER["DOCUMENT_ROOT"] . "/admin/include/protect.php";
        //si l' USER n'as acun accés donc on utilise le protect puis 
        require_once $_SERVER["DOCUMENT_ROOT"]. "/admin/include/connect.php";

//----------------------------------------------------------------------------------------------------------
//
//
//
//
//-----------------------------------------------FORM- view----------------------------------------------------------
$product_name="";
$product_serie="";
$product_id=0;

if(isset($_GET['id']) && $_GET['id']>0){
    $sql="SELECT * FROM table_product WHERE product_id=:product_id";
    $stmt=$db->prepare($sql);
    $stmt->bindValue(':product_id', $_GET['id'], PDO::PARAM_INT);//binvalue permet le calcule de plusieur valeurs //PDO::PARAM_INT pour lui preciser que c'est un entier
    $stmt->execute(); //tout ce qui a etait vue plus haut se retrouve dans le dernier stmtProduct est executé puis 
    
    if($row=$stmt->fetch()){
        $product_name = $row['product_name'];
        $product_serie = $row['product_serie'];
        $product_id = $row['product_id'];
    }
}


?>
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

  <section class="login">
  <div class="ring ring_librairie">
    <i style="--clr:#2e00ff;"></i>
    <i style="--clr:#ff0057;"></i>
    <i style="--clr:#fffd44;"></i>
   
  <section id="our-program" class="our-programs-page">        
    <div class="text-center">
        <h1 style="color:#ffffff">OUR PROGRAMS FORMULAIRE</h1>
    </div>
   
    <div class="container ">
      <div class="row">
            <div class="col-md-6 offset-md-3 mt-4 text-center mb-4 text-center">
                <form action="process.php" method="post">

                <!-- <div class="inputBx"> -->
                    <label for="product_name" class="col-sm-2">Titre</label>
                    <input type="text" name="product_name" id="product_name" value="<?=htmlspecialchars($product_name)?>">
                </div><br>

                <!-- <div class="inputBx"> -->
                    <label for="product_serie" class="col-sm-2">Serie</label>
                    <input type="text" name="product_serie" id="product_serie" value="<?=htmlspecialchars($product_serie)?>">

                    <input type="hidden" name="product_id" value="<?=htmlspecialchars($product_id)?>">

                <!-- <div class="inputBx"> -->
                    <label for="product_price" class="col-sm-2">Prix</label>
                    <input type="number" name="product_price" id="product_price">
                </div> <br>   

                <div class="inputBx">
                    <a href="logout/" >
                        <input type="submit" value="Enregistré">
                    </a>
                </div>
                </form>
            </div>
        </div>
    </div>






   
  </section>
</section>

    <!-- jQuery -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <!-- Bootstrap JavaScript -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>  
  </body>
</html>
