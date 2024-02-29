<?php

class mainController
{

	public static function helloWorld($request,$context)
	{
		$context->mavariable="hello world";
		$context->notification="hello world";
		return context::SUCCESS;
	}



	public static function index($request,$context){
		
		return context::SUCCESS;
	}
	
	public static function SuperTest($request,$context){
		$context->notification="Super Test";
	
			$context->mavariable=" j’ai compris ".$request['variable1'].
" super : ".$request['variable2'];
		   return context::SUCCESS;
	}
	
	
	//on recupere l'utilisateur par son login et mdp
	
	public static function login($request,$context){

$context->mavariable=utilisateurTable::getUserByLoginAndPass('User1','0bc8658ea4e2f64af9d6890eace91a819f9f2046');


		   return context::SUCCESS;
	}
	
	//on recupere le trajet l'heure du depart et arrivee
		public static function trajet($request,$context){

$context->mavariable=trajetTable::getTrajet($request['depart'],$request['arrivee']);


		   return context::SUCCESS;
	}
	
	//on recupere le voyage par l'id du trajet
		public static function voyage($request,$context){

$context->mavariable=voyageTable::getVoyagesByTrajet($request['trajet']);

		   return context::SUCCESS;
	}
			public static function voyageID($request,$context){

$context->mavariable=voyageTable::getVoyageById($request['id']);

		   return context::SUCCESS;
	}
	
	//rechercher le voyage
public static function searchVoyage($request, $context)
{
    $depart = $request['depart'];
    $arrivee = $request['arrivee'];
    $passengers = isset($request['passengers']) ? intval($request['passengers']) : 0;

    $context->tarjet = trajetTable::getTrajet($depart, $arrivee);

    // sans escale
    $context->voyage = voyageTable::getVoyagesByTrajetWithCondition($context->tarjet, false, $passengers);

    return context::SUCCESS;
}
public static function searchVoyageWithEscale($request, $context) {
    $depart = $request['depart'];
    $arrivee = $request['arrivee'];
    $passengers = isset($request['passengers']) ? intval($request['passengers']) : 0;

    // les informations du voyage
    $voyageResult = voyageTable::getCorrespondenceWithEscale($depart, $passengers, $arrivee, true);

    // si chemin existe
    if (!empty($voyageResult)) {
        $counter = 1;

        // details pour recuper les details de chaque voyaghe
        $voyageDetailsArray = [];

        
        foreach ($voyageResult as $result) {
            if (!empty($result['chemin'])) {
                // pour recuper les ids
                $voyageIdsArray = [];
                foreach (explode('-', $result['chemin']) as $chemin) {
					//le convertir en integer
                    $voyageId = is_numeric($chemin) ? (int)$chemin : 0;

                    // recuperer tout les details
                    $voyageDetails = voyageTable::getVoyageDetailsById($voyageId);

                    // si les details son present
                    if ($voyageDetails) {
                        // rajouter les detail pour chaque id
                        $voyageDetailsArray[$counter][] = $voyageDetails;
                    }
                }

                $counter++;
            }
        }

        // pour l'affichage
        $context->voyageDetailsArray = $voyageDetailsArray;
    } 

    return context::SUCCESS;
}






		//acceder au formulaire
		
		public static function access_formulaire ($request,$context){
		
			 return context::SUCCESS;
			}
				public static function inscription_formulaire ($request,$context){
		
			 return context::SUCCESS;
			}
			
public static function inscription($request, $context) {
    $identifiant = $request['identifiant'];
    $pass = $request['pass'];
    $nom = $request['nom'];
    $prenom = $request['prenom'];
    $avatar = $request['avatar'];

    $existingUser = utilisateurTable::getUserByLoginAndPass($identifiant, sha1($pass));

    if ($existingUser) {
        return context::ERROR;
    }

    $nouvelUtilisateur = utilisateurTable::createUser($identifiant, $pass, $nom, $prenom, $avatar);

    $context->nouvelUtilisateur = [
        'nom' => $nouvelUtilisateur->nom,
        'prenom' => $nouvelUtilisateur->prenom
    ];

    return context::SUCCESS;
}

public static function connexion_formulaire ($request,$context){
		
			 return context::SUCCESS;
			}
	
	public static function connexion($request, $context) {
    $identifiant = $request['identifiant'];
    $pass = $request['pass'];
    $utilisateur = utilisateurTable::getUserByLoginAndPass($identifiant, $pass);
    if ($utilisateur) {
     
        $_SESSION['utilisateur'] = $utilisateur->id;
        $context->utilisateurConnecte = $utilisateur;
        return context::SUCCESS;
    } else {
    
        return context::ERROR;
    }
}
public static function deconnexion($request, $context) {
   
    return context::SUCCESS;
}
	
	//on recupere la reservation par l'id du voyage
		public static function reservation($request,$context){

$context->mavariable=reservationTable::getReservationByVoyage($request['voyage']);

		   return context::SUCCESS;
	}
	
	//on recupere l'utilisateur par son id
		public static function id($request,$context){

$context->mavariable=utilisateurTable::getUserById($request['id']);

		   return context::SUCCESS;
	}
	
public static function reserver($request, $context) {
    $userId = $_SESSION['utilisateur'];

    // Vérifier si l'utilisateur est connecté
    if (!isset($userId)) {
        $context->error = "Vous devez être connecté pour effectuer une réservation.";
        return context::ERROR;
    }

    // Récupérer l'id du voyage à réserver depuis la requête
    $voyageId = $request['voyage'];
    try {
        // Utiliser la fonction voyageID pour obtenir le voyage
        $voyage = voyageTable::getVoyageById($voyageId);

        // Vérifier si le voyage existe
        if (!$voyage) {
            $context->error = "Le voyage n'existe pas.";
            return context::ERROR;
        }

        // Récupérer l'utilisateur
        $user = utilisateurTable::getUserById($userId);

        // Vérifier si l'utilisateur existe
        if (!$user) {
            $context->error = "L'utilisateur n'existe pas.";
            return context::ERROR;
        }

      

        // Vérifier s'il y a des places disponibles dans le voyage
        if ($voyage->nbplace <= 0) {
            $context->error = "Il n'y a plus de places disponibles pour ce voyage.";
            return context::ERROR;
        }

        // Créer une nouvelle réservation
        $reservation = new reservation();
        $reservation->voyage = $voyage;
        $reservation->voyageur = $user;

        // Mettre à jour le nombre de places disponibles dans le voyage
        $voyage->nbplace--;

        // Enregistrer les modifications dans la base de données
        $entityManager = dbconnection::getInstance()->getEntityManager();
        $entityManager->persist($reservation);
        $entityManager->merge($voyage);
        $entityManager->flush();

        // Réservation réussie
        return context::SUCCESS;

    } catch (Exception $e) {
        // Gérer les exceptions
        $context->error = "Une erreur s'est produite : " . $e->getMessage();
        return context::ERROR;
    }
}
public static function reservation_liste($request, $context) {
    $userId = $_SESSION['utilisateur'];
    
$context->reservations=reservationTable::getReservationByUser($userId);


		   return context::SUCCESS;
	}
public static function annulerReservation($request, $context)
{
    $userId = $_SESSION['utilisateur'];
    $reservationId = $request['reservationId'];
    $voyageId = $request['voyageId']; // pour recuper l'id du voyage

    // Annuler la réservation
    $result = reservationTable::annulerReservation($userId, $voyageId);

    if ($result) {
        $context->success = "Réservation annulée avec succès.";
    } else {
        $context->error = "La réservation n'existe pas ou n'a pas pu être annulée.";
    }

    return context::SUCCESS;
}

public static function add_voyageform($request, $context) {
    
        return context::SUCCESS;
    }

public static function add_voyage($request, $context) {
    $trajet = $request['trajet'];
    $tarif = $request['tarif'];
    $heureDepart = $request['heureDepart'];
    $nombrePlaces = $request['nombrePlaces'];
    $contraintes = $request['contraintes'];
   
    $conducteur = $_SESSION['utilisateur'];

    $trajetEntity = trajetTable::getTrajet($trajet['depart'], $trajet['arrivee']);
    if (!$trajetEntity) {
     
        return context::ERROR;
    }
    $voyage = voyageTable::proposerVoyage($trajetEntity, $tarif, $heureDepart, $nombrePlaces, $contraintes, $conducteur);

    return context::SUCCESS;
}




	
	

	


}



