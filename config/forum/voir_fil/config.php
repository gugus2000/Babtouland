<?php

if (!isset($Visiteur->getPage()->getParametres()['id']))
{
	$get=$config['forum_voir_fil_notification_erreur_id'];
	new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['forum_voir_fil_notification_erreur_id'],
	));
	$Visiteur->getPage()->envoyerNotificationsSession();
	header('location: '.$Routeur->creerLien($get));
	exit();
}
$Fil=new \forum\Fil(array(
	'id' => $Visiteur->getPage()->getParametres()['id'],
));
$Fil->recuperer();
if ($Fil->getType()!=$Fil::TYPE)
{
	$get=array_merge($config['forum_voir_fil_notification_erreur_fil'], array($config['nom_parametres'] => array('id' => $Visiteur->getPage()->getParametres()['id'])));
	new \user\page\Notification(array(
		'type'    => \user\page\Notification::TYPE_ERREUR,
		'contenu' => $lang['forum_voir_fil_notification_erreur_fil'],
	));
	$Visiteur->getPage()->envoyerNotificationsSession();
	header('location: '.$Routeur->creerLien($get));
	exit();
}
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_titre'].$Fil->afficherNom());
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('css', $config['path_assets'].'css/forum.css');
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name'   => 'description',
	'content' => $lang[$Visiteur->getPage()->getApplication().'_'.$Visiteur->getPage()->getAction().'_description'],
));
$chemins=array();
foreach ($Fil->getDescendance() as $dossier)
{
	$chemins[]=new \user\PageElement(array(
		'template' => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/chemin.html',
		'elements' => array(
			'href'  => $Routeur->creerLien(array_merge($config['forum_voir_fil_chemin_lien'], array( $config['nom_parametres'] => array('id' => $dossier->afficherId())))),
			'titre' => $dossier->afficherNom(),
			'nom'   => $dossier->afficherNom(),
		),
	));
}
$Bandeau=new \user\PageElement(array(
	'template' => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/bandeau.html',
	'elements' => array(
		'chemins'     => $chemins,
		'description' => $Fil->afficherDescription(),
	),
));
$messages=array();
foreach ($Fil->recupererMessages() as $Message)
{
	$Auteur=new \user\Utilisateur(array(
		'id' => $Message->getId_auteur(),
	));
	$Auteur->recuperer();
	$messages[]=new \user\PageElement(array(
		'template' => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/message.html',
		'elements' => array(
			'nom_auteur'   => $Auteur->afficherNom(),
			'lien_auteur'  => $Routeur->creerLien(array_merge($config['forum_voir_fil_message_lien_auteur'], array($config['nom_parametres'] => array('id' => $Auteur->afficherId())))),
			'titre_auteur' => $lang['forum_voir_fil_message_titre_auteur'].$Auteur->afficherNom(),
			'date'         => $Message()->afficherDate_publication(),
			'contenu'      => $Message->afficherContenu(),
		),
	));
}
$Contenu=new \user\PageElement(array(
	'template' => $Visiteur->getPage()->getTemplatePath(),
	'elements' => array(
		'bandeau' => $Bandeau,
		'messages' => $messages,
	),
));
$MenuUp=new \user\page\MenuUp();
$Corps=new \user\page\Corps($MenuUp, $Contenu, '');
$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);

?>