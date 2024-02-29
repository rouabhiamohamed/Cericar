<?php 
foreach($context->mavariable as $contexts){

echo $contexts->id." "."nom et prenom du conducteur ".$contexts->conducteur->nom." ".$contexts->conducteur->prenom." "."id du trajet ".$contexts->trajet->id." "."le tarif ".$contexts->tarif." "."nombre d eplaces ".$contexts->nbplace." "."heure du depart ".$contexts->heuredepart." "."les contraintes ".$contexts->contraintes."<br>";
}
 ?> 
