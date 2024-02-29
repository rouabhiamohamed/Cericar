<?php
foreach ($context->reservations as $reservation) {
	echo "<div class='reservation-item'>";
    echo "Nom et prénom du conducteur: " . $reservation->voyage->conducteur->nom . " " . $reservation->voyage->conducteur->prenom . "<br>";
    echo "Départ: " . $reservation->voyage->trajet->depart . "<br>";
    echo "Arrivée: " . $reservation->voyage->trajet->arrivee . "<br>";
    echo "Distance: " . $reservation->voyage->trajet->distance . " km<br>";
    echo "Nom et prénom du voyageur: " . $reservation->voyageur->nom . " " . $reservation->voyageur->prenom . "<br>";

  echo "</div>";
    $userId = $_SESSION['utilisateur'];
    if ($userId == $reservation->voyageur->id) {
     
echo "<button id='cancelButton' data-reservation-id='{$reservation->id}' data-voyage-id='{$reservation->voyage->id}'>Annuler la réservation</button><br>";
    }

    echo "<br>";
}
?>
