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
//-----------------------------------------------DELETE----------------------------------------------------------
if(isset($_GET['id']) && $_GET['id']){
    $sql="DELETE FROM table_product WHERE product_id=:product_id";
    $stmt=$db->prepare($sql);
    $stmt->bindValue(':product_id', $_GET['id'], PDO::PARAM_INT);//binvalue permet le calcule de plusieur valeurs //PDO::PARAM_INT pour lui preciser que c'est un entier
    $stmt->execute(); //tout ce qui a etait vue plus haut se retrouve dans le dernier stmtProduct est executé puis 
}
header('Location:index.php');