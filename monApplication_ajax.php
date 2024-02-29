<?php
//nom de l'application
$nameApp = "monApplication";

//action par défaut
$action = "index";
//si ce champ existe
if(key_exists("action", $_REQUEST))
//recuperer la valeur de mn champ
$action = $_REQUEST['action'];

require_once 'lib/core.php';
require_once $nameApp.'/controller/mainController.php';

foreach(glob($nameApp.'/model/*.class.php') as $model)
	include_once $model ;   

session_start();
//$contexte:reference vers l'objet contexte 
$context = context::getInstance();
$context->init($nameApp);
$view=$context->executeAction($action, $_REQUEST);

//traitement des erreurs de bases, reste a traiter les erreurs d'inclusion
if($view===false)
{
	echo "Une grave erreur s'est produite, il est probable que l'action ".$action." n'existe pas...";
	die;
}
//inclusion du layout qui va lui meme inclure le template view

	$template_view=$nameApp."/view/".$action.$view.".php";
	//charger avec la vue correspendante
	include($template_view);



?>
