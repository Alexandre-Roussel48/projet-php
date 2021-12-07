<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
        <!--Gestion du thème-->
        <?php

        if (isset($_POST['theme'])) {
            setcookie("theme", $_POST['theme'], time()+3600);
            echo "<link rel='stylesheet' type='text/css' href='./view/css/style".$_POST['theme'].".css'>";
        } else if (isset($_COOKIE['theme'])) {
            echo "<link rel='stylesheet' type='text/css' href='./view/css/style".$_COOKIE['theme'].".css'>";
        } else {
            echo '<link rel="stylesheet" type="text/css" href="./view/css/styleClair.css">';
        }
        ?>
        <link rel="stylesheet" type="text/css" href="./view/css/style.css">
    </head>

    <body>

        <header>
            <nav>
                <div><a href="index.php?controller=modeles&action=readAll">Tous les modèles</a></div>
                <?php
                if(isset($_SESSION['nom'])) {
                    echo '<div><a href="index.php?controller=clients&action=login">Se déconnecter</a></div>';
                    echo '<div><a href="index.php?controller=clients&action=read&client='.$_SESSION['client']->get('codeClient').'">Mon profil</a></div>';
                } else {
                    echo '<div><a href="index.php?controller=clients&action=login">Se connecter</a></div>';
                    echo '<div><a href="index.php?controller=clients&action=create">S\'inscrire</a></div>';
                }
                if (isset($_SESSION['admin'])) {
                    echo '<div><a href="index.php?controller=clients&action=admin">Page admin</a></div>';
                }
                echo '<div><a href="index.php?controller=modeles&action=voirPanier">Mon panier</a></div>';
                ?>
            </nav>
        </header>

        <main>
            <?php
            if(isset($_SESSION['nom'])) {
                echo '<p>Bonjour '.$_SESSION['prenom'].' '.$_SESSION['nom'].'</p>';
            }
            require_once File::build_path(array("view", $controller, "$view.php"));
            ?>
        </main>

        <footer>


                <div>
                    <form method="post" action="#">
                        Choix du thème :
                        <input type="submit" name="theme" id="theme" value="Sombre" />
                        <input type="submit" name="theme" id="theme" value="Clair" />
                    </form>  
                </div>
                <div>  
                    Site d'e-commerce réalisé par 
                    <a href="https://github.com/Gatien-Depeyre">Gatien</a>, 
                    <a href="https://github.com/melanie-fressard">Mélanie</a>, 
                    <a href="https://github.com/BastienGavioli">Bastien</a> et 
                    <a href="https://github.com/Alexandre-Roussel48">Alexandre</a> !
                </div>
        </footer>

    </body>
    
</html>

