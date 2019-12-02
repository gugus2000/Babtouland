<?php

if (isset($_GET['id']))
{
	$id=(int)$_GET['id'];
	$Conversation=new \chat\Conversation(array(
		'id' => $id,
	));
	$date_maintenant=new \DateTime(date('Y-m-d H:i:s'));
	$Conversation->recuperer($date_maintenant->format('Y-m-d H:i:s'));
	$Id_utilisateurs=$Conversation->getId_utilisateurs();
	$index=0;
	while (isset($Id_tilisateurs[$index]) & $Id_utilisateurs[$index]==$Visiteur->getId())		// Évite de parcourir toute la liste
	{
		$index++;
	}
	if ($Id_utilisateurs[$index])
	{
		if (isset($_POST['chat_message']))
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_SUCCES,
				'contenu' => $lang['chat_envoyer_message_succes'],
			));
			$get=array_merge($config['chat_envoyer_message_succes'], array('id' => $_GET['id']));
			$ChatMessage=new \chat\Message(array(
				'id_conversation' => $id,
				'id_auteur'       => $Visiteur->getId(),
				'contenu'         => $_POST['chat_message'],
				'date_publication' => date('Y-m-d H:i:s'),
				'date_mise_a_jour' => date('Y-m-d H:i:s'),
			));
			$ChatMessage->creer();
		}
		else
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['chat_envoyer_message_erreur_contenu'],
			));
			$get=array_merge($config['chat_envoyer_message_erreur_contenu'], array('id' => $_GET['id']));
		}
	}
	else
	{
		$Notification=new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['chat_envoyer_message_erreur_permission'],
		));
		$get=array_merge($config['chat_envoyer_message_erreur_permission'], array('id' => $_GET['id']));
	}
}
else
{
	$Notification=new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['chat_envoyer_message_erreur_id_conversation'],
	));
	$get=$config['chat_envoyer_message_erreur_id_conversation'];
}

$this->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($get));
exit();

?>