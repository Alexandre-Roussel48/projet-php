
<?php
foreach ($tab_mod as $m) {
    $modele = $m->get('modele');
    $modeleHtml = htmlspecialchars($modele);
    $modeleUrl = rawurlencode($modele);
    echo '<div class="modelContainer"><a href="?controller=modeles&action=read&modele='.$modeleUrl.'">';
    echo '<img src="./annexes/ressources/'.$m->get('image');
    echo '" alt="Le '.$m->get('marque').' '.$m->get('modele').'" width="200" height="120" />';
    echo "<p>{$modeleHtml}</p></a></div>";
}
?>