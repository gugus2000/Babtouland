<?php

$_SESSION['message']=$lang['post_commentaire_validation_edition_message_formulaire'];
$get=$config['post_commentaire_validation_edition_lien_formulaire'];

if(isset($_GET['id']) & isset($_POST['edition_commentaire_contenu']) & !empty($_GET['id'])& !empty($_POST['edition_commentaire_contenu']))
{
	$_SESSION['message']=$lang['post_commentaire_validation_edition_message_id'];
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
		$_SESSION['message']=$lang['post_commentaire_validation_edition_message_succes'];
		$get=$config['post_commentaire_validation_edition_lien_succes'].'&id='.$Post->afficherId();

		$Commentaire=new \post\Commentaire(array(
			'id' => $_GET['id'],
			'contenu' => $_POST['edition_commentaire_contenu'],
			'date_mise_a_jour' => date('Y-m-d H:i:s'),
		));
		$Commentaire->mettre_a_jour();
	}
}

header('location: index.php'.$get);

?>