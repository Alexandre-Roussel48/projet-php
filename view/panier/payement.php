
<p>
prix total : <?php echo("$prixTotal");?>
</p>

<form method="get" action="index.php">
<input type='hidden' name='action' value='paye'>
<input type='hidden' name='controller' value='modeles'>

<fieldset>
    <select name="modePayement">
        <option>--choisissez une option</option>
        <option value=0>En paypal</option>
        <option value=1>En liquide</option>
        <option value=2>Sur notre site</option>
    </select>
    <input type="submit" value="Valider">
</fieldset>
</form>


