<?php

if (isset($Visiteur->getPage()->getParametres()['id']))
{
	$Noeud=\forum\Noeud::newNoeud($Visiteur->getPage()->getParametres()['id']);
	if ($Visiteur->autorisationModification($Noeud))
	{
		if (isset($_POST['nom']) & isset($_POST['description']))
		{
			$type='forum\\'.ucfirst($Noeud->afficherType($Noeud->getType()));
			$MajNoeud=new $type(array(
				'id'          => $Noeud->getId(),
				'nom'         => $_POST['nom'],
				'description' => $_POST['description'],
				'date_maj'    => date($config['format_date']),
			));
			$MajNoeud->modifier();
			$get=array_merge($config['forum_validation_edition_notification_succes'], array($config['nom_parametres'] => array('id' => $MajNoeud->getId())));
			new \user\page\Notification(array(
				'type' => \user\page\Notification::TYPE_SUCCES,
				'contenu' => $lang['forum_validation_edition_notification_succes'],
			));
		}
		else
		{
			$get=array_merge($config['forum_validation_edition_notification_erreur_formulaire'], array($config['nom_parametres'] => array('id' => $MajNoeud->getId())));
			new \user\page\Notification(array(
				'type' => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['forum_validation_edition_notification_erreur_formulaire'],
			));
		}
	}
	else
	{
		$get=array_merge($config['forum_validation_edition_notification_erreur_autorisation'], array($config['nom_parametres'] => array('id' => $MajNoeud->getId())));
		new \user\page\Notification(array(
			'type' => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['forum_validation_edition_notification_erreur_autorisation'],
		));
	}
}
else
{
	$get=$config['forum_validation_edition_notification_erreur_id'];
	new \user\page\Notification(array(
		'type' => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['forum_validation_edition_notification_erreur_id'],
	));
}
$Visiteur->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($get));
die();

?>