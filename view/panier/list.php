
<h2>Voici votre panier</h2>
<?php
if($panierVide){
    echo("<p>Votre panier est vide</p>");
}
else{
    foreach ($tab_mod as $m) {
        $modele = $m->get('modele');
        $modeleHtml = htmlspecialchars($modele);
        $modeleUrl = rawurlencode($modele);
        echo '<p>Modèle : <a href="?controller=modeles&action=read&modele='.$modeleUrl.'">'.$modeleHtml.'</a></p>';

    }
        echo("<p>Prix total : $prixTotal</p>");
    
    echo('<h3><a href="?controller=modeles&action=validerCommande">Valider la commande</a></h3>');
}
?>

