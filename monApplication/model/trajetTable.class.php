<?php
// Inclusion de la classe utilisateur
require_once "trajet.class.php";

class trajetTable {

  public static function getTrajet($depart,$arrivee)
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;

	$trajRepository = $em->getRepository('trajet');
	$traj = $trajRepository->findOneBy(array('depart' => $depart, 'arrivee' => $arrivee));	

	return $traj; 
	}

  
}


?>
