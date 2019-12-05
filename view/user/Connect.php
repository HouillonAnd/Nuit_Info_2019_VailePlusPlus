<form method="get" action="index.php">
    <fieldset>
        <input type='hidden' name='controller' value="user">
        <input type='hidden' name='action' value="connected">
        <legend>Se connecter</legend>
        <p>
            <label for="update_mail_input">Adresse e-mail</label> :
            <input type="email" name="mail" id="update_mail_input" required>
        </p>
            <label for="update_password_input">Mot de passe</label> :
            <input type="password" name="password" id="update_password_input" required>
        </p>
        <p>
            <input type="submit" value="Se connecter"/>
        </p>
    </fieldset>
</form>
