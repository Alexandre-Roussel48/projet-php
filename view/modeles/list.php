
<?php
foreach ($tab_mod as $p_m) {
    $modele = $p_m->get('modele');
    $modeleHtml = htmlspecialchars($modele);
    $modeleUrl = rawurlencode($modele);
    echo '<p>Modèle : <a href="?controller=modeles&action=read&modele='.$modeleUrl.'">'.$modeleHtml.'</a></p>';
}
?>