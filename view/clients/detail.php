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
                echo '<form method="get" style="text-align: center; "action="index.php">';
                echo '<input type="hidden" name="controller" value="clients">';
                echo '<input type="hidden" name="action" value="update">';
                echo '<input type="submit" name="update" id="update" value="Modifier profil">';
                echo '</form>';
        }
    ?>
</fieldset>