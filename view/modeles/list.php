
<?php
echo '<div class="modelesWrapper">';
foreach ($tab_mod as $m) {
    $modele = $m->get('modele');
    $marque = $m->get('marque');
    $modeleHtml = htmlspecialchars($modele);
    $marqueHtml = htmlspecialchars($marque);
    $modeleUrl = rawurlencode($modele);
    echo '<div class="modelesContainer"><a href="?controller=modeles&action=read&modele='.$modeleUrl.'">';
    echo '<img src="./annexes/ressources/'.$m->get('image');
    echo '" alt="Le '.$m->get('marque').' '.$m->get('modele').'" width="200" height="120" />';
    echo "<p>{$marqueHtml} - {$modeleHtml}</p></a></div>";
}
echo '</div>'
?>