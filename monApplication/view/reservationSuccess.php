<?php 
foreach($context->mavariable as $contexts){

echo "nom et prenom du conducteur ".$contexts->voyage->conducteur->nom." ".$contexts->voyage->conducteur->prenom." "."depart ".$contexts->voyage->trajet->depart." "."arrivee ".$contexts->voyage->trajet->arrivee." "."distance ".$contexts->voyage->trajet->distance." "."nom et prenom du voyageur ".$contexts->voyageur->nom." ".$contexts->voyageur->prenom."<br>";
}
 ?> 
