<?php

if (isset($_POST['notification_message']) & isset($_POST['notification_type']) & isset($_POST['notification_groupe']) & isset($_POST['notification_utilisateurs']))
{
	if (!empty($_POST['notification_message']) & !empty($_POST['notification_type']))
	{
		$UtilisateurManager=new \user\UtilisateurManager(\core\BDDFactory::MysqlConnexion());
		if (empty($_POST['notification_groupe']) | $_POST['notification_groupe']=='tous' | $_POST['notification_groupe']=='all')	// Tous
		{
			$resultats=$UtilisateurManager->getBy(array(
				'id' => $config['id_guest'],
			), array(
				'id' => '!=',
			));
		}
		else 	// Un groupe particulier
		{
			$RoleManager=new \user\RoleManager(\core\BDDFactory::MysqlConnexion());
			$resultats=$RoleManager->getBy(array(
				'nom_role' => $_POST['notification_groupe'],
				'id'       => $config['id_guest'],
			), array(
				'nom_role' => '=',
				'id'       => '!=',
			));
		}
		$ids=array();
		foreach ($resultats as $resultat)
		{
			$ids[]=$resultat['id'];
		}
		if (!empty($_POST['notification_utilisateurs']))		// Sélection
		{
			$resultats_def=array();
			$utilisateurs=explode(' ', $_POST['notification_utilisateurs']);
			foreach ($utilisateurs as $utilisateur)
			{
				if (is_int($utilisateur))	// id
				{
					if ($utilisateur!=$config['id_guest'])
					{
						$id=$utilisateur;
					}
				}
				else 	// pseudo
				{
					if ($utilisateur!=$config['nom_guest'])
					{
						$id=$UtilisateurManager->getIdBy(array(
							'pseudo' => $utilisateur,
						));
					}
				}
				if (in_array($id, $ids))
				{
					$resultats_def[]=$id;
				}
			}
			$resultats=$resultats_def;
		}
		else
		{
			$resultats=$ids;
		}
		if (empty($resultats))
		{
			new \user\page\Notification(array(
				'type' => \user\page\Notification::TYPE_ATTENTION,
				'contenu' => $lang['admin_validation_publier_notification_attention_utilisateurs_vide'],
			));
		}
		$Notification=new \user\Notification(array(
			'type'            => $_POST['notification_type'],
			'contenu_defaut'  => $_POST['notification_message'],
			'contenu_FR'      => '',
			'contenu_EN'      => '',
			'id_utilisateurs' => $resultats,
		));
		$Notification->creer();
		new \user\page\Notification(array(
			'type' => \user\page\Notification::TYPE_SUCCES,
			'contenu' => $lang['admin_validation_publier_notification_succes'],
		));
		$get=$config['admin_validation_publier_notification_succes'];
	}
	else
	{
		new \user\page\Notification(array(
			'type' => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['admin_validation_publier_notification_erreur_vide'],
		));
		$get=$config['admin_validation_publier_notification_erreur_vide'];
	}
}
else
{
	new \user\page\Notification(array(
		'type' => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['admin_validation_publier_notification_erreur_formulaire'],
	));
	$get=$config['admin_validation_publier_notification_utilisateurs_erreur_formulaire'];
}

$this->getPage()->envoyerNotificationsSession();
header('location: index.php'.$get);

?>