<?php

$_SESSION['message']=$lang['user_validation_edition_message_formulaire'];
$get=$config['user_validation_edition_lien_erreur_formulaire'];
if(isset($_POST['edition_avatar']) & !empty($_POST['edition_avatar']) | $Visiteur->getRole()->existPermission($config['user_edition_admin_application'], $config['user_edition_admin_action']))
{
	$_SESSION['message']=$lang['user_validation_edition_message_succes'];
	$get=$config['user_validation_edition_lien_succes'];
	$banni=$Visiteur->getBanni();
	if(isset($_GET['id']) & $Visiteur->getRole()->existPermission($config['user_edition_admin_application'], $config['user_edition_admin_action']))
	{
		$id=(int)$_GET['id'];
		$_SESSION['message']=$lang['user_validation_edition_message_admin_succes'];
		$get=$config['user_validation_edition_lien_admin_succes'].'&id='.$id;
		$banni=False;
		if(isset($_POST['edition_banni']))
		{
			$banni=True;
		}
	}
	$Utilisateur=new \user\Visiteur(array(
		'id' => $id,
		'avatar' => $_POST['edition_avatar'],
		'banni' => $banni,
	));
	$Utilisateur->mettre_a_jour();
}

header('location: index.php'.$get)

?>