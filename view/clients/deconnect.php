<form method="get" action="index.php">
    <fieldset>
        <legend>Se déconnecter ?</legend>
        <input type='hidden' name='action' value='deconnect'>
        <input type='hidden' name='controller' value='clients'>

        <fieldset>
            <p>
                <input type="submit" name = "deconnect" value="yes" />
            </p>
            <p>
                <input type="submit" name = "deconnect" value="no" />
            </p>
    </fieldset>
</form>

