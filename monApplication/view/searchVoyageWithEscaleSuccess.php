<?php
if (!is_null($context->voyageDetailsArray)) {
    echo "<div class='success-message'>Resultats:</div>";
    echo "<div class='result-container'>";

    // Afficher chaque proposition 
    foreach ($context->voyageDetailsArray as $propo => $detailsArray) {
        echo "<div class='propo-container'>";
        echo "<p>Proposition: {$propo}</p>";
// les détails de chaque proposition
        foreach ($detailsArray as $details) {
            echo "<div class='voyage-container' '>";
             echo "<p>ville depart: {$details->trajet->depart} </p>";
            echo "<p>Voyage ID: , Conductor: {$details->conducteur->nom} {$details->conducteur->prenom}</p>";
            echo "<p>Distance: {$details->trajet->distance} km</p>";
            echo "<p>Tarif: {$details->tarif}</p>";
            echo "<p>Nombre de Places: {$details->nbplace}</p>";
            echo "<p>Heure de Départ: {$details->heuredepart}</p>";
            echo "<p>Contraintes: {$details->contraintes}</p>";
             echo "<button class='reservationButton' data-voyage-id='{$details->id}'>Réserver</button>";
            echo "</div>";
        }

       

        echo "</div>";
    }

    echo "</div>";
} else {
    echo "<div class='error-message'>{$context->errorMessage}</div>";
}
?>
