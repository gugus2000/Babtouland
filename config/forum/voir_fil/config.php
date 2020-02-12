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
	if ($Visiteur->autorisationModification($Message))
	{
		$outils=new \user\PageElement(array(
			'template' => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/outils.html',
			'elements' => array(
				'lien_supprimer' => $Routeur->creerLien(array_merge($config['forum_voir_fil_lien_message_suppression'],array($config['nom_parametres'] => array('id' => $Message->getId())))),
				'lien_editer'    => $Routeur->creerLien(array_merge($config['forum_voir_fil_lien_message_edition'],array($config['nom_parametres'] => array('id' => $Message->getId())))),
			),
		));
	}
	else
	{
		$outils='';
	}
	$messages[]=new \user\PageElement(array(
		'template' => $config['path_template'].$Visiteur->getPage()->getApplication().'/'.$Visiteur->getPage()->getAction().'/message.html',
		'elements' => array(
			'outils'       => $outils,
			'nom_auteur'   => $Auteur->afficherPseudo(),
			'lien_auteur'  => $Routeur->creerLien(array_merge($config['forum_voir_fil_message_lien_auteur'], array($config['nom_parametres'] => array('id' => $Auteur->afficherId())))),
			'titre_auteur' => $lang['forum_voir_fil_message_titre_auteur'].$Auteur->afficherPseudo(),
			'date'         => $Message->afficherDate_publication(),
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
$toast_liens=array(
	'lien'        => array(array_merge($config['forum_voir_fil_lien_message_ajout'], array($config['nom_parametres'] => array('id_fil' => $Fil->getId())))),
	'description' => array($lang['forum_voir_fil_lien_message_ajout']),
	'icone'       => array('add'),
);
if ($Visiteur->autorisationModification($Fil))
{
	$toast_liens['lien'][]=array_merge($config['forum_voir_fil_lien_edition'], array($config['nom_parametres'] => array('id' => $Fil->getId())));
	$toast_liens['description'][]=$lang['forum_voir_fil_lien_edition'];
	$toast_liens['icone'][]='edit';
	$toast_liens['lien'][]=array_merge($config['forum_voir_fil_lien_suppression'], array($config['nom_parametres'] => array('id' => $Fil->getId())));
	$toast_liens['description'][]=$lang['forum_voir_fil_lien_suppression'];
	$toast_liens['icone'][]='delete';
}
if($Visiteur->verifLiens($toast_liens['lien']))
{
	$Toast=new \user\page\Toast($toast_liens);
}
else
{
	$Toast='';
}
$Corps=new \user\page\Corps($MenuUp, $Contenu, $Toast);
$Visiteur->getPage()->getPageElement()->ajouterElement($config['corps_nom'], $Corps);

?>