<?php

if (isset($Visiteur->getPage()->getParametres()['id']))
{
	$Message=new \forum\Message(array(
		'id' => $Visiteur->getPage()->getParametres()['id'],
	));
	$Message->recuperer();
	$Fil=new \forum\Fil(array(
		'id' => $Message->getId_fil(),
	));
	$Fil->recuperer();
	if ($Visiteur->autorisationModification($Message))
	{
		$Message->supprimer();
		$get=array_merge($config['forum_message_suppression_notification_succes'], array($config['nom_parametres'] => array('id' => $Fil->getId())));
		new \user\page\Notification(array(
			'type' => \user\page\Notification::TYPE_SUCCES,
			'contenu' => $lang['forum_message_suppression_notification_succes'],
		));
	}
	else
	{
		$get=array_merge($config['forum_message_suppression_notification_erreur_autorisation'], array($config['nom_parametres'] => array('id' => $Fil->getId())));
		new \user\page\Notification(array(
			'type' => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['forum_message_suppression_notification_erreur_autorisation'],
		));
	}
}
else
{
	$get=$config['forum_message_suppression_notification_erreur_id'];
	new \user\page\Notification(array(
		'type' => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['forum_message_suppression_notification_erreur_id'],
	));
}
$Visiteur->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($get));
exit();

?>