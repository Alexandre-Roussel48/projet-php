<?php

var_dump($tab_mod);
foreach ($tab_mod as $c) {
    $client = $c->get('client');
    $clientHtml = htmlspecialchars($client);
    $clientUrl = rawurlencode($client);
    echo '<p>Client : <a href="?controller=clients&action=read&modele='.$clientUrl.'">'.$clientHtml.'</a></p>';
}
?>


