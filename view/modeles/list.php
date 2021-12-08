
<?php
echo '<div class="modelesMain">';
echo '<div class="modelesWrapper">';
foreach ($tab_mod as $m) {
    $modele = $m->get('modele');
    $marque = $m->get('marque');
    $modeleHtml = htmlspecialchars($modele);
    $marqueHtml = htmlspecialchars($marque);
    $modeleUrl = rawurlencode($modele);
    echo '<div class="modelesContainer"><a href="?controller=modeles&action=read&modele='.$modeleUrl.'">';
    if($m->get('image')===""){
        echo '<img src="./annexes/ressources/velo.png';
    } else{
        echo '<img src="./annexes/ressources/'.$m->get('image');
    }
    echo '" alt="Le '.$m->get('marque').' '.$m->get('modele').'" width="200" height="120" />';
    echo "<p>{$marqueHtml} - {$modeleHtml}</p></a></div>";
}
echo '</div>';
echo '</div>';
?>