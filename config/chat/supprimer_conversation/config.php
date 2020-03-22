<?php

if (isset($Visiteur->getPage()->getParametres()['id']))
{
	if ($Visiteur->getPage()->getParametres()['id']!=$config['id_conversation_all'])
	{
		$Conversation=new \chat\Conversation(array(
			'id' => $Visiteur->getPage()->getParametres()['id'],
		));
		$Conversation->recuperer();
		$Utilisateurs=$Conversation->recupererUtilisateurs();
		$present=False;
		foreach ($Utilisateurs as $Utilisateur)
		{
			if ($Utilisateur->similaire($Visiteur))
			{
				$present=True;
				break;
			}
		}
		if ($present)
		{
			$Conversation=new \chat\Conversation(array(
				'id' => $Visiteur->getPage()->getParametres()['id'],
			));
			$Conversation->supprimer();
			new \user\page\Notification(array(
				'type' => \user\page\Notification::TYPE_SUCCES,
				'contenu' => $lang['chat_supprimer_conversation_notification_succes'],
			));
			$get=$config['chat_supprimer_conversation_notification_succes'];
		}
		else
		{
			new \user\page\Notification(array(
				'type' => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['chat_supprimer_conversation_notification_erreur_autorisation'],
			));
			$get=array_merge($config['chat_supprimer_conversation_notification_erreur_autorisation'], array($config['nom_parametres'] => array('id' => $Visiteur->getPage()->getParametres()['id'])));
		}
	}
	else
	{
		new \user\page\Notification(array(
			'type' => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['chat_supprimer_conversation_notification_erreur_general'],
		));
		$get=$config['chat_supprimer_conversation_notification_erreur_general'];
	}
}
else
{
	new \user\page\Notification(array(
		'type' => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['chat_supprimer_conversation_notification_erreur_id'],
	));
	$get=$config['chat_supprimer_conversation_notification_erreur_id'];
}

$this->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($get));
exit();

?>