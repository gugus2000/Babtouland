<?php

session_start();

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

if(isset($_SESSION['pseudo']) & isset($_SESSION['id']) & isset($_SESSION['mdp']))	// Visiteur connecté
{
	$Visiteur=new \user\Visiteur(array(
		'pseudo' => $_SESSION['pseudo'],
		'id'     => $_SESSION['id']
	));
	$Visiteur->recuperer();
	$Visiteur->connexion($_SESSION['mdp']);
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
		$Visiteur->getPage()->set(array('message' => $_SESSION['message']));
	}
	require $Visiteur->getPage()->getPath();
	echo $Visiteur->getPage()->afficher($config['message_css'], $config['message_js'], $config['message_contenu']);
}
else
{
	echo '(debug) pas la permission <br /> liste de permission:<br />';
	foreach ($Visiteur->getRole()->getPermissions() as $key => $Permission)
	{
		echo 'application='.$Permission->getApplication().' | action='.$Permission->getAction().'<br />';
	}
}

?>