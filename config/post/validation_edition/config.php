<?php

if(isset($_GET['id']) & isset($_POST['edition_titre']) & isset($_POST['edition_contenu']) & !empty($_GET['id']) & !empty($_POST['edition_titre']) & !empty($_POST['edition_contenu']))
{

	$BDDFactory=new \core\BDDFactory;
	$PostManager=new \post\PostManager($BDDFactory->MysqlConnexion());
	if($PostManager->existId((int)$_GET['id']))
	{
		$Post=new \post\Post(array(
			'id' => $_GET['id'],
			'titre' => $_POST['edition_titre'],
			'contenu' => $_POST['edition_contenu'],
			'date_mise_a_jour' => date('Y-m-d H:i:s'),
		));
		$Post->recuperer();
		if(autorisationModification($Post, $this->getPage()->getApplication(), $this->getPage()->getAction()))
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_SUCCES,
				'contenu' => $lang['post_validation_edition_message_succes'],
			));
			$get=array_merge($config['post_validation_edition_lien_succes'], array('id' => $_GET['id']));
			$Post->mettre_a_jour();
		}
		else
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['post_validation_edition_message_permission'],
			));
			$get=array_merge($config['post_edition_lien_erreur_autorisation'], array('id' => $_GET['id']));
		}
	}
	else
	{
		$Notification=new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['post_validation_edition_message_id'],
		));
		$get=$config['post_validation_edition_lien_id'];
	}
}
else
{
	$Notification=new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['post_validation_edition_message_formulaire'],
	));
	$get=$config['post_validation_edition_lien_formulaire'];
}

$this->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($get));
exit();

?>