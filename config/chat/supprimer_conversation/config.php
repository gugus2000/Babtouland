<?php

if (isset($Visiteur->getPage()->getParametres()['id']))
{
	if ($Visiteur->getPage()->getParametres()['id']!=$config['id_conversation_all'])
	{
		$Conversation=new \chat\Conversation(array(
			'id' => $Visiteur->getPage()->getParametres()['id'],
		));
		$Conversation->recuperer();
		$id_utilisateurs=$Conversation->getId_utilisateurs();
		$index=0;
		while (isset($id_utilisateurs[$index]))
		{
			if ($id_utilisateurs[$index]==$Visiteur->getId())
			{
				break;
			}
			$index++;
		}
		if (isset($id_utilisateurs[$index]))
		{
			$Conversation=new \chat\Conversation(array(
				'id' => $Visiteur->getPage()->getParametres()['id'],
			));
			$Conversation->supprimer();
			new \user\page\Notification(array(
				'type' => \user\page\Notification::TYPE_SUCCES,
				'contenu' => $lang['chat_supprimer_conversation_notification_succes'],
			));
			$get=array_merge($config['chat_supprimer_conversation_notification_succes'], array($config['nom_parametres'] => array('id' => $Visiteur->getPage()->getParametres()['id'])));
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