<?php

$ConversationManager=new \chat\ConversationManager(\core\BDDFactory::MysqlConnexion());
$LiaisonConversationUtilisateur=new \chat\LiaisonConversationUtilisateur(\core\BDDFactory::MysqlConnexion());
$conversations=$ConversationManager->getBy(array(
	'id' => $config['id_conversation_all'],
), array(
	'id' => '!=',
));

$compteur_conversations_supprimes=0;
foreach($conversations as $conversation)
{
	if (!$LiaisonConversationUtilisateur->exist('id_conversation', (int)$conversation['id']))
	{
		$compteur_conversations_supprimes++;
		$Conversation=new \chat\Conversation(array(
			'id' => $conversation['id'],
		));
		$Conversation->supprimer();
	}
}

new \user\page\Notification(array(
	'type' => \user\page\Notification::TYPE_SUCCES,
	'contenu' => $lang['admin_nettoyer_chat_notification_conversation_debut'].(string)$compteur_conversations_supprimes.$lang['admin_nettoyer_chat_notification_conversation_fin'],
));

$MessageManager=new \chat\MessageManager(\core\BDDFactory::MysqlConnexion());
$messages=$MessageManager->getBy(array(
	'id' => -1,
), array(
	'id' => '!=',
));

$compteur_messages_supprimes=0;
foreach ($messages as $message)
{
	if (!$ConversationManager->existId((int)$message['id_conversation']))
	{
		$compteur_messages_supprimes++;
		$Message=new \chat\Message(array(
			'id' => $message['id'],
		));
		$Message->supprimer();
	}
}

new \user\page\Notification(array(
	'type' => \user\page\Notification::TYPE_SUCCES,
	'contenu' => $lang['admin_nettoyer_chat_notification_message_debut'].(string)$compteur_messages_supprimes.$lang['admin_nettoyer_chat_notification_message_fin'],
));
$Visiteur->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($config['admin_nettoyer_chat_notification_lien']));
exit();

?>