<?php

if(isset($_POST['inscription_pseudo']) & isset($_POST['inscription_mdp']) & isset($_POST['inscription_mail']) & !empty($_POST['inscription_pseudo']) & !empty($_POST['inscription_mdp']) & !empty($_POST['inscription_mail']))
{
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
		$Notification=new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_SUCCES,
			'contenu' => $lang['user_validation_inscription_succes'],
		), $Visiteur->getPage()->getPageElement());
		$get=$config['user_validation_inscription_suivant'];
	}
	else
	{
		$Notification=new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['user_validation_inscription_pseudo'],
		));
		$get=$config['user_validation_inscription_retour'];
	}
}
else
{
	$Notification=new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['user_validation_inscription_formulaire'],
	));
	$get=$config['user_validation_inscription_retour'];
}
$this->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($get));

?>