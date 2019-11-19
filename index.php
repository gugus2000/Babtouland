<?php

session_start();

error_reporting(E_ALL);	// En prod

date_default_timezone_set('UTC');	// On travaillera toujours en UTC (on peut changer pour chaque affichage après plus facilement) ! pas changer (Javascripts)
$GLOBALS['time_start']=microtime(true);

require_once 'config/core/config/config.php';	// Chargement de la configuration par défaut

if(isset($_GET['lang']))
{
	$_SESSION['lang']=$_GET['lang'];
}
if(isset($_SESSION['lang']))
{
	$config['lang']=$_SESSION['lang'];
}

require_once 'config/core/lang/'.$config['lang'].'/lang.php';	// Chargement de la traduction

require_once 'func/core/utils.func.php';
initOutputFilter();
spl_autoload_register('loadClass');

$application=$config['defaut_application'];
if(isset($_GET['application']))
{
	$application=$_GET['application'];
}
$action=$config['defaut_'.$application.'_action'];
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
	}
	echo $Visiteur->chargePage('erreur', 'erreur');
}

?>