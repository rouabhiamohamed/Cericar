<?php
// Inclusion de la classe utilisateur
require_once "voyage.class.php";

class voyageTable {

  public static function getVoyagesByTrajet($trajet) 
	{
  	$em = dbconnection::getInstance()->getEntityManager() ;

	$voyageRepository = $em->getRepository('voyage');
	//on recupere juste plusieur record  de la query
	$voyage = $voyageRepository->findBy(array('trajet' => $trajet));	
	
	
	return $voyage; 
	}
 public static function getVoyageById($id)
    {
        $entityManager = dbconnection::getInstance()->getEntityManager();
        $voyageRepository = $entityManager->getRepository('voyage');
        $voyage = $voyageRepository->findOneBy(array('id' => $id));	

        return $voyage;
    }
public static function getVoyagesByTrajetWithCondition($trajet, $avecEscale, $passengers)
{
    $voyages = self::getVoyagesByTrajet($trajet, $avecEscale);

    $filteredVoyages = array_filter($voyages, function ($voyage) use ($passengers) {
        return $voyage->nbplace >= $passengers;
    });

    return $filteredVoyages;
}

public static function proposerVoyage($trajet, $tarif, $heureDepart, $nombrePlaces, $contraintes, $conducteurId) {
    $em = dbconnection::getInstance()->getEntityManager();

    $voyage = new voyage();
    $voyage->trajet = $trajet;
    $voyage->heuredepart = $heureDepart;
    $voyage->nbplace = $nombrePlaces;
    $voyage->tarif = $tarif;
    $voyage->contraintes = $contraintes;

    // recuper l'id du conducteur
    $conducteurRepository = $em->getRepository('utilisateur');
    $conducteur = $conducteurRepository->findOneBy(['id' => $conducteurId]);
    $voyage->conducteur = $conducteur;

    $em->persist($voyage);
    $em->flush();

    return $voyage;
}
public static function getCorrespondenceWithEscale($departure, $passengers, $arrivalBackup, $avecEscale)
{
    try {
        $entityManager = dbconnection::getInstance()->getEntityManager()->getConnection();

        // la querey et ses mettre tout ses paremetres parametres
        $sql = 'SELECT * FROM search_voyage_rec_helper(:departure, :passengers, :arrivalBackup)';
        $query = $entityManager->prepare($sql);
        $query->bindValue(':departure', $departure, \PDO::PARAM_STR);
        $query->bindValue(':passengers', $passengers, \PDO::PARAM_INT);
        $query->bindValue(':arrivalBackup', $arrivalBackup, \PDO::PARAM_STR);



        // execution
        $bool = $query->execute();

        // Check if the query was successful
        if ($bool == false) {
            echo "<pre>Error executing the query</pre>";
            return NULL;
        }

        // retournber dans un tableau les resultat
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

    

        return $result;
    } catch (\PDOException $e) {
        echo "Error: " . $e->getMessage();
        return NULL;
    }
}




    public static function getVoyageDetailsById($voyageId) {
        $em = dbconnection::getInstance()->getEntityManager();
        $voyageRepository = $em->getRepository('voyage');
        $voyageDetails = $voyageRepository->findOneBy(array('id' => $voyageId));

        return $voyageDetails;
    }





}
?>
