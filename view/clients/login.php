<form method="get" action="index.php">
    <fieldset>
        <legend>Se connecter : </legend>
        <input type="hidden" name="controller" value="clients">
        <input type='hidden' name='action' value='verification'>

        <fieldset>
            <legend>Informations obligatoires : </legend>
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
        <p>
            <input type="submit" value="Envoyer" />
        </p>
        <?php
            var_dump($c);
            echo '<p style="color:red;">Votre mail ou votre mot de passe est incorrect.</p>';
        ?>
    </fieldset>
</form>

