<?php

if (isset($Visiteur->getPage()->getParametres()['id']))
{
	$ChatMessage=new \chat\Message(array(
		'id' => $Visiteur->getPage()->getParametres()['id'],
	));
	$ChatMessage->recuperer();
	$Conversation=new \chat\Conversation(array(
		'id' => $ChatMessage->getId_conversation(),
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
		if ($Visiteur->autorisationModification($ChatMessage))	// On peut le modifier
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_SUCCES,
				'contenu' => $lang['chat_validation_editer_message_succes'],
			));
			$get=array_merge($config['chat_validation_editer_message_succes'], array($config['nom_parametres'] => array('id' => $Conversation->afficherId())));
			$ChatMessage=new \chat\Message(array(
				'id' => $ChatMessage->getId(),
				'contenu' => $_POST['chat_message'],
				'date_mise_a_jour' => date($config['format_date']),
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