<?php

if (!isset($Visiteur->getPage()->getParametres()['id_fil']))
{
	$get=$config['forum_message_ajout_notification_erreur_id'];
	new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['forum_message_ajout_notification_erreur_id'],
	));
	$Visiteur->getPage()->envoyerNotificationsSession();
	header('location: '.$Routeur->creerLien($get));
	exit();
}

$Fil=new \forum\Fil(array(
	'id' => $Visiteur->getPage()->getParametres()['id_fil'],
));
$Fil->recuperer();
if ($Fil->gettype()!=$Fil::TYPE)
{
	$get=array_merge($config['forum_message_ajout_notification_erreur_type'], array($config['nom_parametres'] => array( 'id' => $Fil->getId())));
	new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['forum_message_ajout_notification_erreur_type'],
	));
	$Visiteur->getPage()->envoyerNotificationsSession();
	header('location: '.$Routeur->creerLien($get));
	exit();
}

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->afficherApplication().'_'.$Visiteur->getPage()->afficherAction().'_titre']);
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'   => 'description',
	'content' => $lang[$Visiteur->getPage()->afficherApplication().'_'.$Visiteur->getPage()->afficherAction().'_description'],
));
$form=new \user\PageElement(array(
	'template' => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/form.html',
	'elements' => array(
		'action'        => $Routeur->creerLien(array_merge($config['forum_message_ajout_formulaire_action'], array($config['nom_parametres'] => array('id_fil' => $Fil->getId())))),
		'legend'        => $lang['forum_message_ajout_formulaire_legend'],
		'label_contenu' => $lang['forum_message_ajout_formulaire_label_contenu'],
		'submit'        => $lang['forum_message_ajout_formulaire_submit'],
	),
));
$Formulaire=new \user\page\Formulaire($form);
$contenu=new \user\PageElement(array(
	'template' => $Visiteur->getPage()->getTemplatePath(),
	'elements' => array(
		'formulaire' => $Formulaire,
	),
));
$Carte=new \user\page\Carte($contenu);
$Tete=new \user\page\MenuUp();
$Corps=new \user\page\Corps($Tete, $Carte, '');
$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);
$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));

?>