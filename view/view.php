<!DOCTYPE html>
<html>

    <head>

        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
        <link rel="stylesheet" type="text/css" href="./view/css/style.css">

    </head>

    <body>

        <header>
            <nav>
                <div><a href="index.php?controller=modeles&action=readAll">Tous les modèles</a></div>
                <div><a href="index.php?controller=clients&action=readAll">Page d'accueil clients</a></div>
                <div><a href="index.php?controller=clients&action=login">Se connecter</a></div>
                <div><a href="index.php?controller=clients&action=create">S'inscrire</a></div>
            </nav>
            <?php
                if(isset($_SESSION['nom'])) {
                    echo '<p>Bonjour '.$_SESSION['prenom'].' '.$_SESSION['nom'].'</p>';
                }
            ?>
        </header>

        <main>
            <?php
            $filepath = File::build_path(array("view", $controller, "$view.php"));
            require $filepath;
            ?>
        </main>

        <footer>
            <p>Site d'e-commerce de Gatien, Mélanie, Bastien et Alexandre !</p>
        </footer>

    </body>
    
</html>

