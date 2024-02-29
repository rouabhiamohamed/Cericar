<div id="loginSection">
    <?php if (!isset($_SESSION['utilisateur'])): ?>
        <h3>Connexion</h3>
       
            <label for="identifiant">Identifiant:</label>
            <input type="text" name="identifiant" id="loginIdentifiant" required>

            <label for="pass">Mot de passe:</label>
            <input type="password" name="pass" id="loginPass" required>

            <button type="button" id="connexionButton">Se connecter</button>
    <?php else: ?>
        <button type="button" id="deconnexionButton">Se déconnecter</button>
    <?php endif; ?>
</div>
