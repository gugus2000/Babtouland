<?php

if (isset($_GET['id']))
{
	$Message=new \chat\Message(array(
		'id' => $_GET['id'],
	));
	$Message->recuperer();
	$Conversation=new \chat\Conversation(array(
		'id' => $Message->getId_conversation(),
	));
	$date_maintenant=new \DateTime(date('Y-m-d H:i:s'));
	$Conversation->recuperer($date_maintenant->format('Y-m-d H:i:s'));
	$Id_utilisateurs=$Conversation->getId_utilisateurs();
	$index=0;
	while (isset($Id_utilisateurs[$index]) & $Id_utilisateurs[$index]==$Visiteur->getId())		// Évite de parcourir toute la liste
	{
		$index++;
	}
	if ($Id_utilisateurs[$index])
	{
		if (autorisationModification($Message, $application, $action))
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_SUCCES,
				'contenu' => $lang['chat_supprimer_message_succes'],
			));
			$get=$config['chat_supprimer_message_succes'].'&id='.$Conversation->afficherId();
			$Message->supprimer();
		}
		else
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['chat_supprimer_message_erreur_message_autorisation'],
			));
			$get=$config['chat_supprimer_message_erreur_message_autorisation'].'&id='.$Conversation->afficherId();
		}
	}
	else
	{
		$Notification=new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['chat_supprimer_message_erreur_conversation_autorisation'],
		));
		$get=$config['chat_supprimer_message_erreur_conversation_autorisation'];
	}
}
else
{
	$Notification=new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['chat_supprimer_message_erreur_id_message'],
	));
	$get=$config['chat_supprimer_message_erreur_id_message'];
}

$this->getPage()->envoyerNotificationsSession();
header('location: index.php'.$get);

?>