<?php

$Message=new \user\Message(array(
	'contenu'  => $lang['user_validation_inscription_formulaire'],
	'type'     => \user\Message::TYPE_ERREUR,
	'css'      => $config['message_css'],
	'js'       => $config['message_js'],
	'template' => $config['message_template'],
));
$get=$config['user_validation_inscription_retour'];
if(isset($_POST['inscription_pseudo']) & isset($_POST['inscription_mdp']) & isset($_POST['inscription_mail']) & !empty($_POST['inscription_pseudo']) & !empty($_POST['inscription_mdp']) & !empty($_POST['inscription_mail']))
{
	$Message=new \user\Message(array(
		'contenu'  => $lang['user_validation_inscription_pseudo'],
		'type'     => \user\Message::TYPE_ERREUR,
		'css'      => $config['message_css'],
		'js'       => $config['message_js'],
		'template' => $config['message_template'],
	));
	$UtilisateurManager=$Visiteur->Manager();	// ($Visiteur existe déjà)
	if(!$UtilisateurManager->exist(array('pseudo' => $_POST['inscription_pseudo'])))	// Le pseudo n'est pas déjà pris
	{
		$newVisiteur=new \user\Visiteur(array(
			'pseudo'           => $_POST['inscription_pseudo'],
			'avatar'           => $config['default_avatar'],
			'date_inscription' => date('Y-m-d H:i:s'),
			'date_connexion'   => date('Y-m-d H:i:s'),
			'banni'            => $config['default_banni'],
			'mail'             => $_POST['inscription_mail'],
		));
		$newVisiteur->inscription($_POST['inscription_mdp'], $config['default_role']);
		$newVisiteur->recuperer();
		$newVisiteur->connexion($_POST['inscription_mdp']);
		$get=$config['user_validation_inscription_suivant'];
		$Visiteur=$newVisiteur;
		$Message=new \user\Message(array(
			'contenu'  => $lang['user_validation_inscription_succes'],
			'type'     => \user\Message::TYPE_SUCCES,
			'css'      => $config['message_css'],
			'js'       => $config['message_js'],
			'template' => $config['message_template'],
		));
	}
}

$_SESSION['message']=serialize($Message);
header('location: index.php'.$get);

?>