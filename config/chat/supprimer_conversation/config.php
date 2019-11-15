<?php

if (isset($_GET['id']))
{
	if ($_GET['id']!=$config['id_conversation_all'])
	{
		$Conversation=new \chat\Conversation(array(
			'id' => $_GET['id'],
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
				'id' => $_GET['id'],
			));
			$Conversation->supprimer();
			new \user\page\Notification(array(
				'type' => \user\page\Notification::TYPE_SUCCES,
				'contenu' => $lang['chat_supprimer_conversation_notification_succes'],
			));
			$get=$config['chat_supprimer_conversation_notification_succes'].'&id='.$_GET['id'];
		}
		else
		{
			new \user\page\Notification(array(
				'type' => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['chat_supprimer_conversation_notification_erreur_autorisation'],
			));
			$get=$config['chat_supprimer_conversation_notification_erreur_autorisation'].'&id='.$_GET['id'];
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
header('location: index.php'.$get)

?>