<?php

session_start();

error_reporting(E_ALL);	// En prod

date_default_timezone_set('UTC');	// On travaillera toujours en UTC (on peut changer pour chaque affichage après plus facilement) ! pas changer (Javascripts)
$GLOBALS['time_start']=microtime(true);

require_once 'func/core/utils.func.php';
initOutputFilter();
spl_autoload_register('loadClass');
$Routeur=new \core\Routeur(\core\Routeur::MODE_ROUTE);
require_once 'config/core/config/config.php';

try
{
	if(isset($_SESSION['pseudo']) & isset($_SESSION['id']) & isset($_SESSION['mdp']) & !empty($_SESSION['pseudo']) & !empty($_SESSION['id']) & !empty($_SESSION['mdp']))	// Visiteur connecté
	{
		$Visiteur=new \user\Visiteur(array(
			'pseudo' => $_SESSION['pseudo'],
			'id'     => $_SESSION['id'],
		));
		if ($Visiteur->Manager()->existId($_SESSION['id']) & $Visiteur->Manager()->exist(array('pseudo' => $_SESSION['pseudo'])))
		{
			$Visiteur->recuperer();
			$Visiteur->connexion($_SESSION['mdp']);
			require 'config/core/lang/'.$Visiteur->getConfiguration('lang').'/lang.php';	// Chargement de la traduction
		}
		else
		{
			throw new Exception($Visiteur->getConfiguration('lang')['erreur_connexion_utilisateur']);
		}
	}
	else
	{
		$Visiteur=new \user\Visiteur(array(
			'id' => $config['id_guest'],
		));	// Visiteur avec une "session invitée"
		$Visiteur->recuperer();
		$Visiteur->connexion($config['mdp_guest']);
		require 'config/core/lang/'.$Visiteur->getConfiguration('lang').'/lang.php';	// Chargement de la traduction
	}
	echo $Visiteur->chargePage($Routeur->dechiffrerRoute($_SERVER['REQUEST_URI']));
}
catch (Exception $e)
{
	if (null===$Visiteur->getPage())
	{
		$Visiteur=new \user\Visiteur(array(
			'id' => $config['id_guest'],
		));	// Visiteur avec une "session invitée"
		$Visiteur->recuperer();
		$Visiteur->connexion($config['mdp_guest']);
		require 'config/core/lang/'.$Visiteur->getConfiguration('lang').'/lang.php';	// Chargement de la traduction
	}
	echo $Visiteur->chargePage(array('application' => 'erreur', 'action' => 'erreur'));
}

?>