<form method="get" action="index.php">
    <fieldset>
        <input type="hidden" name="controller" value="clients">
        <input type='hidden' name='action' value='verification'>

        <?php
            if($_GET['action']=="verification"){
                $email = $_GET['mail'];
                $mdp = $_GET['mdp'];
            }
        ?>
        <h1>SE CONNECTER</h1>
        <p><label for="mail">Adresse email</label></p>
        <p><input type="text" placeholder="gaston.lagaffe@tutanota.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="mail"
        <?php
            if(isset($email)) echo ' value="'.$email.'"';
        ?> required/>
        </p>

        <p><label for="mdp">Mot de passe</label></p>
        <p><input type="password" name="mdp" 
        <?php
            if(isset($mdp)) echo 'value="'.$mdp.'"';
        ?>
        required/></p>
        <p><input type="submit" value="Connexion" /></p>
    </fieldset>
    <fieldset>
        <h3>Vous n'avez pas de compte ?</h3>
        <p><a href="index.php?controller=clients&action=create" id="createAccount">Créer un compte</a></p>
        <?php
            if($_GET['action']=="verification") {
                echo '<p style="color:red;">Votre email ou votre mot de passe est incorrect.</p>';
            }
        ?>
    </fieldset>
</form>

