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
        <fieldset>
            <legend>Informations obligatoires</legend>
            <p>
                <label for="nom">Nom</label> :
                <input type="text" placeholder="Gaston" name="nom" 
                <?php
                    if(isset($nom)) echo 'value="'.$nom.'"';
                ?>required/>
            </p>
            <p>
                <label for="prenom">Prénom</label> :
                <input type="text" placeholder="Lagaffe" name="prenom" 
                <?php
                    if(isset($prenom)) echo 'value="'.$prenom.'"';
                ?>required/>
            </p>
            <p>
                <label for="mail">Adresse email</label> :
                <input type="text" placeholder="gaston.lagaffe@tutanota.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="mail" 
                <?php
                    if(isset($mail)) echo 'value="'.$mail.'"';
                ?>required/>
            </p>
            <p>
                <label for="mdp">Mot de passe</label> :
                <input type="password" name="mdp" 
                <?php
                    if(isset($mdp)) echo 'value="'.$mdp.'"';
                ?>required/>
            </p>
            <p>
                <label for="mdpVerif">Confirmation du mot de passe</label> :
                <input type="password" name="mdpVerif" 
                <?php
                    if(isset($mdpVerif)) echo 'value="'.$mdpVerif.'"';
                ?>required/>
            </p>
        </fieldset>
        <fieldset>
            <legend>Informations complémentaires</legend>
            <p>
                <label for="adresse">Adresse</label> :
                <input type="text" placeholder="1 rue du sport 34000 Montpellier" name="adresse" 
                <?php
                    if(isset($adresse)) echo 'value="'.$adresse.'"';
                ?>/>
            </p>
            <p>
                <label for="telephone">Numéro de téléphone</label> :
                <input type="text" placeholder="0123456789" name="telephone" 
                <?php
                    if(isset($telephone)) echo 'value="'.$telephone.'"';
                ?>/>
            </p>
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

        <p>
            <input type="submit" value="S'inscrire" />
        </p>
    </fieldset>
</form>

