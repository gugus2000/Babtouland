<?php

session_start();

function initOutputFilter()		// Voir https://lehollandaisvolant.net/tuto/pagespd/
{
   ob_start('ob_gzhandler');
   register_shutdown_function('ob_end_flush');
}
initOutputFilter();


require_once 'config/core/config.php';	// Chargement de la configuration par défaut

if(isset($_GET['lang']))
{
	$_SESSION['lang']=$_GET['lang'];
}
if(isset($_SESSION['lang']))
{
	$config['default_lang']=$_SESSION['lang'];
}

require_once 'config/lang/'.$config['default_lang'].'.php';	// Chargement de la traduction
require_once 'config/core/bbcode.php';

require_once 'func/core/utils.func.php';
require_once 'func/core/menu-up.func.php';
require_once 'func/core/toast.func.php';
spl_autoload_register('loadClass');

$application=$config['default_application'];
$action=$config['default_action'];
if(isset($_GET['application']))
{
	$application=$_GET['application'];
}
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
			'id'     => $_SESSION['id']
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
	if($Visiteur->loadPage($application, $action))	// Permission accordée
	{
		if(isset($_SESSION['message']))
		{
			$Visiteur->getPage()->set(array('message' => unserialize($_SESSION['message'])));
		}
		if (!@include_once($Visiteur->getPage()->getPath()))
		{
			throw new Exception($lang['erreur_fichier_introuvable']);
		}
		else
		{
			require $Visiteur->getPage()->getPath();
		}
		echo $Visiteur->getPage()->afficher();
	}
	else
	{
		throw new Exception($lang['erreur_permission_introuvable']);
	}
}
catch (Exception $e)
{
	if (!$Visiteur->getAvatar())
	{
		$Visiteur=new \user\Visiteur(array(
			'pseudo' => $config['nom_guest'],
		));	// Visiteur avec une "session invitée"
		$Visiteur->recuperer();
		$Visiteur->connexion($config['mdp_guest']);
	}
	$Visiteur->loadPage('erreur', 'erreur');
	require $config['erreur_path'];
	echo $Visiteur->getPage()->afficher();
}

?>