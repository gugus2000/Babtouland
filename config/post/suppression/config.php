<?php

if(isset($_GET['id']))
{
	$BDDFactory=new \core\BDDFactory;
	$PostManager=new \post\PostManager($BDDFactory->MysqlConnexion());
	if($PostManager->existId((int)$_GET['id']))
	{
		$Post=new \post\Post(array(
			'id' => $_GET['id'],
		));
		$Post->recuperer();
		if(autorisationModification($Post, $this->getPage()->getApplication(), $this->getPage()->getAction()))
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
			$get=array_merge($config['post_suppression_permission'], array('id' => $_GET['id']));
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