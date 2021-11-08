
<?php
    $modele = $m->get('modele'); $modeleHtml = htmlspecialchars($modele);
    $marque = $m->get('marque'); $marqueHTML = htmlspecialchars($marque);
    $prix = $m->get('prix'); $prixHTML = htmlspecialchars($prix);
    echo "Modèle : {$modeleHtml}, {$marqueHTML}, {$prixHTML}";
?>
