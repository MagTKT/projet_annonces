<form method="post" action="index.php?controleur=utilisateur&action=validerLogin">
    <table border="1" cellpadding="15" class="position_table">
        <tr>
            <td>Email : <input type="text" name="email"></td>
        </tr>
        <tr>
            <td>Mot de passe : <input type="password" name="mdp"></td>
        </tr>
        <tr>
            <td><a href='index.php?controleur=utilisateur&action=mdpoublie'>mot de passe oublié</a>
            <input type="submit" value="Connexion"></td>
        </tr>
        <tr>
            <td>Vous n'avez pas de compte ? <a href='index.php?controleur=utilisateur&action=inscription'>Inscrivez-vous</a></td>
        </tr>
    </table>
</form>