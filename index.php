<?php

session_start();

error_reporting(E_ALL);	// En prod

date_default_timezone_set('UTC');	// On travaillera toujours en UTC (on peut changer pour chaque affichage après plus facilement) ! pas changer (Javascripts)
$GLOBALS['time_start']=microtime(true);

require_once 'func/core/utils.func.php';
initOutputFilter();
spl_autoload_register('loadClass');
$Routeur=new \core\Routeur(initRoutageSession());
require_once 'config/core/config/config.php';
require $config['path_lang'].$config['config_utilisateur']['lang'].'/lang.php';

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
		}
		else
		{
			throw new Exception($lang['erreur_connexion_utilisateur']);
		}
	}
	else
	{
		$Visiteur=new \user\Visiteur(array(
			'id' => $config['id_guest'],
		));	// Visiteur avec une "session invitée"
		$Visiteur->recuperer();
		$Visiteur->connexion($config['mdp_guest']);
	}
	echo $Visiteur->chargePage($Routeur->dechiffrerRoute($_SERVER['REQUEST_URI']));
}
catch (Exception $e)
{
	/*echo '<pre>';
	var_dump($e->getMessage());
	print_r($e->getTrace());
	echo '</pre>';
	die();*/
	if (!isset($Visiteur))
	{
		$Visiteur=new \user\Visiteur(array(
			'id' => $config['id_guest'],
		));	// Visiteur avec une "session invitée"
		$Visiteur->recuperer();
		$Visiteur->connexion($config['mdp_guest']);
	}
	echo $Visiteur->chargePage(array('application' => 'erreur', 'action' => 'erreur'));
}

die();

?>