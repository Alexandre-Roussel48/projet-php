
<?php
  if($_GET['action']=="created"){
    if(isset($_GET['modele'])){
      $modele = $_GET['modele']; 
    }
    if(isset($_GET['marque'])){
      $marque = $_GET['marque']; 
    }
    if(isset($_GET['prix'])){
      $prix = $_GET['prix']; 
    }
  }
?>

<form method="get" action="index.php">
  <fieldset>
    <legend>Mon formulaire :</legend>
    <input type='hidden' name='controller' value='modeles'>
    <input type='hidden' name='action' value='created'>
    <p>
      <label for="modele">Modèle</label> :
      <input type="text" placeholder="Allez Elite" name="modele" id="modele" <?php if(isset($_GET['modele']))echo 'value="'.$modele.'" '; ?>required/>
    </p>
    <p>
      <label for="marque">Marque</label> :
      <input type="text" placeholder="Specialized" name="marque" id="marque" <?php if(isset($_GET['marque'])) echo 'value="'.$marque.'" '; ?> required/>
    </p>
    <p>
      <label for="prix">Prix</label> :
      <input type="text" placeholder="1499" name="prix" id="prix" <?php if(isset($_GET['prix'])) echo 'value="'.$prix.'" '; ?> required/>
    </p>
    <p>
      
      <input type="submit" value="Envoyer" />
    </p>
  </fieldset> 
</form>

