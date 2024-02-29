<?php
// Inclusion de la classe utilisateur
require_once "reservation.class.php";

class reservationTable {

  public static function getReservationByVoyage($voyage) 
	{
	$em = dbconnection::getInstance()->getEntityManager() ;

	$resRepository = $em->getRepository('reservation');
	$res = $resRepository->findBy(array('voyage' => $voyage));	
	
	
	if ($res == false){
		echo 'Erreur sql';
			   }
	return $res; 
	}
	public static function getReservationByUserAndVoyage($userId, $voyageId)
    {
        $entityManager = dbconnection::getInstance()->getEntityManager();
        $repository = $entityManager->getRepository('reservation');

        $reservation = $repository->findOneBy(['voyageur' => $userId, 'voyage' => $voyageId]);

        return $reservation;
    }
    public static function getReservationByUser($userId)
    {
        $entityManager = dbconnection::getInstance()->getEntityManager();
        $repository = $entityManager->getRepository('reservation');

        $reservation = $repository->findBy(['voyageur' => $userId]);

        return $reservation;
    }
    
   



    
    public static function annulerReservation($userId, $voyageId)
{
    $entityManager = dbconnection::getInstance()->getEntityManager();
    $repository = $entityManager->getRepository('reservation');

    // Trouver la réservation à annuler
    $reservation = $repository->findOneBy(['voyageur' => $userId, 'voyage' => $voyageId]);

    // Vérifier si la réservation existe
    if ($reservation) {
        // Supprimer la réservation
        $entityManager->remove($reservation);
        $entityManager->flush();

        // Mettre à jour le nombre de places disponibles dans le voyage
        $voyage = $reservation->voyage;
        $voyage->nbplace++;

        $entityManager->merge($voyage);
        $entityManager->flush();

        return true; // Annulation réussie
    }

    return false; // La réservation n'existe pas
}

  
}


?>
