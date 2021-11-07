
<?php
    $modele = $p_m->get('modele'); $modeleHtml = htmlspecialchars($modele);
    $marque = $p_m->get('marque'); $marqueHTML = htmlspecialchars($marque);
    $prix = $p_m->get('prix'); $prixHTML = htmlspecialchars($prix);
    echo "Modèle : {$modeleHtml}, {$marqueHTML}, {$prixHTML}";
?>
