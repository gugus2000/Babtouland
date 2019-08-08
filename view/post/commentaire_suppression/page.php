<?php

$_SESSION['message']=$lang['post_commentaire_suppression_message_argument'];
$get=$config['post_commentaire_suppression_retour'];
if(isset($_GET['id']))
{
	$_SESSION['message']=$lang['post_commentaire_suppression_message_inexistant'];
	$BDDFactory=new \core\BDDFactory;
	$CommentaireManager=new \post\CommentaireManager($BDDFactory->MysqlConnexion());
	if($CommentaireManager->existId((int)$_GET['id']))
	{
		$Commentaire=new \post\Commentaire(array(
			'id' => $_GET['id'],
		));
		$Commentaire->recuperer();
		$_SESSION['message']=$lang['post_commentaire_suppression_message_permission'];
		$get=$config['post_commentaire_suppression_permission'].'&id='.$Commentaire->recupererPost()->afficherId();
		if(autorisationModification($Commentaire, $Visiteur->getPage()->getApplication(), $Visiteur->getPage()->getAction()))
		{
			$_SESSION['message']=$lang['post_commentaire_suppression_message_succes'];
			$get=$config['post_commentaire_suppression_suivant'].'&id='.$Commentaire->recupererPost()->afficherId();
			$Commentaire->supprimer();
		}
	}
}

header('location: index.php'.$get);

?>