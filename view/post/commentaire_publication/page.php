<?php

$Message=new \user\Message(array(
	'contenu'  => $lang['post_commentaire_publication_message_formulaire'],
	'type'     => \user\Message::TYPE_ERREUR,
	'css'      => $config['message_css'],
	'js'       => $config['message_js'],
	'template' => $config['message_template'],
));
$get=$config['post_commentaire_publication_retour'];
if(isset($_POST['commentaire_contenu']) & isset($_GET['id']) & !empty($_POST['commentaire_contenu']) & !empty($_GET['id']))
{
	$Commentaire=new \post\Commentaire(array(
		'id_auteur'        => $Visiteur->getId(),
		'id_post'          => $_GET['id'],
		'contenu'          => $_POST['commentaire_contenu'],
		'date_publication' => date('Y-m-d H:i:s'),
		'date_mise_a_jour' => 0,
	));
	$Commentaire->publier();
	$Message=new \user\Commentaire(array(
		'contenu'  => $lang['post_commentair_publication_message_succes'],
		'type'     => \user\Message::TYPE_SUCCES,
		'css'      => $config['message_css'],
		'js'       => $config['message_js'],
		'template' => $config['message_template'],
	));	$get=$config['post_commentaire_publication_suivant'].'&id='.$_GET['id'];
}

$_SESSION['message']=serialize($Message);
header('location: index.php'.$get);

 ?>