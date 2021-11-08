<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
        <link rel="stylesheet" type="text/css" href="./view/css/style.css">
    </head>
    <body>
        <nav>
            <a href="index.php?controller=modeles&action=readAll">Tout les modèles</a>
            <a href="index.php?controller=utilisateur&action=readAll">Page d'accueil utilisateur</a>
        </nav>

<?php
$filepath = File::build_path(array("view", $controller, "$view.php"));
require $filepath;
?>
    </body>
    <footer>
        <p>
            Site d' e-commerce de Gatien, Mélanie, Bastien et Alexandre !
        </p>
    </footer>
</html>

