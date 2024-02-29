<?php
// Inclusion de la classe utilisateur
require_once "utilisateur.class.php";

class utilisateurTable {

public static function getUserByLoginAndPass($login, $pass)
{
    $em = dbconnection::getInstance()->getEntityManager();

    $userRepository = $em->getRepository('utilisateur');
    $users = $userRepository->findBy(array('identifiant' => $login));

    foreach ($users as $user) {
        if (sha1($pass) == $user->pass) {
            $_SESSION['id'] = $user->id;
            $_SESSION['pseudo'] = $user->identifiant;
            $_SESSION['nom'] = $user->nom;
            $_SESSION['prenom'] = $user->prenom;
            $_SESSION['avatar'] = $user->avatar;
            return $user;
        }
    }

    if ($user == false) {
        echo 'Erreur sql';
    }

    return $user;
}

public static function getUserById($id)
{
    $em = dbconnection::getInstance()->getEntityManager();
    $userRepository = $em->getRepository('utilisateur');
    $user = $userRepository->findOneBy(array('id' => $id));

    if ($user == false) {
        echo 'Erreur sql';
    }

    return $user;
}
 public static function createUser($identifiant, $pass, $nom, $prenom, $avatar) {
        $entityManager = dbconnection::getInstance()->getEntityManager();

        $nouvelUtilisateur = new utilisateur();
        $nouvelUtilisateur->identifiant = $identifiant;
        $nouvelUtilisateur->pass = sha1($pass);
        $nouvelUtilisateur->nom = $nom;
        $nouvelUtilisateur->prenom = $prenom;
        $nouvelUtilisateur->avatar = $avatar;

        $entityManager->persist($nouvelUtilisateur);
        $entityManager->flush();

        return $nouvelUtilisateur;
    }

	

  
}


?>
