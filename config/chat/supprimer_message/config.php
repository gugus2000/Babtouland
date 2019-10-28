<?php

$UserMessage=new \user\Message(array(
	'contenu'  => $lang['chat_supprimer_message_erreur_id_message'],
	'type'     => \user\Message::TYPE_ERREUR,
	'css'      => $config['message_css'],
	'js'       => $config['message_js'],
	'template' => $config['message_template'],
));
$get=$config['chat_supprimer_message_erreur_id_message'];
if (isset($_GET['id']))
{
	$UserMessage=new \user\Message(array(
		'contenu'  => $lang['chat_supprimer_message_erreur_conversation_autorisation'],
		'type'     => \user\Message::TYPE_ERREUR,
		'css'      => $config['message_css'],
		'js'       => $config['message_js'],
		'template' => $config['message_template'],
	));
	$get=$config['chat_supprimer_message_erreur_conversation_autorisation'];
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
		$UserMessage=new \user\Message(array(
			'contenu'  => $lang['chat_supprimer_message_erreur_message_autorisation'],
			'type'     => \user\Message::TYPE_ERREUR,
			'css'      => $config['message_css'],
			'js'       => $config['message_js'],
			'template' => $config['message_template'],
		));
		$get=$config['chat_supprimer_message_erreur_message_autorisation'].'&id='.$Conversation->afficherId();
		if (autorisationModification($Message, $application, $action))
		{
			$UserMessage=new \user\Message(array(
				'contenu'  => $lang['chat_supprimer_message_succes'],
				'type'     => \user\Message::TYPE_SUCCES,
				'css'      => $config['message_css'],
				'js'       => $config['message_js'],
				'template' => $config['message_template'],
			));
			$get=$config['chat_supprimer_message_succes'].'&id='.$Conversation->afficherId();
			$Message->supprimer();
		}
	}
}


$_SESSION['message']=serialize($UserMessage);
header('location: index.php'.$get);

?>