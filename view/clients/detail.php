<?php
    $codeId = htmlspecialchars($p_m->get('codeClient')); 

    $nom = htmlspecialchars($p_m->get('nomClient')); 

    $prenom = htmlspecialchars($p_m->get('prenomClient')); 
    
    $mail = htmlspecialchars($p_m->get('mail')); 
    
    $adresse = htmlspecialchars($p_m->get('adresse')); 

    $telephone = htmlspecialchars($p_m->get('telephone')); 

    //$prixHTML = htmlspecialchars($prix);
    echo "Utilisateur : {$codeId}, {$nom}, {$prenom}, {$mail}, {$adresse}, {$telephone}";
?>
