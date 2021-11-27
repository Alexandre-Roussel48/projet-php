<form method="get" action="index.php">
    <fieldset>
        <input type="hidden" name="controller" value="clients">
        <input type='hidden' name='action' value='verification'>

        <h1>Se connecter</h1>
        <p><label for="mail">Adresse email</label></p>
        <p><input type="text" placeholder="gaston.lagaffe@tutanota.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                   name="mail" id="mail" required/>
        </p>
        <p><label for="mdp">Mot de passe</label></p>
        <p><input type="password" name="mdp" id="mdp" required/></p>

        <p><input type="submit" value="Connexion" /></p>
        <?php
            if($_GET['action']=="verification") {
                echo '<p style="color:red;">Votre email ou votre mot de passe est incorrect.</p>';
            }
        ?>
    </fieldset>
</form>

