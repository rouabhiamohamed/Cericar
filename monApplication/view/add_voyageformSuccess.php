<?php
$userId = $_SESSION['utilisateur'];
if ($userId) {
?>

<div id="proposition">
    <h3>ajouter un voyage</h3>

    <label for="depart">ville de départ:</label>
    <input type="text" name="depart" id="depart" required>

    <label for="arrivee">ville d'arrivée</label>
    <input type="text" name="arrivee" id="arrivee" required>

    <label for="tarif">tarif:</label>
    <input type="text" name="tarif" id="tarif" required>

    <label for="nbplace">nombre de place:</label>
    <input type="text" name="nbplace" id="nbplace" required>
    
    <label for="heure">heure de départ:</label>
    <input type="text" name="heure" id="heure" required>

    <label for="contr">contraintes</label>
    <input type="text" name="contrainte" id="contr">

    <button id="addVoyage" data-user-id='<?php echo $userId; ?>' data-trajet-id='{"depart": "", "arrivee": ""}'>
        Ajouter ce voyage
    </button>
   
</div>

<?php
}
?>
