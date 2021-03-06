<?php

if(isset($Visiteur->getPage()->getParametres()['id']))
{
	$BDDFactory=new \core\BDDFactory;
	$PostManager=new \post\PostManager($BDDFactory->MysqlConnexion());
	if($PostManager->existId((int)$Visiteur->getPage()->getParametres()['id']))
	{
		$Post=new \post\Post(array(
			'id' => $Visiteur->getPage()->getParametres()['id'],
		));
		$Post->recuperer();
		if($Visiteur->autorisationModification($Post))
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_SUCCES,
				'contenu' => $lang['post_suppression_message_succes'],
			));
			$get=$config['post_suppression_suivant'];
			$Post->supprimer();
		}
		else
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['post_suppression_message_permission'],
			));
			$get=array_merge($config['post_suppression_permission'], array($config['nom_parametres'] => array('id' => $Visiteur->getPage()->getParametres()['id'])));
		}
	}
	else
	{
		$Notification=new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['post_suppression_message_inexistant'],
		));
		$get=$config['post_suppression_retour'];
	}
}
else
{
	$Notification=new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['post_suppression_message_argument'],
	));
	$get=$config['post_suppression_retour'];
}

$this->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($get));
exit();

?>