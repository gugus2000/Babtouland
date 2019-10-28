<?php

$UserMessage=new \user\Message(array(
	'contenu'  => $lang['chat_envoyer_message_erreur_id_conversation'],
	'type'     => \user\Message::TYPE_ERREUR,
	'css'      => $config['message_css'],
	'js'       => $config['message_js'],
	'template' => $config['message_template'],
));
$get=$config['chat_envoyer_message_erreur_id_conversation'];
if (isset($_GET['id']))
{
	$UserMessage=new \user\Message(array(
		'contenu'  => $lang['chat_envoyer_message_erreur_permission'],
		'type'     => \user\Message::TYPE_ERREUR,
		'css'      => $config['message_css'],
		'js'       => $config['message_js'],
		'template' => $config['message_template'],
	));
	$get=$config['chat_envoyer_message_erreur_permission'].'&id='.$_GET['id'];
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
		$UserMessage=new \user\Message(array(
			'contenu'  => $lang['chat_envoyer_message_erreur_contenu'],
			'type'     => \user\Message::TYPE_ERREUR,
			'css'      => $config['message_css'],
			'js'       => $config['message_js'],
			'template' => $config['message_template'],
		));
		$get=$config['chat_envoyer_message_erreur_contenu'].'&id='.$_GET['id'];
		if (isset($_POST['chat_message']))
		{
			$UserMessage=new \user\Message(array(
				'contenu'  => $lang['chat_envoyer_message_succes'],
				'type'     => \user\Message::TYPE_SUCCES,
				'css'      => $config['message_css'],
				'js'       => $config['message_js'],
				'template' => $config['message_template'],
			));
			$get=$config['chat_envoyer_message_succes'].'&id='.$_GET['id'];
			$ChatMessage=new \chat\Message(array(
				'id_conversation' => $id,
				'id_auteur'       => $Visiteur->getId(),
				'contenu'         => $_POST['chat_message'],
				'date_publication' => date('Y-m-d H:i:s'),
				'date_mise_a_jour' => date('Y-m-d H:i:s'),
			));
			$ChatMessage->creer();
		}
	}
}

$_SESSION['message']=serialize($UserMessage);
header('location: index.php'.$get);

?>