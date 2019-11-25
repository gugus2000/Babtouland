<?php

session_start();

error_reporting(E_ALL);	// En prod

date_default_timezone_set('UTC');	// On travaillera toujours en UTC (on peut changer pour chaque affichage après plus facilement) ! pas changer (Javascripts)
$GLOBALS['time_start']=microtime(true);

require_once 'func/core/utils.func.php';
require_once 'config/core/config/config.php';
initOutputFilter();
spl_autoload_register('loadClass');

$path=parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$arrayRoute=routeRecuperationApplicationActionLien($path);
$application=$arrayRoute['application'];
if(isset($_GET['application']))
{
	$application=$_GET['application'];
}
$action=$arrayRoute['action'];
if(isset($_GET['action']))
{
	$action=$_GET['action'];
}
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
			throw new Exception($lang['erreur_connexion_utilisateur']);
		}
	}
	else
	{
		$Visiteur=new \user\Visiteur(array(
			'pseudo' => $config['nom_guest'],
		));	// Visiteur avec une "session invitée"
		$Visiteur->recuperer();
		$Visiteur->connexion($config['mdp_guest']);
		require 'config/core/lang/'.$Visiteur->getConfiguration('lang').'/lang.php';	// Chargement de la traduction
	}
	echo $Visiteur->chargePage($application, $action);
}
catch (Exception $e)
{
	if (!isset($Visiteur))
	{
		$Visiteur=new \user\Visiteur(array(
			'pseudo' => $config['nom_guest'],
		));	// Visiteur avec une "session invitée"
		$Visiteur->recuperer();
		$Visiteur->connexion($config['mdp_guest']);
		require 'config/core/lang/'.$Visiteur->getConfiguration('lang').'/lang.php';	// Chargement de la traduction
	}
	echo $Visiteur->chargePage('erreur', 'erreur');
}

?>