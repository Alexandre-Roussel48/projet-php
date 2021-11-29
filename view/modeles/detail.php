
<?php
    $modele = $m->get('modele'); $modeleHtml = htmlspecialchars($modele);
    $marque = $m->get('marque'); $marqueHtml = htmlspecialchars($marque);
    $prix = $m->get('prix'); $prixHtml = htmlspecialchars($prix);
?>
<div style="margin-top: 20px; text-align: center;">
    <p style="margin-bottom: auto; font-weight: bold; text-transform: uppercase; font-size: 24px;"><?php echo "$marqueHtml - <em> $modeleHtml</em>";?>
    </p>
        <p style="margin: auto; font-size: 28px;">Prix : <?php echo "$prixHtml €"?></p>
</div>
    <?php echo "<p>Nombre de produits disponibles : ".count($tab_p)."</p>";?>
<ul>
    <?php
    foreach ($tab_p as $p) {
        $stock = $p->get('stock');  $stockHtml = htmlspecialchars($stock);
        $taille = $p->get('taille');    $tailleHtml = htmlspecialchars($taille);
        $couleur = $p->get('couleur');  $couleurHtml = htmlspecialchars($couleur);
        echo "<li> Quantité restante : {$stockHtml}. Taille : {$tailleHtml} pouces. Couleur : {$couleurHtml}. ";
        echo "<p><a href=\"index.php?controller=modeles&action=ajouterArticle&modele=$modeleHtml&prix=$prixHtml\">Ajouter au panier</a></li></p>";
    }
    ?>
</ul>
