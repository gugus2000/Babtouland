<?php

$_SESSION['message']=$lang['user_validation_connexion_formulaire'];
$get=$config['user_validation_connexion_retour'];
if(isset($_POST['connexion_pseudo']) & isset($_POST['connexion_mdp']) & !empty($_POST['connexion_pseudo']) & !empty($_POST['connexion_mdp']))
{
	if ($Visiteur->Manager()->exist(array('pseudo' => $_POST['connexion_pseudo'])))
	{
		$Visiteur=new \user\Visiteur(array(
			'pseudo' => $_POST['connexion_pseudo'],
		));
		$Visiteur->recuperer();
		if ($Visiteur->connexion($_POST['connexion_mdp']))
		{
			$get=$config['user_validation_connexion_suivant'];
			$_SESSION['message']=$lang['user_validation_connexion_succes'];
		}
		else
		{
			$_SESSION['message']=$lang['erreur_connexion_mot_de_passe'];
		}
	}
	else
	{
		$_SESSION['message']=$lang['erreur_connexion_utilisateur'];	
	}
}

header('location: index.php'.$get);

?>