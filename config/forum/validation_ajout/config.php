<?php

if (isset($Visiteur->getPage()->getParametres()['id_parent']))
{
	if (isset($_POST['nom']) & isset($_POST['description']) & isset($_POST['type']))
	{
		$attributs=array(
			'id_parent'        => $Visiteur->getPage()->getParametres()['id_parent'],
			'id_auteur'        => $Visiteur->getId(),
			'nom'              => $_POST['nom'],
			'description'      => $_POST['description'],
			'date_publication' => date('Y-m-d H:i:s'),
			'date_maj'         => date('Y-m-d H:i:s'),
		);
		switch ($_POST['type'])
		{
			case \forum\Noeud::TYPE_DOSSIER:
				$Noeud=new \forum\Dossier($attributs);
				$action='voir_dossier';
				break;
			case \forum\Noeud::TYPE_FIL:
				$Noeud=new \forum\Fil($attributs);
				$action='voir_fil';
				break;
			default:
				throw new \UnexpectedValueException((string)$_POST['type'].' not exist');
		}
		$Noeud->creer();
		$get=array_merge($config['forum_validation_ajout_notification_succes'], array('action' => $action, $config['nom_parametres'] => array('id' => $Noeud->getId())));
		new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_SUCCES,
			'contenu' => $lang['forum_validation_ajout_notification_succes'],
		));
	}
	else
	{
		$get=array_merge($config['forum_validation_ajout_notification_erreur_formulaire'], array($config['nom_parametres'] => array('id' => $Visiteur->getPage()->getParametres()['id_parent'])));
		new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['forum_validation_ajout_notification_erreur_formulaire']
		));
	}
}
else
{
	$get=$config['forum_validation_ajout_notification_erreur_id'];
	\user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['forum_validation_ajout_notification_erreur_id']
	));
}
$Visiteur->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($get));
exit();

?>