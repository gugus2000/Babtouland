<?php

$_SESSION['message']=$lang['post_validationPublication_message_formulaire'];
$get=$config['post_validationPublication_retour'];
if(isset($_POST['publication_titre']) & isset($_POST['publication_contenu']) & !empty($_POST['publication_titre']) & !empty($_POST['publication_contenu']))
{
	$Post=new \post\Post(array(
		'id_auteur'        => $Visiteur->getId(),
		'titre'            => $_POST['publication_titre'],
		'contenu'          => $_POST['publication_contenu'],
		'date_publication' => date('Y-m-d H:i:s'),
		'date_mise_a_jour' => 0,
	));
	$Post->publier();
	$_SESSION['message']=$lang['post_validationPublication_message_succes'];
	$get=$config['post_validationPublication_suivant'];
}

header('location: index.php'.$get);

?>