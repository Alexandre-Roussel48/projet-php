
<?php
    $modele = $m->get('modele'); $modeleHtml = htmlspecialchars($modele);
    $marque = $m->get('marque'); $marqueHtml = htmlspecialchars($marque);
    $prix = $m->get('prix'); $prixHtml = htmlspecialchars($prix);
    
    echo "<p> Modèle : {$modeleHtml} Marque : {$marqueHtml} Prix : {$prixHtml} € </p>";

    foreach ($tab_p as $p) {
        $stock = $p->get('stock');  $stockHtml = htmlspecialchars($stock);
        $taille = $p->get('taille');    $tailleHtml = htmlspecialchars($taille);
        $couleur = $p->get('couleur');  $couleurHtml = htmlspecialchars($couleur);
        echo "<p> Quantité : {$stockHtml} Taille : {$tailleHtml} pouces Couleur : {$couleurHtml} </p>";
        echo "<a>Ajouter au panier</a>";
    }
?>
