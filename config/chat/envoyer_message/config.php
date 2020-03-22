<?php

if (isset($Visiteur->getPage()->getParametres()['id']))
{
	$id=(int)$Visiteur->getPage()->getParametres()['id'];
	$Conversation=new \chat\Conversation(array(
		'id' => $id,
	));
	$date_maintenant=new \DateTime(date($config['format_date']));
	$Conversation->recuperer($date_maintenant->format($config['format_date']));
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
		if (isset($_POST['chat_message']))
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_SUCCES,
				'contenu' => $lang['chat_envoyer_message_succes'],
			));
			$get=array_merge($config['chat_envoyer_message_succes'], array($config['nom_parametres'] => array('id' => $Visiteur->getPage()->getParametres()['id'])));
			$ChatMessage=new \chat\Message(array(
				'id_conversation' => $id,
				'id_auteur'       => $Visiteur->getId(),
				'contenu'         => $_POST['chat_message'],
				'date_publication' => date($config['format_date']),
				'date_mise_a_jour' => date($config['format_date']),
			));
			$ChatMessage->creer();
		}
		else
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['chat_envoyer_message_erreur_contenu'],
			));
			$get=array_merge($config['chat_envoyer_message_erreur_contenu'], array($config['nom_parametres'] => array('id' => $Visiteur->getPage()->getParametres()['id'])));
		}
	}
	else
	{
		$Notification=new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['chat_envoyer_message_erreur_permission'],
		));
		$get=array_merge($config['chat_envoyer_message_erreur_permission'], array($config['nom_parametres'] => array('id' => $Visiteur->getPage()->getParametres()['id'])));
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