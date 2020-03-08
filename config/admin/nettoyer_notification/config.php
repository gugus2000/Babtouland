<?php

$compteur_elements_supprimes=0;
$NotificationManager=new \user\NotificationManager(\core\BDDFactory::MysqlConnexion());
$LiaisonNotificationUtilisateur=new \user\LiaisonNotificationUtilisateur(\core\BDDFactory::MysqlConnexion());
$notifications=$NotificationManager->getBy(array(
	'id' => -1,
), array(
	'id' => '!=',
));
foreach ($notifications as $notification)
{
	if (!(bool)$LiaisonNotificationUtilisateur->get(array(
		'id_notification' => (int)$notification['id'],
	), array(
		'id_notification' => '=',
	)))
	{
		$compteur_elements_supprimes++;
		$Notification=new \user\Notification(array(
			'id' => $notification['id'],
		));
		$Notification->supprimer();
	}
}

new \user\page\Notification(array(
	'type' => \user\page\Notification::TYPE_SUCCES,
	'contenu' => $lang['admin_nettoyer_notification_notification_debut'].(string)$compteur_elements_supprimes.$lang['admin_nettoyer_notification_notification_fin'],
));
$Visiteur->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($config['admin_nettoyer_notification_notification_lien']));
exit();

?>