<?php

$_SESSION['message']=$lang['post_commentaire_publication_message_formulaire'];
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
	$_SESSION['message']=$lang['post_commentair_publication_message_succes'];
	$get=$config['post_commentaire_publication_suivant'].'&id='.$_GET['id'];
}

header('location: index.php'.$get);

 ?>