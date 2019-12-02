<?php

if (isset($_GET['id']))
{
	$CommentaireManager=new \post\CommentaireManager(\core\BDDFactory::MysqlConnexion());
	if ($CommentaireManager->existId((int)$_GET['id']))
	{
		$Commentaire=new \post\Commentaire(array(
			'id' => $_GET['id'],
		));
		$Commentaire->recuperer();
		if (autorisationModification($Commentaire, $this->getPage()->getApplication(), $this->getPage()->getAction()))
		{
			$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre']);
			$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
				'name'    => 'description',
				'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
			));

			$Contenu=new \user\PageElement(array(
				'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/form.html',
				'elements' => array(
					'action'        => $Routeur->creerLien(array_merge($config['post_commentaire_edition_formulaire_action'], array('id' => $Commentaire->afficherId()))),
					'legend'        => $lang['post_commentaire_edition_formulaire_legend'],
					'label_contenu' => $lang['post_commentaire_edition_formulaire_contenu'],
					'contenu'       => $Commentaire->afficherContenu(),
					'submit'        => $lang['post_commentaire_edition_formulaire_submit'],
				),
			));

			$Formulaire=new \user\page\Formulaire($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));

			$Contenu=new \user\PageElement(array(
				'template'  => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/'.$config['filename_contenu_template'],
				'fonctions' => $config['path_func'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/'.$config['filename_contenu_fonctions'],
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
			new \user\page\Notification(array(
				'type'    => \user\page\Notification::TYPE_ERREUR,
				'contenu' => $lang['post_commentaire_edition_message_erreur_autorisation'],
			));
			header('location: '.$Routeur->creerLien(array_merge($config['post_commentaire_edition_lien_erreur_autorisation'], array('id' => $_GET['id'])));
			exit();
		}
	}
	else
	{
		new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['post_commentaire_edition_message_erreur_existe'],
		));
		header('location: '.$Routeur->creerLien($config['post_commentaire_edition_lien_erreur_existe']));
		exit();
	}
}
else
{
	new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['post_commentaire_edition_message_erreur_id'],
	));
	header('location: '.$Routeur->creerLien($config['post_commentaire_edition_lien_erreur_id']));
	exit();
}

?>