<?php

if (isset($Visiteur->getPage()->getParametres()['id']))
{
	$Message=new \forum\Message(array(
		'id' => $Visiteur->getPage()->getParametres()['id'],
	));
	$Message->recuperer();
	$Fil=new \forum\Fil(array(
		'id' => $Message->getId_fil(),
	));
	$Fil->recuperer();
	if ($Visiteur->autorisationModification($Message))
	{
		$Visiteur->getPage()->ajouterEnteteClassique();
		$Form=new \user\PageElement(array(
			'template' => $config['path_template'].$Visiteur->getPage()->afficherApplication().'/'.$Visiteur->getPage()->getAction().'/form.html',
			'elements' => array(
				'action'        => $Routeur->creerLien(array_merge($config['forum_message_edition_formulaire_action'], array($config['nom_parametres'] => array('id' => $Message->getId())))),
				'legend'        => $lang['forum_message_edition_formulaire_legend'],
				'label_contenu' => $lang['forum_message_edition_formulaire_label_contenu'],
				'value_contenu' => $Message->afficherContenu(),
				'submit'        => $lang['forum_message_edition_formulaire_submit'],
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
		$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));
	}
	else
	{
		$get=array_merge($config['forum_message_edition_notification_erreur_autorisation'],array($config['nom_parametres'] => array('id' => $Fil->getId())));
		new \user\page\Notification(array(
			'type'    => \user\page\Notification::TYPE_ERREUR,
			'contenu' => $lang['forum_message_edition_notification_erreur_autorisation'],
		));
		$Visiteur->getPage()->envoyerNotificationsSession();
		header('location: '.$Routeur->creerLien($get));
		die();
	}
}
else
{
	$get=$config['forum_message_edition_notification_erreur_id'];
	new \user\page\Notification(array(
		'type' => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['forum_message_edition_notification_erreur_id'],
	));
	$Visiteur->getPage()->envoyerNotificationsSession();
	header('location: '.$Routeur->creerLien($get));
	die();
}



?>