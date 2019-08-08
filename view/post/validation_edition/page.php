<?php

$_SESSION['message']=$lang['post_validation_edition_message_formulaire'];
$get=$config['post_validation_edition_lien_formulaire'];

if(isset($_GET['id']) & isset($_POST['edition_titre']) & isset($_POST['edition_contenu']) & !empty($_GET['id']) & !empty($_POST['edition_titre']) & !empty($_POST['edition_contenu']))
{
	$_SESSION['message']=$lang['post_validation_edition_message_id'];
	$get=$config['post_validation_edition_lien_id'];

	$BDDFactory=new \core\BDDFactory;
	$PostManager=new \post\PostManager($BDDFactory->MysqlConnexion());
	if($PostManager->existId((int)$_GET['id']))
	{
		$_SESSION['message']=$lang['post_validation_edition_message_succes'];
		$get=$config['post_validation_edition_lien_succes'].'&id='.$_GET['id'];

		$Post=new \post\Post(array(
			'id' => $_GET['id'],
			'titre' => $_POST['edition_titre'],
			'contenu' => $_POST['edition_contenu'],
			'date_mise_a_jour' => date('Y-m-d H:i:s'),
		));
		$Post->mettre_a_jour();
	}
}

header('location: index.php'.$get);

?>