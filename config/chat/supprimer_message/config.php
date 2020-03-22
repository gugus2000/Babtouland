<?php

if (isset($Visiteur->getPage()->getParametres()['id']))
{
	$Message=new \chat\Message(array(
		'id' => $Visiteur->getPage()->getParametres()['id'],
	));
	$Message->recuperer();
	$Conversation=new \chat\Conversation(array(
		'id' => $Message->getId_conversation(),
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
		if ($Visiteur->autorisationModification($Message))
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_SUCCES,
				'contenu' => $lang['chat_supprimer_message_succes'],
			));
			$get=array_merge($config['chat_supprimer_message_succes'], array($config['nom_parametres'] => array('id' => $Conversation->afficherId())));
			$Message->supprimer();
		}
		else
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['chat_supprimer_message_erreur_message_autorisation'],
			));
			$get=array_merge($config['chat_supprimer_message_erreur_message_autorisation'], array($config['nom_parametres'] => array('id' => $Conversation->afficherId())));
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
header('location: '.$Routeur->creerLien($get));
exit();

?>