<form method="get" action="index.php">

<input type='hidden' name='controller' value='produits'>
<input type='hidden' name='action' value='created'>
    <fieldset>
        <legend>Formulaire de création de vélo :</legend>
        <p>
            <p>
                <label for="modele_id">Modèle :</label>
                <select name="modele" id="taille_id" required>
                    <option selected value="0">Choisissez le modele</option>
                    <?php 
                    foreach($tab_mod as $m){
                        echo "<option value='".$m->get("modele")."'>".$m->get("modele")."</option>";
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="couleur_id">Couleur :</label>
                <input type="text" placeholder="bleue" name="couleur" id="couleur_id" required/>
            </p>
            <p>
                <label for="taille_id">Taille :</label>
                <select name="taille" id="taille_id" required>
                    <option selected value="0">Choisissez la taille</option>
                    <option value="20">20"</option>
                    <option value="24">24"</option>
                    <option value="26">26"</option>
                    <option value="27">27.5"</option>
                    <option value="29">29"</option>
                </select>
            </p>
            <p>
                <label for="stock_id">Stock Initial :</label>
                <input type="text" placeholder="100" name="stock" id="stock_id" required/>
            </p>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
            <input type='hidden' name='action' value='created'>
        </p>
    </fieldset>
</form>