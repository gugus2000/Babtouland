<?php

$_SESSION['message']=$lang['post_commentaireSuppression_message_argument'];
$get=$config['post_commentaireSuppression_retour'];
if(isset($_GET['id']))
{
	$_SESSION['message']=$lang['post_commentaireSuppression_message_inexistant'];
	$BDDFactory=new \core\BDDFactory;
	$CommentaireManager=new \post\CommentaireManager($BDDFactory->MysqlConnexion());
	if($CommentaireManager->existId((int)$_GET['id']))
	{
		$Commentaire=new \post\Commentaire(array(
			'id' => $_GET['id'],
		));
		$Commentaire->recuperer();
		$_SESSION['message']=$lang['post_commentaireSuppression_message_permission'];
		$get=$config['post_commentaireSuppression_permission'].'&id='.$Commentaire->recupererPost()->afficherId();
		if($Visiteur->getPseudo()==$Commentaire->recupererAuteur()->getPseudo() | $Visiteur->getRole()->existPermission($config['post_commentaireSuppression_admin_application'], $config['post_commentaireSuppression_admin_action']))
		{
			$_SESSION['message']=$lang['post_commentaireSuppression_message_succes'];
			$get=$config['post_commentaireSuppression_suivant'].'&id='.$Commentaire->recupererPost()->afficherId();
			$Commentaire->supprimer();
		}
	}
}

header('location: index.php'.$get);

?>