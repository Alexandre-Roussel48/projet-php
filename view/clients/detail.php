<fieldset>
    <h1>MON PROFIL</h1>
    <?php
        $codeId = htmlspecialchars($c->get('codeClient'));
        $nom = htmlspecialchars($c->get('nomClient'));
        $prenom = htmlspecialchars($c->get('prenomClient')); 
        $mail = htmlspecialchars($c->get('mail')); 
        $adresse = htmlspecialchars($c->get('adresse')); 
        $telephone = htmlspecialchars($c->get('telephone')); 

        echo "<fieldset><p>Code client : {$codeId}</p>"; 
        echo "<p>Nom : {$nom}</p>";
        echo "<p>Prénom : {$prenom}</p>";
        echo "<p>Adresse email utilisée : {$mail}</p></fieldset>";
        echo "<fieldset><p>Adresse : </p><p>{$adresse}</p>";
        echo "<p>Téléphone : {$telephone}</p></fieldset>";
        if(ModelClients::isAdmin($c->get('mail')))
            echo '<p style="color: red;">Possède le rôle Administateur</p>';
    ?>
</fieldset>