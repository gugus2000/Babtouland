<?php

if (isset($Visiteur->getPage()->getParametres()['id_fil']))
{
	if (isset($_POST['contenu']))
	{
		if (!empty($_POST['contenu']))
		{
			$Fil=new \forum\Fil(array(
				'id' => $Visiteur->getPage()->getParametres()['id_fil'],
			));
			$Fil->recuperer();
			if ($Fil->getType()==$Fil::TYPE)
			{
				$Message=new \forum\Message(array(
					'id_fil'           => $Fil->getId(),
					'id_auteur'        => $Visiteur->getId(),
					'contenu'          => $_POST['contenu'],
					'date_publication' => date($config['format_date']),
					'date_maj'         => date($config['format_date']),
				));
				$Message->creer();
				$get=array_merge($config['forum_validation_message_ajout_notification_succes'], array($config['nom_parametres'] => array('id' => $Fil->getId())));
				new \user\page\Notification(array(
					'type' => \user\page\Notification::TYPE_SUCCES,
					'contenu' => $lang['forum_validation_message_ajout_notification_succes'],
				));
			}
			else
			{
				$get=array_merge($config['forum_validation_message_ajout_notification_erreur_fil'], array($config['nom_parametres'] => array('id' => $Fil->getId())));
				new \user\page\Notification(array(
					'type' => \user\page\Notification::TYPE_SUCCES,
					'contenu' => $lang['forum_validation_message_ajout_notification_erreur_fil'],
				));
			}
		}
		else
		{
			$get=array_merge($config['forum_validation_message_ajout_notification_erreur_contenu_vide'], array($config['nom_parametres'] => array('id_fil' => $Fil->getId())));
			new \user\page\Notification(array(
				'type' => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['forum_validation_message_ajout_notification_erreur_contenu_vide'],
			));
		}
	}
	else
	{
		$get=array_merge($config['forum_validation_message_ajout_notification_erreur_contenu_indefini'], array($config['nom_parametres'] => array('id_fil' => $Fil->getId())));
		new \user\page\Notification(array(
			'type' => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['forum_validation_message_ajout_notification_erreur_contenu_indefini'],
		));
	}
}
else
{
	$get=$config['forum_validation_message_ajout_notification_erreur_id'];	
	new \user\page\Notification(array(
		'type' => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['forum_validation_message_ajout_notification_erreur_id'],
	));
}
$Visiteur->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($get));
die();

?>