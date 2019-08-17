<?php

$Message=new \user\Message(array(
	'contenu'  => $lang['post_validation_edition_message_formulaire'],
	'type'     => \user\Message::TYPE_ERREUR,
	'css'      => $config['message_css'],
	'js'       => $config['message_js'],
	'template' => $config['message_template'],
));
$get=$config['post_validation_edition_lien_formulaire'];

if(isset($_GET['id']) & isset($_POST['edition_titre']) & isset($_POST['edition_contenu']) & !empty($_GET['id']) & !empty($_POST['edition_titre']) & !empty($_POST['edition_contenu']))
{
	$Message=new \user\Message(array(
		'contenu'  => $lang['post_validation_edition_message_id'],
		'type'     => \user\Message::TYPE_ERREUR,
		'css'      => $config['message_css'],
		'js'       => $config['message_js'],
		'template' => $config['message_template'],
	));
	$get=$config['post_validation_edition_lien_id'];

	$BDDFactory=new \core\BDDFactory;
	$PostManager=new \post\PostManager($BDDFactory->MysqlConnexion());
	if($PostManager->existId((int)$_GET['id']))
	{
		$Message=new \user\Message(array(

			'contenu'  => $lang['post_validation_edition_message_succes'],
			'type'     => \user\Message::TYPE_SUCCES,
			'css'      => $config['message_css'],
			'js'       => $config['message_js'],
			'template' => $config['message_template'],
		));
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

$_SESSION['message']=serialize($Message);
header('location: index.php'.$get);

?>