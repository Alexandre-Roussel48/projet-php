<?php
foreach ($tab_cli as $c) {

    $codeClient = $c->get('codeClient');
    $codeClientUrl = rawurlencode($codeClient);

    $nomClient = $c->get('nomClient');
    $prenomClient = $c->get('prenomClient');

    echo "<p>Client : {$nomClient} {$prenomClient} <a href=\"?controller=clients&action=read&client={$codeClientUrl}\">Détail du client</a></p>";
}
?>


