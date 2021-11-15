<form method="get" action="index.php">
    <fieldset>
        <legend>Se connecter : </legend>
        <input type='hidden' name='action' value='login'>
            <p>
                <label for="mail">Adresse email</label> :
                <input type="text" placeholder="gaston.lagaffe@tutanota.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                       name="mail" id="mail" required/>
            </p>
            <p>
                <label for="mdp">Mot de passe</label> :
                <input type="password" name="mdp" id="mdp" required/>
            </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
