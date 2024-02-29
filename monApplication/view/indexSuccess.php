<?php
// Check if a user is logged in
if (isset($_SESSION['utilisateur'])) {
    $userId = $_SESSION['utilisateur'];
    $user = utilisateurTable::getUserById($userId);

    echo "<div class='user-info' id='avatar-button'>";
    echo "<a href='#' class='avatar-link' id='profileButton'>";
    echo "<img src='" . ($user->avatar ? $user->avatar : 'https://pedago.univ-avignon.fr/~uapv2203662/projet_dbweb/squelette_L3/images/image-attractive.jpg') . "' alt='Avatar'>";
    echo "</a>";
    echo "</div>";
}

echo "<div id='all'>";
echo "<nav>";
echo "<button type='button' id='accueilButton'>Accueil</button>";
echo "<button type='button' id='accesFormulaireButton'>Accès formulaire</button>";


if (isset($_SESSION['utilisateur'])) {
    echo "<div id='buttons'>";
echo "<button type='button' id='proposerVoyageButton'>Proposer un voyage</button>";
    echo "<button type='button' id='deconnexionButton'>Se déconnecter</button>";
    echo "</div>";
    
} 


else {
    echo "<div id='con'>";
    echo "<button type='button' id='connexionformulaire'>Connexion</button>";
    echo "<button type='button' id='inscrireButton'>inscription</button>";
    echo "</div>";
}

echo "</nav>";

echo "<div id='content'></div>";
echo "<div id='profile-content'></div>";

echo "</div>";
?>
