<form method="get" action="index.php">
    <fieldset>
        <legend>Formulaire de création de vélo :</legend>
        <p>
            <label for="modele_id">Modèle :</label>
            <input type="text" placeholder="CAAD Optimo 2" name="modele" id="modele_id" required/>

            <label for="couleur_id">Couleur :</label>
            <input type="text" placeholder="bleue" name="couleur" id="couleur_id" required/>

                <label for="taille_id">Taille :</label>
                <select name="taile" id="taille_id" required>
                    <option selected>Choisissez la taille</option>
                    <option value="20">20"</option>
                    <option value="24">24"</option>
                    <option value="26">26"</option>
                    <option value="27">27.5"</option>
                    <option value="29">29"</option>
                </select>

            <label for="stock_id">Stock Initial :</label>
            <input type="text" placeholder="100" name="stock" id="stock_id" required/>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
            <input type='hidden' name='action' value='created'>
        </p>
    </fieldset>
</form>