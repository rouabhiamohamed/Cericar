<div id="form">
    <h3>Rechercher un Voyage</h3>
    <label for="depart">Départ:</label>
    <input type="text" name="depart" id="depart" required>

    <label for="arrivee">Arrivée:</label>
    <input type="text" name="arrivee" id="arrivee" required>

    <label for="avecEscale">Avec Escale</label>
    <input type="checkbox" name="avecEscale" id="avecEscale">

    <label for="passengers">Nombre de Passagers:</label>
    <input type="number" name="passengers" id="passengers" min="1" value="1" required>

    <br>
    <br>

    <button id="button">Rechercher</button>

    <div id="voyage"></div>
</div>
