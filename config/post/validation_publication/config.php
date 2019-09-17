<?php

$Message=new \user\Message(array(
	'contenu'  => $lang['post_validation_publication_message_formulaire'],
	'type'     => \user\Message::TYPE_ERREUR,
	'css'      => $config['message_css'],
	'js'       => $config['message_js'],
	'template' => $config['message_template'],
));
$get=$config['post_validation_publication_retour'];
if(isset($_POST['publication_titre']) & isset($_POST['publication_contenu']) & !empty($_POST['publication_titre']) & !empty($_POST['publication_contenu']))
{
	$Post=new \post\Post(array(
		'id_auteur'        => $Visiteur->getId(),
		'titre'            => $_POST['publication_titre'],
		'contenu'          => $_POST['publication_contenu'],
		'date_publication' => date('Y-m-d H:i:s'),
		'date_mise_a_jour' => date('Y-m-d H:i:s'),
	));
	$Post->publier();
	$Message=new \user\Message(array(
		'contenu'  => $lang['post_validation_publication_message_succes'],
		'type'     => \user\Message::TYPE_SUCCES,
		'css'      => $config['message_css'],
		'js'       => $config['message_js'],
		'template' => $config['message_template'],
	));
	$get=$config['post_validation_publication_suivant'];
}

$_SESSION['message']=serialize($Message);
header('location: index.php'.$get);

?>