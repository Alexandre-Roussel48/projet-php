<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>
        <a href="index.php?controller=modeles&action=readAll">Tout les modèles</a>
        <a href="index.php?controller=utilisateur&action=readAll">Page d'accueil utilisateur</a>
<?php
$filepath = File::build_path(array("view", $controller, "$view.php"));
require $filepath;
?>
    </body>
    <footer>
        <p style="border: 1px solid black;text-align:right;padding-right:1em;">
        Site d' e-commerce de Gatien, Mélanie, Bastien et Alexandre !
        </p>
    </footer>
</html>

