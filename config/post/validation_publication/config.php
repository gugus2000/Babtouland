<?php

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
	$Notification=new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_SUCCES,
		'contenu' => $lang['post_validation_publication_message_succes'],
	));
	$get=$config['post_validation_publication_suivant'];
}
else
{
	$Notification=new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['post_validation_publication_message_formulaire'],
	));
	$get=$config['post_validation_publication_retour'];
}

$this->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($get));

?>