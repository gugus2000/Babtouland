<?php

$_SESSION['message']=$lang['user_validation_connexion_formulaire'];
$get='?application=user&action=connexion';
if(isset($_POST['connexion_pseudo']) & isset($_POST['connexion_mdp']) & !empty($_POST['connexion_pseudo']) & !empty($_POST['connexion_mdp']))
{
	$Visiteur=new \user\Visiteur(array(
		'pseudo' => $_POST['connexion_pseudo'],
	));
	$Visiteur->recuperer();
	$Visiteur->connexion($_POST['connexion_mdp']);
	$get='';
	$_SESSION['message']=$lang['user_validation_connexion_succes'];
}

header('location: index.php'.$get);

?>