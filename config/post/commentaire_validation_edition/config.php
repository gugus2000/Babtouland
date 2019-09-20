<?php

$Message=new \user\Message(array(
	'contenu'  => $lang['post_commentaire_validation_edition_message_formulaire'],
	'type'     => \user\Message::TYPE_ERREUR,
	'css'      => $config['message_css'],
	'js'       => $config['message_js'],
	'template' => $config['message_template'],
));
$get=$config['post_commentaire_validation_edition_lien_formulaire'];

if(isset($_GET['id']) & isset($_POST['edition_commentaire_contenu']) & !empty($_GET['id'])& !empty($_POST['edition_commentaire_contenu']))
{
	$Message=new \user\Message(array(
		'contenu'  => $lang['post_commentaire_validation_edition_message_id'],
		'type'     => \user\Message::TYPE_ERREUR,
		'css'      => $config['message_css'],
		'js'       => $config['message_js'],
		'template' => $config['message_template'],
	));
	$get=$config['post_commentaire_validation_edition_lien_id'];

	$BDDFactory=new \core\BDDFactory;
	$CommentaireManager=new \post\CommentaireManager($BDDFactory->MysqlConnexion());
	if($CommentaireManager->existId((int)$_GET['id']))
	{
		$Commentaire=new \post\Commentaire(array(
			'id' => $_GET['id'],
		));
		$Commentaire->recuperer();
		$Post=$Commentaire->recupererPost();
		$Message=new \user\Message(array(
			'contenu'  => $lang['post_commentaire_validation_edition_message_permission'],
			'type'     => \user\Message::TYPE_ERREUR,
			'css'      => $config['message_css'],
			'js'       => $config['message_js'],
			'template' => $config['message_template'],
		));
		$get=$config['post_commentaire_validation_edition_permission'].'&id='.$Post->afficherId();
		if(autorisationModification($Commentaire, $application, $action))
		{
			$Message=new \user\Message(array(
				'contenu'  => $lang['post_commentaire_validation_edition_message_succes'],
				'type'     => \user\Message::TYPE_SUCCES,
				'css'      => $config['message_css'],
				'js'       => $config['message_js'],
				'template' => $config['message_template'],
			));
			$get=$config['post_commentaire_validation_edition_lien_succes'].'&id='.$Post->afficherId();

			$Commentaire=new \post\Commentaire(array(
				'id' => $_GET['id'],
				'contenu' => $_POST['edition_commentaire_contenu'],
				'date_mise_a_jour' => date('Y-m-d H:i:s'),
			));
			$Commentaire->mettre_a_jour();
		}
	}
}

$_SESSION['message']=serialize($Message);
header('location: index.php'.$get);

?>