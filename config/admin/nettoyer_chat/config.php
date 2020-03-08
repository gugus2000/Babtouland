<?php

$compteur_elements_supprimes=0;
$MessageManager=new \chat\MessageManager(\core\BDDFactory::MysqlConnexion());
$ConversationManager=new \chat\ConversationManager(\core\BDDFactory::MysqlConnexion());
$messages=$MessageManager->getBy(array(
	'id' => -1,
), array(
	'id' => '!=',
));
foreach ($messages as $message)
{
	if (!$ConversationManager->existId((int)$message['id_conversation']))
	{
		$compteur_elements_supprimes++;
		$Message=new \chat\Message(array(
			'id' => $message['id'],
		));
		$Message->supprimer();
	}
}

new \user\page\Notification(array(
	'type' => \user\page\Notification::TYPE_SUCCES,
	'contenu' => $lang['admin_nettoyer_chat_notification_debut'].(string)$compteur_elements_supprimes.$lang['admin_nettoyer_chat_notification_fin'],
));
$Visiteur->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($config['admin_nettoyer_chat_notification_lien']));
exit();

?>