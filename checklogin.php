<?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/include/connect.php";

if(isset($_POST["login"])){
    $sql = "SELECT COUNT(*) as total FROM table_admin WHERE admin_login = :login";
    $stmt = $db->prepare($sql);
    $stmt->execute([':login' => $_GET["login"]]);
    $row = $stmt->fetch();
    echo $row['total'];
}
