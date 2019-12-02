<?php

if (isset($_GET['id']))
{
	$ChatMessage=new \chat\Message(array(
		'id' => $_GET['id'],
	));
	$ChatMessage->recuperer();
	$Conversation=new \chat\Conversation(array(
		'id' => $ChatMessage->getId_conversation(),
	));
	$date_maintenant=new \DateTime(date('Y-m-d H:i:s'));
	$Conversation->recuperer($date_maintenant->format('Y-m-d H:i:s'));
	$Id_utilisateurs=$Conversation->getId_utilisateurs();
	$index=0;
	while (isset($Id_utilisateurs[$index]) & $Id_utilisateurs[$index]==$Visiteur->getId())		// Évite de parcourir toute la liste
	{
		$index++;
	}
	if ($Id_utilisateurs[$index])	// Accès à la conversation
	{
		if(autorisationModification($ChatMessage, $this->getPage()->getApplication(), 'editer_message'))	// On peut le modifier
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_SUCCES,
				'contenu' => $lang['chat_validation_editer_message_succes'],
			));
			$get=array_merge($config['chat_validation_editer_message_succes'], array('id' => $Conversation->afficherId()));
			$ChatMessage=new \chat\Message(array(
				'id' => $ChatMessage->getId(),
				'contenu' => $_POST['chat_message'],
				'date_mise_a_jour' => date('Y-m-d H:i:s'),
			));
			$ChatMessage->modifier();
		}
		else
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['chat_editer_message_erreur_message_autorisation'],
			));
			$get=$config['chat_editer_message_erreur_message_autorisation'];
		}
	}
	else
	{
		$Notification=new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['chat_editer_message_erreur_conversation_autorisation'],
		));
		$get=$config['chat_editer_message_erreur_conversation_autorisation'];
	}
}
else
{
	$Notification=new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['chat_editer_message_erreur_id_message'],
	));
	$get=$config['chat_editer_message_erreur_id_message'];
}

$this->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($get));
exit();

?>