<?php

if(isset($_GET['id']))
{
	$BDDFactory=new \core\BDDFactory;
	$CommentaireManager=new \post\CommentaireManager($BDDFactory->MysqlConnexion());
	if($CommentaireManager->existId((int)$_GET['id']))
	{
		$Commentaire=new \post\Commentaire(array(
			'id' => $_GET['id'],
		));
		$Commentaire->recuperer();
		if(autorisationModification($Commentaire, $this->getPage()->getApplication(), $this->getPage()->getAction()))
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_SUCCES,
				'contenu' => $lang['post_commentaire_suppression_message_succes'],
			));
			$get=$config['post_commentaire_suppression_suivant'].'&id='.$Commentaire->recupererPost()->afficherId();
			$Commentaire->supprimer();
		}
		else
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['post_commentaire_suppression_message_permission'],
			));
			$get=$config['post_commentaire_suppression_permission'].'&id='.$Commentaire->recupererPost()->afficherId();
		}
	}
	else
	{
		$Notification=new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['post_commentaire_suppression_message_inexistant'],
		));
		$get=$config['post_commentaire_suppression_retour'];
	}
}
else
{
	$Notification=new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['post_commentaire_suppression_message_argument'],
	));
	$get=$config['post_commentaire_suppression_retour'];
}

$this->getPage()->envoyerNotificationsSession();
header('location: index.php'.$get);

?>