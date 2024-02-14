
<!-- Permet la redirection  -->
<?php 
        include $_SERVER["DOCUMENT_ROOT"] . "/admin/include/protect.php";
        //possible que M.Brunelli utilise a la place du DOCUMENT_ROOT le  __ROOT__ 
       
?>

<!DOCTYPE html>
<html lang="EN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Title Page</title>
        <link rel="stylesheet" href="/admin/css/style.css">
                <!-- Bootstrap CSS -->
    </head>

    <body>
    
    <div class="ring">
  <i style="--clr:#2e00ff;"></i>
  <i style="--clr:#ff0057;"></i>
  <i style="--clr:#fffd44;"></i>

    <div class="login">
        <h2>Librairie</h2> 

        <div class="inputBx">
            <a href="product/">
                <input type="submit" value="Gestion des bandes dessinées">
            </a>
            </div>

            <div class="inputBx">
            <a href="logout/" >
                <input type="submit" value="Deconnexion">
            </a>
            </div>
        </div>
    </div>
        <!--ring div ends here-->

        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>  
    </body>
</html>