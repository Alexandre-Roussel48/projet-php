<?php
    $modele = $m->get('modele'); $modeleHtml = htmlspecialchars($modele);
    $marque = $m->get('marque'); $marqueHtml = htmlspecialchars($marque);
    $prix = $m->get('prix'); $prixHtml = htmlspecialchars($prix);
?>
<div style="text-align: center;">
    <p style="margin-bottom: auto; font-weight: bold; text-transform: uppercase; font-size: 24px;"><?php echo "$marqueHtml - <em> $modeleHtml</em>";?>
    </p>
        <p style="margin: auto; font-size: 28px;">Prix : <?php echo "$prixHtml €"?></p>
</div>
<div id="aside-container">
    <div class="aside" id="gauche">
        <?php
            echo '<img src="./annexes/ressources/'.$m->get('image').'" alt="'.$marque.' '.$modele.'" />';
        ?>
    </div>
    <div class="aside" id="droite">
        <?php
        if($tab_p!==false){ //Si il y a des produits on les affiches
            echo "<p>Nombre de produits disponibles : ".count($tab_p)."</p>";?>
    <ul>
        <?php
            foreach ($tab_p as $p) {
                $codeProduit = $p->get('codeProduit'); $codeProduitUrl = urlencode($codeProduit);
                $stock = $p->get('stock');
                $taille = $p->get('taille');
                $couleur = $p->get('couleur');
                echo "<li> Quantité restante : {$stock}. Taille : {$taille} pouces. Couleur : {$couleur}. ";
                echo "<p><a href=\"index.php?controller=modeles&action=ajouterArticle&codeProduit=$codeProduitUrl\">Ajouter au panier</a></li></p>";
            }
        } else{
                //Si il n'y a pas de produits
                echo "<p>Il n'y a pas de produit disponible pour ce modele</p>";
        }
        ?>
    </ul>
    <?php
        if(isset($_SESSION['admin'])){
            echo("<p><a href='index.php?controller=modeles&action=deleteModele&codeModele=".$m->get('modele')."'>Supprimer le modele </a></p>");
        }
    ?>
    </div>
</div>