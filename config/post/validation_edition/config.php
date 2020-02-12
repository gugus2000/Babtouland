<?php

if(isset($Visiteur->getPage()->getParametres()['id']) & isset($_POST['edition_titre']) & isset($_POST['edition_contenu']) & !empty($Visiteur->getPage()->getParametres()['id']) & !empty($_POST['edition_titre']) & !empty($_POST['edition_contenu']))
{

	$BDDFactory=new \core\BDDFactory;
	$PostManager=new \post\PostManager($BDDFactory->MysqlConnexion());
	if($PostManager->existId((int)$Visiteur->getPage()->getParametres()['id']))
	{
		$Post=new \post\Post(array(
			'id'               => $Visiteur->getPage()->getParametres()['id'],
			'titre'            => $_POST['edition_titre'],
			'contenu'          => $_POST['edition_contenu'],
			'date_mise_a_jour' => date('Y-m-d H:i:s'),
		));
		if($Visiteur->autorisationModification($Post))
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_SUCCES,
				'contenu' => $lang['post_validation_edition_message_succes'],
			));
			$get=array_merge($config['post_validation_edition_lien_succes'], array($config['nom_parametres'] => array('id' => $Visiteur->getPage()->getParametres()['id'])));
			$Post->mettre_a_jour();
		}
		else
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['post_validation_edition_message_permission'],
			));
			$get=array_merge($config['post_edition_lien_erreur_autorisation'], array($config['nom_parametres'] => array('id' => $Visiteur->getPage()->getParametres()['id'])));
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