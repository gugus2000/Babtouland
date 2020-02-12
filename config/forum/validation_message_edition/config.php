<?php

if (isset($Visiteur->getPage()->getParametres()['id']))
{
	if (isset($_POST['contenu']))
	{
		if (!empty($_POST['contenu']))
		{
			$Message=new \forum\Message(array(
				'id' => $Visiteur->getPage()->getParametres()['id'],
			));
			$Message->recuperer();
			$Fil=new \forum\Fil(array(
				'id' => $Message->getId_fil(),
			));
			$Fil->recuperer();
			if ($Visiteur->autorisationModification($Message))
			{
				$Message=new \forum\Message(array(
					'id'       => $Message->getId(),
					'contenu'  => $_POST['contenu'],
					'date_maj' => date($config['format_date']),
				));
				$Message->modifier();
				$get=array_merge($config['forum_validation_message_edition_notification_succes'], array($config['nom_parametres'] => array('id' => $Fil->getId())));
				new \user\page\Notification(array(
					'type'    => \user\page\Notification::TYPE_SUCCES,
					'contenu' => $lang['forum_validation_message_edition_notification_succes'],
				));
			}
			else
			{
				$get=array_merge($config['forum_validation_message_edition_notification_erreur_autorisation'], array($config['nom_parametres'] => array('id' => $Fil->getId())));
				new \user\page\Notification(array(
					'type'    => \user\page\Notification::TYPE_ERREUR,
					'contenu' => $lang['forum_validation_message_edition_notification_erreur_autorisation'],
				));
			}
		}
		else
		{
			$get=array_merge($config['forum_validation_message_edition_notification_erreur_vide'], array($config['nom_parametres'] => array('id' => $Message->getId())));
			new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['forum_validation_message_edition_notification_erreur_vide'],
			));
		}
	}
	else
	{
		$get=array_merge($config['forum_validation_message_edition_notification_erreur_formulaire'], array($config['nom_parametres'] => array('id' => $Message->getId())));
		new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['forum_validation_message_edition_notification_erreur_formulaire'],
		));
	}
}
else
{
	$get=array_merge($config['forum_validation_message_edition_notification_erreur_id'], array($config['nom_parametres'] => array('id' => $Message->getId())));
	new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['forum_validation_message_edition_notification_erreur_id'],
	));
}
$Visiteur->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($get));
die();

?>