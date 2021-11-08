<form method="get" action="index.php">
    <fieldset>
        <legend>S'inscrire : </legend>
        <input type='hidden' name='action' value='created'>
        <p>
            <label for="nom">Nom</label> :
            <input type="text" placeholder="Gaston" id="nom" required/>
        </p>

        <p>
            <label for="prenom">Prenom</label> :
            <input type="text" placeholder="Lagafe" name="Prenom" id="Prenom" required/>
        </p>

        <p>
            <label for="mail">Adresse mail</label> :
            <input type="text" placeholder="gaston.lagafe@tutanota.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
             name="mail" id="mail" required/>
        </p>
        <p>
            <label for="mdp">Mot de passe</label> :
            <input type="password" name="mdp" id="mdp" required/>
        </p>

        <p>
            <label for="adresse">Adresse</label> :
            <input type="text" placeholder="1 rue du sport 34000 Montpellier" name="adresse" id="adresse" required/>
        </p>

        <p>

            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>

