<form method="get" action="index.php">
    <fieldset>
        <legend>S'inscrire : </legend>
        <input type='hidden' name='action' value='created'>
        <input type='hidden' name='controller' value='clients'>

        <fieldset>
            <legend>Informations obligatoires : </legend>
            <p>
                <label for="nom">Nom</label> :
                <input type="text" placeholder="Gaston" name = "nom" id="nom" required/>
            </p>
            <p>
                <label for="prenom">Prénom</label> :
                <input type="text" placeholder="Lagaffe" name="prenom" id="prenom" required/>
            </p>
            <p>
                <label for="mail">Adresse email</label> :
                <input type="text" placeholder="gaston.lagaffe@tutanota.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                       name="mail" id="mail" required/>
            </p>
            <p>
                <label for="mdp">Mot de passe</label> :
                <input type="password" name="mdp" id="mdp" required/>
            </p>
        </fieldset>
        <fieldset>
            <legend>Informations complémentaires :</legend>
            <p>
                <label for="adresse">Adresse</label> :
                <input type="text" placeholder="1 rue du sport 34000 Montpellier" name="adresse" id="adresse"/>
            </p>
            <p>
                <label for="telephone">Numéro de téléphone</label> :
                <input type="text" placeholder="0123456789" name="telephone" id="telephone"/>
            </p>
        </fieldset>

        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>

