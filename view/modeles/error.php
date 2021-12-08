<?php
    if(!isset($erreur)){
        $erreur = 'inconnu';
    }
    echo "<p>Erreur : $erreur</p> 
    <p><a href='?controller=modeles&action=readAll'>Retour</a></p>";
?>
