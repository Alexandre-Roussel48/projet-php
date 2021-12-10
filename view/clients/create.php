<form method="get" action="index.php">
    <fieldset>
        <input type='hidden' name='controller' value='clients'>
        <input type='hidden' name='action' value='created'>

        <?php
            if(isset($_GET['nom'])){
                $nom = $_GET['nom'];
            } if(isset($_GET['prenom'])){
                $prenom = $_GET['prenom'];
            } if(isset($_GET['mail'])){
                $mail = $_GET['mail'];
            } if(isset($_GET['mdp'])){
                $mdp = $_GET['mdp'];
            } if(isset($_GET['mdpVerif'])){
                $mdpVerif = $_GET['mdpVerif'];
            } if(isset($_GET['adresse'])){
                $adresse = $_GET['adresse'];
            } if(isset($_GET['telephone'])){
                $telephone = $_GET['telephone'];
            }
        ?>
        <h1>S'INSCRIRE</h1>
        <fieldset class="inscription">
            <legend>Informations obligatoires</legend>
            <label for="nom">
                Nom :
                <input type="text" placeholder="Gaston" name="nom"
                   <?php
                       if(isset($nom)) echo 'value="'.$nom.'"';
                   ?>required/>
            </label>

            <label for="prenom">
                Prénom :
                <input type="text" placeholder="Lagaffe" name="prenom"
                   <?php
                       if(isset($prenom)) echo 'value="'.$prenom.'"';
                   ?>required/>
            </label>

            <label for="mail">
                Adresse email :
                <input type="text" placeholder="gaston.lagaffe@tutanota.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="mail"
                   <?php
                        if(isset($mail)) echo 'value="'.$mail.'"';
                   ?>required/>
            </label>

            <label for="mdp">
                Mot de passe :
                <input type="password" name="mdp"
                   <?php
                        if(isset($mdp)) echo 'value="'.$mdp.'"';
                   ?>required/>
            </label>

            <label for="mdpVerif">
                Confirmation du mot de passe :
                <input type="password" name="mdpVerif"
                   <?php
                        if(isset($mdpVerif)) echo 'value="'.$mdpVerif.'"';
                   ?>required/>
            </label>
        </fieldset>

        <fieldset class="inscription">
            <legend>Informations complémentaires</legend>
            <label for="adresse">
                Adresse :
                <input type="text" placeholder="1 rue du sport 34000 Montpellier" name="adresse"
                    <?php
                        if(isset($adresse)) echo 'value="'.$adresse.'"';
                    ?>/>
            </label>

            <label for="telephone">
                Numéro de téléphone :
                <input type="text" placeholder="0123456789" name="telephone"
                    <?php
                        if(isset($telephone)) echo 'value="'.$telephone.'"';
                    ?>/>
            </label>

        </fieldset>

        <?php
            if (isset($_SESSION['mdpVerif'])) {
                if ($_SESSION['mdpVerif']==0) {
                    echo "<p>Le mot de passe n'est pas identique !</p>";
                }
                unset($_SESSION['mdpVerif']);
            }
            if (isset($_SESSION['mailVerif'])) {
                if ($_SESSION['mailVerif']==0) {
                    echo '<p style="red;">Le mail est déjà utilisé !</p>';
                }
                unset($_SESSION['mailVerif']);
            }
        ?>

        <button class="butoon" type="submit">S'inscrire</button>
    </fieldset>
</form>

