<?php

if (isset($Visiteur->getPage()->getParametres()['id']))
{
	$PostManager=new \post\PostManager(\core\BDDFactory::MysqlConnexion());
	if ($PostManager->existId((int)$Visiteur->getPage()->getParametres()['id']))
	{
		$Post=new \post\Post(array(
			'id' => $Visiteur->getPage()->getParametres()['id'],
		));
		$Post->recuperer();
		if ($Visiteur->autorisationModification($Post))
		{
			$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre']);
			$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
				'name'    => 'description',
				'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
			));

			$Contenu=new \user\PageElement(array(
				'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/form.html',
				'elements' => array(
					'action'        => $Routeur->creerLien(array_merge($config['post_edition_formulaire_action'], array($config['nom_parametres'] => array('id' => $Post->afficherId())))),
					'legend'        => $lang['post_edition_formulaire_legend'],
					'label_titre'   => $lang['post_edition_formulaire_titre'],
					'titre'         => $Post->afficherTitre(),
					'label_contenu' => $lang['post_edition_formulaire_contenu'],
					'contenu'       => $Post->afficherContenu(),
					'submit'        => $lang['post_edition_formulaire_submit'],
				),
			));

			$Formulaire=new \user\page\Formulaire($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));

			$Contenu=new \user\PageElement(array(
				'template'  => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/'.$config['filename_contenu_template'],
				'elements'  => array(
					'formulaire' => $Formulaire,
				),
			));

			$Carte=new \user\page\Carte($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));
			$MenuUp=new \user\page\MenuUp($Visiteur->getPage()->getpageElement()->getElement($config['tete_nom']));
			$Corps=new \user\page\Corps($MenuUp, $Carte, '');

			$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
			$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));
		}
		else
		{
			$Notification=new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['post_edition_message_erreur_autorisation'],
			));
			$this->getPage()->envoyerNotificationsSession();
			header('location: '.$Routeur->creerLien(array_merge($config['post_edition_lien_erreur_autorisation'], array($config['nom_parametres'] => array('id' => $Visiteur->getPage()->getParametres()['id'])))));
			exit();
		}
	}
	else
	{
		$Notification=new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['post_edition_message_erreur_existe'],
		));
		$this->getPage()->envoyerNotificationsSession();
		header('location: '.$Routeur->creerLien($config['post_edition_lien_erreur_existe']));
		exit();
	}
}
else
{
	$Notification=new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['post_edition_message_erreur_id'],
	));
	$this->getPage()->envoyerNotificationsSession();
	header('location: '.$Routeur->creerLien($config['post_edition_lien_erreur_id']));
	exit();
}

?>