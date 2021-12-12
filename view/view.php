<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name= viewport content= width=device-width initial-scale=1.0>
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
                <label id="burger" for="toggle">☰</label>
                <input type="checkbox" id="toggle">
                <div class="normal"> 
                     <a href="index.php?controller=modeles&action=readAll">Tous les modèles</a>
                    <?php
                    if(isset($_SESSION['nom'])) {
                        echo '<a href="index.php?controller=clients&action=login">Se déconnecter</a>';
                        echo '<a href="index.php?controller=clients&action=read&client='.$_SESSION['client']->get('codeClient').'">Mon profil</a>';
                    } else {
                        echo '<a href="index.php?controller=clients&action=login">Se connecter</a>';
                        echo '<a href="index.php?controller=clients&action=create">S\'inscrire</a>';
                    }
                    if (isset($_SESSION['admin'])) {
                        echo '<a href="index.php?controller=clients&action=admin">Page admin</a>';
                    }
                    echo '<a href="index.php?controller=modeles&action=voirPanier">Mon panier</a>';
                    ?>
                </div>
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
                <div class="footer">
                    Choix du thème :
                    <form method="post" action="#" >
                        <button type="submit" name="theme" id="dark" value="Sombre">Sombre</button> 
                        <button type="submit" name="theme" id="light" value="Clair">Clair</button>  
                    </form>  
                </div>
                <p>  
                    Site d'e-commerce réalisé par 
                    <a href="https://github.com/Gatien-Depeyre">Gatien</a>, 
                    <a href="https://github.com/melanie-fressard">Mélanie</a>, 
                    <a href="https://github.com/BastienGavioli">Bastien</a> et 
                    <a href="https://github.com/Alexandre-Roussel48">Alexandre</a> !
                </p>
        </footer>
    </body>
</html>