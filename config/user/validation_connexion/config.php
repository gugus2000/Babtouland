<?php

$Message=new \user\Message(array(
	'contenu'  => $lang['user_validation_connexion_formulaire'],
	'type'     => \user\Message::TYPE_ERREUR,
	'css'      => $config['message_css'],
	'js'       => $config['message_js'],
	'template' => $config['message_template'],
));
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
			$Message=new \user\Message(array(
				'contenu'  => $lang['user_validation_connexion_succes'],
				'type'     => \user\Message::TYPE_SUCCES,
				'css'      => $config['message_css'],
				'js'       => $config['message_js'],
				'template' => $config['message_template'],
			));
		}
		else
		{
			$Message=new \user\Message(array(
				'contenu'  => $lang['erreur_connexion_mot_de_passe'],
				'type'     => \user\Message::TYPE_ERREUR,
				'css'      => $config['message_css'],
				'js'       => $config['message_js'],
				'template' => $config['message_template'],
			));
		}
	}
	else
	{
		$Message=new \user\Message(array(
			'contenu'  => $lang['erreur_connexion_utilisateur'],
			'type'     => \user\Message::TYPE_ERREUR,
			'css'      => $config['message_css'],
			'js'       => $config['message_js'],
			'template' => $config['message_template'],
		));
	}
}

$_SESSION['message']=serialize($Message);
header('location: index.php'.$get);

?>