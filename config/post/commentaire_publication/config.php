<?php

if(isset($_POST['commentaire_contenu']) & isset($_GET['id']) & !empty($_POST['commentaire_contenu']) & !empty($_GET['id']))
{
	$Commentaire=new \post\Commentaire(array(
		'id_auteur'        => $Visiteur->getId(),
		'id_post'          => $_GET['id'],
		'contenu'          => $_POST['commentaire_contenu'],
		'date_publication' => date('Y-m-d H:i:s'),
		'date_mise_a_jour' => date('Y-m-d H:i:s'),
	));
	$Commentaire->publier();
	$Notification=new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_SUCCES,
		'contenu' => $lang['post_commentaire_publication_message_succes'],
	));
	$get=$config['post_commentaire_publication_suivant'].'&id='.htmlspecialchars($_GET['id']);
}
else
{
	$Notification=new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['post_commentaire_publication_message_formulaire'],
	));
	$get=$config['post_commentaire_publication_retour'];
}

$this->getPage()->envoyerNotificationsSession();
header('location: index.php'.$get);

 ?>