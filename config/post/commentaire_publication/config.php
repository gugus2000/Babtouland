<?php

if(isset($_POST['commentaire_contenu']) & isset($Visiteur->getPage()->getParametres()['id']) & !empty($_POST['commentaire_contenu']) & !empty($Visiteur->getPage()->getParametres()['id']))
{
	$Commentaire=new \post\Commentaire(array(
		'id_auteur'        => $Visiteur->getId(),
		'id_post'          => $Visiteur->getPage()->getParametres()['id'],
		'contenu'          => $_POST['commentaire_contenu'],
		'date_publication' => date('Y-m-d H:i:s'),
		'date_mise_a_jour' => date('Y-m-d H:i:s'),
	));
	$Commentaire->publier();
	$Notification=new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_SUCCES,
		'contenu' => $lang['post_commentaire_publication_message_succes'],
	));
	$get=array_merge($config['post_commentaire_publication_suivant'], array($config['nom_parametres'] => array('id' => $Visiteur->getPage()->getParametres()['id'])));
}
else
{
	new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['post_commentaire_publication_message_formulaire'],
	));
	$get=$config['post_commentaire_publication_retour'];
}

$this->getPage()->envoyerNotificationsSession();
header('location: '.$Routeur->creerLien($get));
exit();

 ?>