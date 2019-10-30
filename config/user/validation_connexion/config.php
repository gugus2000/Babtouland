<?php

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
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_SUCCES,
				'contenu' => $lang['user_validation_connexion_succes']
			), $this->getPage()->getPageElement());
			$get=$config['user_validation_connexion_suivant'];
		}
		else
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['erreur_connexion_mot_de_passe'],
			), $this->getPage()->getPageElement());
			$get=$config['user_validation_connexion_retour'];
		}
	}
	else
	{
		$Notification=new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['erreur_connexion_utilisateur'],
		), $this->getPage()->getPageElement());
		$get=$config['user_validation_connexion_retour'];
	}
}
else
{
	$Notification=new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['user_validation_connexion_formulaire'],
	), $this->getPage()->getPageElement());
	$get=$config['user_validation_connexion_retour'];
}

$this->getPage()->envoyerNotificationsSession();
header('location: index.php'.$get);

?>