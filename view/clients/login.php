<form method="get" action="index.php">
    <fieldset>
        <input type="hidden" name="controller" value="clients">
        <input type='hidden' name='action' value='verification'>

        <?php
            if($_GET['action']=="verification" && isset($_GET['mail']) && isset($_GET['mdp'])){
                $email = $_GET['mail'];
                $mdp = $_GET['mdp'];
            }
        ?>
        <h1>SE CONNECTER</h1>

        <label for="mail">
            Adresse email :
            <input type="text" placeholder="gaston.lagaffe@tutanota.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="mail" id="mail"
                <?php
                    if(isset($email)) echo ' value="'.$email.'"';
                ?> required/>
        </label>

        <label for="mdp">
            Mot de passe :
            <input type="password" name="mdp" id="mdp"
                <?php
                    if(isset($mdp)) echo 'value="'.$mdp.'"';
                ?>required/>
        </label>
        <button type="submit">Connexion</button>
    </fieldset>

    <fieldset class="createAccount">
        <h3>Vous n'avez pas de compte ou un compte non activé ?</h3>
        <p><a href="index.php?controller=clients&action=create">Créer un compte</a></p>
        <p><a href="index.php?controller=clients&action=verifNonce">Activer son compte</a></p>
        <?php
            if($_GET['action']=="verification") {
                echo '<p style="color:red;">Votre email ou votre mot de passe est incorrect.</p>';
            }
        ?>
    </fieldset>
</form>

