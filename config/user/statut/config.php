<?php

$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterElement('titre', $lang['user_statut_titre']);
$Visiteur->getPage()->getPageElement()->getElement($config['tete_nom'])->ajouterValeurElement('metas', array(
	'name' => 'description',
	'content' => $lang['user_statut_description'],
));

if ($Visiteur->getPseudo()!=$config['nom_guest'])
{
	$statut=new \user\PageElement(array(
		'template' => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/statut.html',
		'elements' => array(
			'pseudo'           => $lang['user_statut_pseudo'].$Visiteur->afficherPseudo(),
			'avatar_texte'     => $lang['user_statut_avatar'],
			'avatar_src'       =>  $config['chemin_avatar'].$Visiteur->afficherAvatar(),
			'avatar_alt'       => $lang['user_view_avatar_alt'].$Visiteur->afficherPseudo(),
			'date_connexion'   => $lang['user_statut_derndateco'].$Visiteur->afficherDate_connexion(),
			'date_inscription' => $lang['user_statut_premdatein'].$Visiteur->afficherDate_inscription(),
			'mail'             => $lang['user_statut_mail'].$Visiteur->afficherMail(),
		),
	));
	$lien_connexionEdition='<a href="'.$Routeur->creerLien($config['user_statut_lien_edition']).'" title="'.$lang['user_statut_titre_lien_edition'].'">'.$lang['user_statut_affichage_lien_edition'].'</a><br />';
	$lien_inscriptionDeconnexion='<a href="'.$Routeur->creerLien($config['user_statut_lien_deconnexion']).'" title="'.$lang['user_statut_titre_lien_deconnexion'].'">'.$lang['user_statut_affichage_lien_deconnexion'].'</a><br />';
}
else
{
	$statut=$lang['user_statut_nologin'].'<br />';
	$lien_connexionEdition='<a href="'.$Routeur->creerLien($config['user_statut_lien_connexion']).'" title="'.$lang['user_statut_titre_lien_connexion'].'">'.$lang['user_statut_affichage_lien_connexion'].'</a><br />';
	$lien_inscriptionDeconnexion='<a href="'.$Routeur->creerLien($config['user_statut_lien_inscription']).'" title="'.$lang['user_statut_titre_lien_inscription'].'">'.$lang['user_statut_affichage_lien_inscription'].'</a><br />';
}
$lien_configuration='<a href="'.$Routeur->creerLien($config['user_statut_lien_configurations']).'" title="'.$lang['user_statut_titre_lien_configurations'].'">'.$lang['user_statut_affichage_lien_configurations'].'</a>';

$Contenu=new \user\PageElement(array(
	'template'  => $config['path_template'].$this->getPage()->getApplication().'/'.$this->getPage()->getAction().'/'.$config['filename_contenu_template'],
	'elements'  => array(
		'statut'                      => $statut,
		'lien_connexionEdition'       => $lien_connexionEdition,
		'lien_inscriptionDeconnexion' => $lien_inscriptionDeconnexion,
		'lien_configuration'          => $lien_configuration,
	),
));

$Carte=new \user\page\Carte($Contenu, $Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));
$MenuUp=new \user\page\MenuUp($Visiteur->getPage()->getPageElement()->getElement($config['tete_nom']));
$Corps=new \user\page\Corps($MenuUp, $Carte, '');

$Visiteur->getPage()->getpageElement()->ajouterElement($config['corps_nom'], $Corps);
$Visiteur->getPage()->getPageElement()->ajouterElement($config['temps_nom'], new \user\page\Temps((string)(microtime(true)-$GLOBALS['time_start'])));

?>