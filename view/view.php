<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
        <!--Gestion du thème-->
        <?php
        //Verification changement de thème
        if(isset($_GET['theme'])){
            echo("<!--changement de thème-->\n");
            setcookie("theme", $_GET['theme'], time()+3600);
        }

        //Appel du thème
        if(isset($_COOKIE['theme']) && ($_COOKIE['theme']=="white" || $_COOKIE['theme']=='white')){
            //setcookie("theme", "1", time()+3600);
            echo '<link rel="stylesheet" type="text/css" href="./view/css/white_style.css">';
        }
        else{
            //setcookie("theme", "0", time()+3600);
            echo '<link rel="stylesheet" type="text/css" href="./view/css/black_style.css">';
        }
        ?>
        <link rel="stylesheet" type="text/css" href="./view/css/style.css">
    </head>

    <body>

        <header>
            <nav>
                <div><a href="index.php?controller=modeles&action=readAll">Tous les modèles</a></div>
                <div><a href="index.php?controller=clients&action=readAll">Tous les clients</a></div>
                <?php
                if(isset($_SESSION['nom'])) {
                    echo '<div><a href="index.php?controller=clients&action=login">Se déconnecter</a></div>';
                    echo '<div><a href="#">Mon profil</a></div>';
                } else {
                    echo '<div><a href="index.php?controller=clients&action=login">Se connecter</a></div>';
                    echo '<div><a href="index.php?controller=clients&action=create">S\'inscrire</a></div>';
                }
                ?>
            </nav>
            <?php

            ?>
        </header>

        <main>
            <?php
            if(isset($_SESSION['nom'])) {
                echo '<p>Bonjour '.$_SESSION['prenom'].' '.$_SESSION['nom'].'</p>';
            }

            $filepath = File::build_path(array("view", $controller, "$view.php"));
            require_once $filepath;
            ?>
        </main>

        <footer>


                <div>
                    <form method="get" action="index.php">
                        Choix du thème :
                        <input type="submit" name="theme" id="theme" value="black" />
                        <input type="submit" name="theme" id="theme" value="white" />
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

