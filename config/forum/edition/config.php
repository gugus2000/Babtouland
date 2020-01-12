<?php

if (isset($Visiteur->getPage()->getParametres()['id']))
{
	$Dossier=new \forum\Dossier(array(
		'id' => $Visiteur->getPage()->getParametres()['id'],
	));
	$Dossier->recuperer();
	if ($Visiteur->autorisationModification($Dossier))
	{
		$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre'].$Dossier->afficherNom());
		$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
			'name'   => 'description',
			'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
		));
		$Form=new \user\PageElement(array(
			'template' => $config['path_template'].$Visiteur->getPage()->afficherApplication().'/'.$Visiteur->getPage()->getAction().'/form.html',
			'elements' => array(
				'action'            => $Routeur->creerLien(array_merge($config['forum_edition_formulaire_action'], array($config['nom_parametres'] => array('id' => $Dossier->getId())))),
				'legend'            => $lang['forum_edition_formulaire_legend'],
				'label_nom'         => $lang['forum_edition_formulaire_label_nom'],
				'value_nom'         => $Dossier->afficherNom(),
				'label_description' => $lang['forum_edition_formulaire_label_description'],
				'value_description' => $Dossier->afficherDescription(),
				'submit'            => $lang['forum_edition_formulaire_submit'],
			),
		));
		$Formulaire=new \user\page\Formulaire($Form);
		$Contenu=new \user\PageElement(array(
			'template' => $Visiteur->getPage()->getTemplatePath(),
			'elements' => array(
				'formulaire' => $Formulaire,
			),
		));
		$Carte=new \user\page\Carte($Contenu);
		$MenuUp=new \user\page\MenuUp();
		$Corps=new \user\page\Corps($MenuUp, $Carte, '');
		$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
	}
	else
	{
		$get=$config['forum_edition_notification_erreur_droit'];
		new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['forum_edition_notification_erreur_droit'],
		));
	}
}
else
{
	$get=$config['forum_edition_notification_erreur_id'];
	new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['forum_edition_notification_erreur_id'],
	));
}

?>