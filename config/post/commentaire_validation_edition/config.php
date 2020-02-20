<?php


if(isset($Visiteur->getPage()->getParametres()['id']) & isset($_POST['edition_commentaire_contenu']) & !empty($Visiteur->getPage()->getParametres()['id'])& !empty($_POST['edition_commentaire_contenu']))
{

	$BDDFactory=new \core\BDDFactory;
	$CommentaireManager=new \post\CommentaireManager($BDDFactory->MysqlConnexion());
	if($CommentaireManager->existId((int)$Visiteur->getPage()->getParametres()['id']))
	{
		$Commentaire=new \post\Commentaire(array(
			'id' => $Visiteur->getPage()->getParametres()['id'],
		));
		$Commentaire->recuperer();
		$Post=$Commentaire->recupererPost();
		if($Visiteur->autorisationModification($Commentaire))
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_SUCCES,
				'contenu' => $lang['post_commentaire_validation_edition_message_succes'],
			));
			$get=array_merge($config['post_commentaire_validation_edition_lien_succes'], array($config['nom_parametres'] => array('id' => $Post->afficherId())));

			$Commentaire=new \post\Commentaire(array(
				'id'               => $Visiteur->getPage()->getParametres()['id'],
				'contenu'          => $_POST['edition_commentaire_contenu'],
				'date_mise_a_jour' => date($config['format_date']),
			));
			$Commentaire->mettre_a_jour();
		}
		else
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['post_commentaire_validation_edition_message_permission'],
			));
			$get=array_merge($config['post_commentaire_validation_edition_permission'], array($config['nom_parametres'] => array('id' => $Post->afficherId())));
		}
	}
	else
	{
		$Notification=new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['post_commentaire_validation_edition_message_id'],
		));
		$get=$config['post_commentaire_validation_edition_lien_id'];
	}
}
else
{
	$Notification=new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['post_commentaire_validation_edition_message_formulaire'],
	));
	$get=$config['post_commentaire_validation_edition_lien_formulaire'];
}

$this->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($get));
exit();

?>