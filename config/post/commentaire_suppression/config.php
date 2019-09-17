<?php

$Message=new \user\Message(array(
	'contenu'  => $lang['post_commentaire_suppression_message_argument'],
	'type'     => \user\Message::TYPE_ERREUR,
	'css'      => $config['message_css'],
	'js'       => $config['message_js'],
	'template' => $config['message_template'],
));
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
		$Message=new \user\Message(array(
			'contenu'  => $lang['post_commentaire_suppression_message_permission'],
			'type'     => \user\Message::TYPE_ERREUR,
			'css'      => $config['message_css'],
			'js'       => $config['message_js'],
			'template' => $config['message_template'],
		));
		$get=$config['post_commentaire_suppression_permission'].'&id='.$Commentaire->recupererPost()->afficherId();
		if(autorisationModification($Commentaire, $application, $action))
		{
			$Message=new \user\Message(array(
				'contenu'  => $lang['post_commentaire_suppression_message_succes'],
				'type'     => \user\Message::TYPE_SUCCES,
				'css'      => $config['message_css'],
				'js'       => $config['message_js'],
				'template' => $config['message_template'],
			));
			$get=$config['post_commentaire_suppression_suivant'].'&id='.$Commentaire->recupererPost()->afficherId();
			$Commentaire->supprimer();
		}
	}
}

$_SESSION['message']=serialize($Message);
header('location: index.php'.$get);

?>