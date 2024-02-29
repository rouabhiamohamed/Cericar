<?php
if (count($context->voyage) != 0) {
    echo "<table class='voyage-table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Conducteur</th>";
    echo "<th>Distance</th>";
    echo "<th>Tarif</th>";
    echo "<th>Nombre de Places</th>";
    echo "<th>Heure de Départ</th>";
    echo "<th>Contraintes</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($context->voyage as $contexts) {
        echo "<tr class='voyage-item'>";
    
        echo "<td>" . $contexts->conducteur->nom . " " . $contexts->conducteur->prenom . "</td>";
        echo "<td>" . $contexts->trajet->distance ." "."km" . "</td>";
        echo "<td>" . $contexts->tarif . "</td>";
        echo "<td>" . $contexts->nbplace . "</td>";
        echo "<td>" . $contexts->heuredepart . "</td>";
        echo "<td>" . $contexts->contraintes . "</td>";
        if (isset($_SESSION['utilisateur'])) {
echo "<td><button class='reservationButton' data-voyage-id='{$contexts->id}'>Réserver</button></td>";

        }

        echo "</tr>";
    }


    echo "</tbody>";
    echo "</table>";
} 
else {
   echo "<p class='no-voyage'>Aucun voyage</p>";
}
?>
