<fieldset>
    <?php
        if($peutModifier)
            echo "<h1>MON PROFIL</h1>";
        else
            echo "<h1>PROFIL DU CLIENT</h1>";
        
        $nom = $c->get('nomClient');
        $prenom = $c->get('prenomClient'); 
        $mail = $c->get('mail');
        $adresse = $c->get('adresse'); 
        $telephone = $c->get('telephone'); 

        echo "<p>Nom : {$nom}</p>";
        echo "<p>Prénom : {$prenom}</p>";
        echo "<p>Adresse email utilisée : {$mail}</p>";

        if(ModelClients::isAdmin($c->get('mail')))
            echo '<p style="color: #DB4437;">Possède le rôle Administateur</p>';
        echo "</fieldset>";
        echo "<fieldset><p>Adresse ";
        if($c->get('adresse')!=="") 
            echo "</p><p>{$adresse}</p>";
        else
            echo "<em>: non renseignée</em></p>";
        if($c->get('telephone')!=="")
            echo "<p>Téléphone : {$telephone}</p></fieldset>";
        else
            echo "<p>Téléphone : <em>non renseigné</em></p></fieldset>";
        
        if($peutModifier){
            echo '<a href="index.php?controller=clients&action=update" class="bouton">Modifier profil</a>';
            echo '<a href="index.php?controller=produits&action=history" class="bouton">Voir mon historique d\'achat</a>';
        }
        

    ?>
</fieldset>