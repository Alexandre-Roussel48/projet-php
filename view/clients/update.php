<form method="get" action="index.php">
    <fieldset>
        <input type='hidden' name='controller' value='clients'>
        <input type='hidden' name='action' value='updated'>

        <h1>MODIFIER MON PROFIL</h1>
        <fieldset>
            <legend>Informations obligatoires</legend>
            <p>
                <label for="nom">Nom</label> :
                <input type="text" placeholder="Gaston" name="nom" 
                    value="<?php echo($_SESSION['client']->get('nomClient'));?>" required/>
            </p>
            <p>
                <label for="prenom">Prénom</label> :
                <input type="text" placeholder="Lagaffe" name="prenom" 
                    value="<?php echo($_SESSION['client']->get('prenomClient'));?>" required/>
            </p>
        </fieldset>
        <fieldset>
            <legend>Informations complémentaires</legend>
            <p>
                <label for="adresse">Adresse</label> :
                <input type="text" placeholder="1 rue du sport 34000 Montpellier" name="adresse" 
                    value="<?php echo($_SESSION['client']->get('adresse'));?>"/>
            </p>
            <p>
                <label for="telephone">Numéro de téléphone</label> :
                <input type="text" placeholder="0123456789" name="telephone" 
                    value="<?php echo($_SESSION['client']->get('telephone'));?>"/>
            </p>
        </fieldset>

        <p>
            <input type="submit" value="Mettre à jour" />
        </p>
    </fieldset>
</form>