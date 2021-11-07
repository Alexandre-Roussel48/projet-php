<form method="get" action="index.php">
  <fieldset>
    <legend>Mon formulaire :</legend>
    <input type='hidden' name='action' value='created'>
    <p>
      <label for="modele">Modèle</label> :
      <input type="text" placeholder="Allez Elite" name="modele" id="modele" required/>
    </p>
    <p>
      <label for="marque">Marque</label> :
      <input type="text" placeholder="Specialized" name="marque" id="marque" required/>
    </p>
    <p>
      <label for="prix">Prix</label> :
      <input type="text" placeholder="1499" name="prix" id="prix" required/>
    </p>
    <p>
      
      <input type="submit" value="Envoyer" />
    </p>
  </fieldset> 
</form>

