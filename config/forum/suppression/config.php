<?php

if (isset($Visiteur->getPage()->getParametres()['id']))
{
	$Noeud=\forum\Noeud::newNoeud($Visiteur->getPage()->getParametres()['id']);
	if ($Noeud->getId()!=$config['forum_root_id'] & $Visiteur->autorisationModification($Noeud))
	{
		$Noeud->supprimer();
		$get=array_merge($config['forum_suppression_notification_succes'], array($config['nom_parametres'] => array('id' => $Noeud->getId_parent())));
		new \user\page\Notification(array(
			'type' => \user\page\Notification::TYPE_SUCCES,
			'contenu' => $lang['forum_suppression_notification_succes'],
		));
	}
	else
	{
		$get=array_merge($config['forum_suppression_notification_erreur_autorisation'], array($config['nom_parametres'] => array('id' => $Noeud->getId())));
		new \user\page\Notification(array(
			'type' => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['forum_suppression_notification_erreur_autorisation'],
		));
	}
}
else
{
	$get=$config['forum_suppression_notification_erreur_id'];
	new \user\page\Notification(array(
		'type' => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['forum_suppression_notification_erreur_id'],
	));
}
$Visiteur->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($get));
exit();

?>