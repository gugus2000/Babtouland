<?php

if (isset($_POST['lang']) & isset($_POST['post_fil_post_nombre_posts']))
{
	if (!empty($_POST['lang']) & !empty($_POST['post_fil_post_nombre_posts']))
	{
		$ConfigurationManager=new \user\ConfigurationManager(\core\BDDFactory::MysqlConnexion());
		if (in_array($_POST['lang'], $config['lang_available']))	// C'est dans la liste des langues disponibles
		{
			if ($Visiteur->getId()!=$config['id_guest'])
				{
					if ($ConfigurationManager->exist(array(
						'id_utilisateur' => $Visiteur->getId(),
						'nom'            => 'lang',
					)))
					{
						$id=$ConfigurationManager->getIdBy(array(
							'id_utilisateur' => $Visiteur->getId(),
							'nom'            => 'lang',
						));
						$Configuration=new \user\Configuration(array(
							'id'             => $id,
							'id_utilisateur' => $Visiteur->getId(),
							'nom'            => 'lang',
							'valeur'         => $_POST['lang'],
						));
						$Configuration->changer();
					}
					else
					{
						$Configuration=new \user\Configuration(array(
							'id_utilisateur' => $Visiteur->getId(),
							'nom'            => 'lang',
							'valeur'         => $_POST['lang'],
						));
						$Configuration->creer();
					}
				}
				else 	// C'est un guest
				{
					$_SESSION['lang']=$_POST['lang'];
				}
		}
		else
		{
			new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ATTENTION,
				'contenu' => $lang['user_validation_configurations_attention_lang_pas_valide'],
			));
		}
		if (is_numeric($_POST['post_fil_post_nombre_posts']))	// C'est bien un nombre
		{
			if ((int)$_POST['post_fil_post_nombre_posts']>0)
			{
				if ($Visiteur->getId()!=$config['id_guest'])
				{
					if ($ConfigurationManager->exist(array(
						'id_utilisateur' => $Visiteur->getId(),
						'nom'            => 'post_fil_post_nombre_posts',
					)))
					{
						$id=$ConfigurationManager->getIdBy(array(
							'id_utilisateur' => $Visiteur->getId(),
							'nom'            => 'post_fil_post_nombre_posts',
						));
						$Configuration=new \user\Configuration(array(
							'id'             => $id,
							'id_utilisateur' => $Visiteur->getId(),
							'nom'            => 'post_fil_post_nombre_posts',
							'valeur'         => $_POST['post_fil_post_nombre_posts'],
						));
						$Configuration->changer();
					}
					else
					{
						$Configuration=new \user\Configuration(array(
							'id_utilisateur' => $Visiteur->getId(),
							'nom'            => 'post_fil_post_nombre_posts',
							'valeur'         => $_POST['post_fil_post_nombre_posts'],
						));
						$Configuration->creer();
					}
				}
				else 	// C'est un guest
				{
					$_SESSION['post_fil_post_nombre_posts']=$_POST['post_fil_post_nombre_posts'];
				}
			}
			else
			{
				new \user\page\Notification(array(
					'type'    => \user\page\Notification::TYPE_ATTENTION,
					'contenu' => $lang['user_validation_configurations_attention_post_fil_post_nombre_posts_pas_valide'],
				));
			}
		}
		else
		{
			new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ATTENTION,
				'contenu' => $lang['user_validation_configurations_attention_post_fil_post_nombre_posts_pas_numerique'],
			));
		}
		new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_SUCCES,
			'contenu' => $lang['user_validation_configurations_succes'],
		));
		$get=$config['user_validation_configurations_succes'];
	}
	else
	{
		new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['user_validation_configurations_erreur_formulaire_vide'],
		));
		$get=$config['user_validation_configurations_erreur_formulaire_vide'];
	}
}
else
{
	new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['user_validation_configurations_erreur_formulaire_mal_remplit'],
	));
	$get=$config['user_validation_configurations_erreur_formulaire_mal_remplit'];
}
$this->getPage()->envoyerNotificationsSession();
header('location: index.php'.$get);

?>