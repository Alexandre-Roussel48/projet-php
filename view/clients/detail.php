<?php
    $codeId = htmlspecialchars($c->get('codeClient')); 

    $nom = htmlspecialchars($c->get('nomClient')); 

    $prenom = htmlspecialchars($c->get('prenomClient')); 
    
    $mail = htmlspecialchars($c->get('mail')); 
    
    $adresse = htmlspecialchars($c->get('adresse')); 

    $telephone = htmlspecialchars($c->get('telephone')); 

    //$prixHTML = htmlspecialchars($prix);
    echo "Utilisateur : {$codeId}, {$nom}, {$prenom}, {$mail}, {$adresse}, {$telephone}";
?>
