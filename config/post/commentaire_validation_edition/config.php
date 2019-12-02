<?php


if(isset($_GET['id']) & isset($_POST['edition_commentaire_contenu']) & !empty($_GET['id'])& !empty($_POST['edition_commentaire_contenu']))
{

	$BDDFactory=new \core\BDDFactory;
	$CommentaireManager=new \post\CommentaireManager($BDDFactory->MysqlConnexion());
	if($CommentaireManager->existId((int)$_GET['id']))
	{
		$Commentaire=new \post\Commentaire(array(
			'id' => $_GET['id'],
		));
		$Commentaire->recuperer();
		$Post=$Commentaire->recupererPost();
		if(autorisationModification($Commentaire, $this->getPage()->getApplication(), $this->getPage()->getAction()))
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_SUCCES,
				'contenu' => $lang['post_commentaire_validation_edition_message_succes'],
			));
			$get=array_merge($config['post_commentaire_validation_edition_lien_succes'], array('id' => $Post->afficherId()));

			$Commentaire=new \post\Commentaire(array(
				'id'               => $_GET['id'],
				'contenu'          => $_POST['edition_commentaire_contenu'],
				'date_mise_a_jour' => date('Y-m-d H:i:s'),
			));
			$Commentaire->mettre_a_jour();
		}
		else
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['post_commentaire_validation_edition_message_permission'],
			));
			$get=array_merge($config['post_commentaire_validation_edition_permission'], array('id' => $Post->afficherId()));
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