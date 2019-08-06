<?php

$_SESSION['message']=$lang['user_validation_connexion_formulaire'];
$get=$config['post_validationConnexion_retour'];
if(isset($_POST['connexion_pseudo']) & isset($_POST['connexion_mdp']) & !empty($_POST['connexion_pseudo']) & !empty($_POST['connexion_mdp']))
{
	$Visiteur=new \user\Visiteur(array(
		'pseudo' => $_POST['connexion_pseudo'],
	));
	$Visiteur->recuperer();
	$Visiteur->connexion($_POST['connexion_mdp']);
	$get=$config['post_validationConnexion_suivant'];
	$_SESSION['message']=$lang['user_validation_connexion_succes'];
}

header('location: index.php'.$get);

?>