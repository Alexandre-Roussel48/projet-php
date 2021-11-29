<p>Il ne vous reste plus qu'à rentrer le code que vous allez recevoir par mail sous peu</p>
<form method="get" action="index.php">

    <input type="hidden" name="controller" value="clients">
    <input type='hidden' name='action' value='verifNonce'>

    <p><label for="mail">Adresse email</label></p>
    <p><input type="text" placeholder="gaston.lagaffe@tutanota.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="mail">
      

    <p><label for="nonce">Code</label></p>
    <p><input type="text" placeholder="180975c06c2bfea3cbe42f1141d59a13" name="nonce">
      
</form>