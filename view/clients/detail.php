<fieldset>
    <h1>MON PROFIL</h1>
    <?php
        $nom = htmlspecialchars($c->get('nomClient'));
        $prenom = htmlspecialchars($c->get('prenomClient')); 
        $mail = htmlspecialchars($c->get('mail'));
        $adresse = htmlspecialchars($c->get('adresse')); 
        $telephone = htmlspecialchars($c->get('telephone')); 

        echo "<p>Nom : {$nom}</p>";
        echo "<p>Prénom : {$prenom}</p>";
        echo "<p>Adresse email utilisée : {$mail}</p></fieldset>";
        echo "<fieldset><p>Adresse ";
        if($c->get('adresse')!=="") 
            echo "</p><p>{$adresse}</p>";
        else
            echo "<em>: non renseignée</em></p>";
        if($c->get('telephone')!=="")
            echo "<p>Téléphone : {$telephone}</p></fieldset>";
        else echo "<p>Téléphone : <em>non renseignée</em></p></fieldset>";
        
        if(ModelClients::isAdmin($c->get('mail')))
            echo '<p style="color: red;">Possède le rôle Administateur</p>';
    ?>
    <form method="get" action="index.php">
        <input type='hidden' name='controller' value='clients'>
        <input type='hidden' name='action' value='update'>
        <input type="submit" name="update" id="update" value="Modifier profil">
    </form>
</fieldset>